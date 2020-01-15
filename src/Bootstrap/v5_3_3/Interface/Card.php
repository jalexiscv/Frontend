<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente Card de Bootstrap 5.3.3
 * 
 * @implements ComponentInterface
 */
class Card extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private ?string $title = null;
    private mixed $content = null;
    private mixed $footer = null;
    private ?string $imageUrl = null;
    private ?string $imagePosition = 'top';
    private array $attributes = [];
    private array $headerAttributes = [];
    private array $bodyAttributes = [];
    private array $footerAttributes = [];
    private array $imageAttributes = [];
    private array $listItems = [];
    private array $tabs = [];

    // Header completo (alternativo al title simple en body)
    private mixed $headerTitle = null;
    private ?string $headerClass = null;
    private array $headerButtons = [];

    /**
     * Constructor de Card
     *
     * Acepta un array de opciones para configurar la tarjeta:
     * - 'title': string - Título de la tarjeta (se muestra en el body)
     * - 'content': mixed - Contenido del cuerpo de la tarjeta. Acepta:
     *     · string                  → texto plano (escapado)
     *     · TagInterface            → componente BS5 directo, ej. BS5::button([...])
     *     · array de TagInterface   → varios componentes, ej. [BS5::button(...), BS5::button(...)]
     *     · array de configuración  → ['content' => ..., 'htmlContent' => ..., 'class' => ..., 'attributes' => [...]]
     *       - 'content':     TagInterface|array<TagInterface>|string  Contenido del body
     *       - 'htmlContent': string   HTML crudo sin escapar (alternativa a content)
     *       - 'class':       string   Clases CSS adicionales para el div.card-body
     *       - 'attributes':  array    Atributos HTML adicionales para el div.card-body
     * - 'footer': mixed - Pie de la tarjeta. Acepta:
     *     · string                  → texto plano (escapado)
     *     · TagInterface            → componente BS5 directo, ej. BS5::button([...])
     *     · array de TagInterface   → varios componentes, ej. [BS5::button(...), BS5::button(...)]
     *     · array de configuración  → ['content' => ..., 'htmlContent' => ..., 'class' => ..., 'attributes' => [...]]
     *       - 'content':     TagInterface|array<TagInterface>|string  Contenido del footer
     *       - 'htmlContent': string   HTML crudo sin escapar (alternativa a content)
     *       - 'class':       string   Clases CSS adicionales para el div.card-footer
     *       - 'attributes':  array    Atributos HTML adicionales para el div.card-footer
     * - 'header': mixed - Encabezado de la tarjeta. Acepta:
     *     · string                 → título del header (escapado)
     *     · array de configuración → ['title' => ..., 'htmlTitle' => ..., 'class' => ..., 'buttons' => [...], 'attributes' => [...]]
     *       - 'title':      string   Título del header (escapado)
     *       - 'htmlTitle':  string   Título HTML sin escapar (alternativa a title)
     *       - 'class':      string   Clases CSS adicionales para el div.card-header
     *       - 'buttons':    array    Botones alineados a la derecha en el header
     *       - 'attributes': array    Atributos HTML adicionales para el div.card-header
     * - 'image': string - URL de la imagen
     * - 'imagePosition': string - Posición de la imagen ('top' o 'bottom')
     * - 'attributes': array - Atributos HTML adicionales para el contenedor
     * - 'headerAttributes': array - Atributos para el header (alternativa a header[attributes])
     * - 'bodyAttributes': array - Atributos para el body
     * - 'footerAttributes': array - Atributos para el footer (alternativa a footer[attributes])
     * - 'imageAttributes': array - Atributos para la imagen
     * - 'headerTitle': string - Título en el header, escapado (alternativa a header[title])
     * - 'headerHtmlTitle': string - Título HTML en el header, sin escapar (alternativa a header[htmlTitle])
     * - 'headerClass': string - Clases CSS del header (alternativa a header[class])
     * - 'headerButtons': array - Botones del header (alternativa a header[buttons])
     * 
     * @param array $options Array de opciones de configuración
     * 
     * @example
     * // Uso básico
     * new Card(['title' => 'Mi Título', 'content' => 'Contenido'])
     *
     * // Uso completo
     * new Card([
     *     'title' => 'Título',
     *     'content' => 'Contenido',
     *     'footer' => 'Pie',
     *     'image' => 'imagen.jpg',
     *     'imagePosition' => 'top',
     *     'imageAttributes' => ['class' => 'p-1'],
     *     'attributes' => ['class' => 'shadow']
     * ])
     *
     * // Card con header y botones
     * new Card([
     *     'headerHtmlTitle' => 'Título con <span class="badge">Badge</span>',
     *     'image' => 'logo.png',
     *     'imageAttributes' => ['class' => 'p-3'],
     *     'content' => 'Contenido de la tarjeta'
     * ])
     *
     * // Card con content como array de configuración (NUEVO)
     * // Permite controlar clase y atributos del body junto con el contenido
     * new Card([
     *     'header' => [
     *         'title' => 'Acceso Denegado',
     *         'class' => 'bg-danger text-white'
     *     ],
     *     'content' => [
     *         'htmlContent' => '<i class="fas fa-ban"></i><p>No tienes permiso</p>',
     *         'class' => 'text-center py-3',
     *         'attributes' => ['data-role' => 'error-message']
     *     ],
     *     'footer' => [
     *         'content' => 'Volver',
     *         'class' => 'd-flex justify-content-end'
     *     ],
     *     'attributes' => ['class' => 'border-danger shadow-sm']
     * ])
     */
    public function __construct(array $options = [])
    {
        // Título
        if (isset($options['title'])) {
            $this->title = $options['title'];
        }

        // Contenido - acepta array de configuración o valor directo
        if (isset($options['content']) && is_array($options['content'])
            && array_intersect_key($options['content'], array_flip(['content', 'htmlContent', 'class', 'attributes']))
        ) {
            // Array de configuración: extraer contenido y atributos del body
            $c = $options['content'];
            if (isset($c['htmlContent'])) {
                $this->content = Html::raw((string) $c['htmlContent']);
            } elseif (isset($c['content'])) {
                $this->content = $c['content'];
            }
            if (isset($c['class'])) {
                $this->bodyAttributes['class'] = $c['class'];
            }
            if (isset($c['attributes']) && is_array($c['attributes'])) {
                $this->bodyAttributes = array_merge($this->bodyAttributes, $c['attributes']);
            }
        } else {
            // Valor directo: TagInterface, array de TagInterface o string
            $this->content = $this->processContent($options);
        }

        // Footer - acepta string, TagInterface, array de TagInterface o array de configuración
        if (isset($options['footer'])) {
            $f = $options['footer'];
            if (is_array($f) && array_intersect_key($f, array_flip(['content', 'htmlContent', 'class', 'attributes']))) {
                // Array de configuración: extraer contenido y atributos del footer
                if (isset($f['htmlContent'])) {
                    $this->footer = Html::raw((string) $f['htmlContent']);
                } elseif (isset($f['content'])) {
                    $this->footer = $f['content'];
                }
                if (isset($f['class'])) {
                    $this->footerAttributes['class'] = $f['class'];
                }
                if (isset($f['attributes']) && is_array($f['attributes'])) {
                    $this->footerAttributes = array_merge($this->footerAttributes, $f['attributes']);
                }
            } else {
                // Valor directo: TagInterface, array de TagInterface o string
                $this->footer = $f;
            }
        }

        // Imagen
        if (isset($options['image'])) {
            $this->imageUrl = $options['image'];
        }

        // Posición de la imagen
        if (isset($options['imagePosition'])) {
            $validPositions = ['top', 'bottom'];
            if (in_array($options['imagePosition'], $validPositions)) {
                $this->imagePosition = $options['imagePosition'];
            } else {
                throw new \InvalidArgumentException(
                    "imagePosition debe ser 'top' o 'bottom'. Recibido: {$options['imagePosition']}"
                );
            }
        }

        // Atributos del contenedor principal
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        // Atributos del header
        if (isset($options['headerAttributes']) && is_array($options['headerAttributes'])) {
            $this->headerAttributes = $options['headerAttributes'];
        }

        // Atributos del body
        if (isset($options['bodyAttributes']) && is_array($options['bodyAttributes'])) {
            $this->bodyAttributes = $options['bodyAttributes'];
        }

        // Atributos del footer
        if (isset($options['footerAttributes']) && is_array($options['footerAttributes'])) {
            $this->footerAttributes = $options['footerAttributes'];
        }

        // Atributos de la imagen
        if (isset($options['imageAttributes']) && is_array($options['imageAttributes'])) {
            $this->imageAttributes = $options['imageAttributes'];
        }

        // Header legacy: claves individuales
        if (isset($options['headerHtmlTitle'])) {
            $this->headerTitle = Html::raw($options['headerHtmlTitle']);
        } elseif (isset($options['headerTitle'])) {
            $this->headerTitle = $options['headerTitle'];
        }
        if (isset($options['headerClass'])) {
            $this->headerClass = $options['headerClass'];
        }
        if (isset($options['headerButtons']) && is_array($options['headerButtons'])) {
            $this->headerButtons = $options['headerButtons'];
        }

        // Header unificado - sobreescribe las claves legacy si se provee
        if (isset($options['header'])) {
            $h = $options['header'];
            if (is_array($h) && array_intersect_key($h, array_flip(['title', 'htmlTitle', 'class', 'buttons', 'attributes']))) {
                // Array de configuración
                if (isset($h['htmlTitle'])) {
                    $this->headerTitle = Html::raw((string) $h['htmlTitle']);
                } elseif (isset($h['title'])) {
                    $this->headerTitle = $h['title'];
                }
                if (isset($h['class'])) {
                    $this->headerClass = $h['class'];
                }
                if (isset($h['buttons']) && is_array($h['buttons'])) {
                    $this->headerButtons = $h['buttons'];
                }
                if (isset($h['attributes']) && is_array($h['attributes'])) {
                    $this->headerAttributes = array_merge($this->headerAttributes, $h['attributes']);
                }
            } elseif (is_string($h)) {
                // String directo → título escapado
                $this->headerTitle = $h;
            }
        }
    }

    /**
     * Establece el encabezado de la tarjeta
     */
    public function header(string $content, array $attributes = []): self
    {
        $this->title = $content;
        $this->headerAttributes = $attributes;
        return $this;
    }

    /**
     * Establece el contenido del cuerpo de la tarjeta
     */
    public function body($content, array $attributes = []): self
    {
        $this->content = $content;
        $this->bodyAttributes = $attributes;
        return $this;
    }

    /**
     * Establece el pie de la tarjeta
     */
    public function footer(string $content, array $attributes = []): self
    {
        $this->footer = $content;
        $this->footerAttributes = $attributes;
        return $this;
    }

    /**
     * Agrega una imagen a la tarjeta
     */
    public function image(string $url, string $position = 'top', array $attributes = []): self
    {
        $this->imageUrl = $url;
        $this->imagePosition = $position;
        return $this;
    }

    /**
     * Agrega una lista de elementos a la tarjeta
     */
    public function listGroup(array $items): self
    {
        $this->listItems = $items;
        return $this;
    }

    /**
     * Agrega tabs a la tarjeta
     */
    public function tabs(array $tabs): self
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'card',
            $this->attributes['class'] ?? null
        );

        $card = $this->createComponent('div', $this->attributes);
        $elements = [];

        // Header completo (se muestra antes que la imagen)
        if ($this->headerTitle !== null || !empty($this->headerButtons)) {
            $elements[] = $this->createHeader();
        }

        if ($this->imageUrl && $this->imagePosition === 'top') {
            $elements[] = $this->createImage();
        }

        if ($this->title || $this->content) {
            $elements[] = $this->createBody();
        }

        if (!empty($this->listItems)) {
            $elements[] = $this->createListGroup();
        }

        if (!empty($this->tabs)) {
            $elements[] = $this->createTabs();
        }

        if ($this->imageUrl && $this->imagePosition === 'bottom') {
            $elements[] = $this->createImage();
        }

        if (!empty($this->footer)) {
            $elements[] = $this->createFooter();
        }

        $card->content($elements);
        return $card;
    }

    /**
     * Crea el header completo de la tarjeta con título y botones opcionales
     */
    private function createHeader(): TagInterface
    {
        if (empty($this->headerButtons)) {
            return $this->createHeaderWithoutButtons();
        }
        return $this->createHeaderWithButtons();
    }

    private function createHeaderWithoutButtons(): TagInterface
    {
        $headerClasses = 'card-header';
        if ($this->headerClass) {
            $headerClasses .= ' ' . $this->headerClass;
        }

        $this->headerAttributes['class'] = $this->mergeClasses(
            $headerClasses,
            $this->headerAttributes['class'] ?? null
        );

        $header = Html::tag('div', $this->headerAttributes);

        if ($this->headerTitle) {
            $titleElement = Html::tag('h5', ['class' => 'card-title mb-0']);
            $titleElement->content($this->headerTitle);
            $header->content($titleElement);
        }

        return $header;
    }


    private function createHeaderWithButtons(): TagInterface
    {
        $headerClasses = 'card-header d-flex justify-content-between align-items-center mx-0 px-0';
        if ($this->headerClass) {
            $headerClasses .= ' ' . $this->headerClass;
        }

        $this->headerAttributes['class'] = $this->mergeClasses(
            $headerClasses,
            $this->headerAttributes['class'] ?? null
        );

        $header = Html::tag('div', $this->headerAttributes);
        $headerContent = [];

        if ($this->headerTitle) {
            $titleElement = Html::tag('span', ['class' => 'header-title px-3']);
            $titleElement->content($this->headerTitle);
            $headerContent[] = $titleElement;
        }
        $toolBar = Html::tag('div', ['aria-label' => 'Opciones','class' => 'd-flex align-items-center flex-wrap gap-1 toolbar-group px-1']);
        $buttonsContainer = Html::tag('div', ['class' => 'btn-group btn-group-actions btn-group-sm shadow-sm']);
        $buttonsContainer->content($this->headerButtons);
        $toolBar->content($buttonsContainer);
        $headerContent[] = $toolBar;
        $header->content($headerContent);
        return $header;
    }

    private function createImage(): TagInterface
    {
        $this->imageAttributes['class'] = $this->mergeClasses(
            'card-img-' . $this->imagePosition,
            $this->imageAttributes['class'] ?? null
        );

        $this->imageAttributes['src'] = $this->imageUrl;

        if (!isset($this->imageAttributes['alt'])) {
            $this->imageAttributes['alt'] = $this->title ?? 'Card image';
        }

        return Html::tag('img', $this->imageAttributes);
    }

    private function createBody(): TagInterface
    {
        $this->bodyAttributes['class'] = $this->mergeClasses(
            'card-body',
            $this->bodyAttributes['class'] ?? null
        );

        $body = Html::tag('div', $this->bodyAttributes);
        $bodyContent = [];

        if ($this->title) {
            $this->headerAttributes['class'] = $this->mergeClasses(
                'card-title',
                $this->headerAttributes['class'] ?? null
            );
            $bodyContent[] = Html::tag('h5', $this->headerAttributes, $this->title);
        }

        if ($this->content) {
            if (is_array($this->content)) {
                $bodyContent = array_merge($bodyContent, $this->content);
            } else {
                $bodyContent[] = Html::tag('div', ['class' => 'container m-0 p-0'], $this->content);
            }
        }

        $body->content($bodyContent);
        return $body;
    }

    private function createFooter(): TagInterface
    {
        $this->footerAttributes['class'] = $this->mergeClasses(
            'card-footer',
            $this->footerAttributes['class'] ?? null
        );

        $footer = Html::tag('div', $this->footerAttributes);
        $footer->content($this->footer);
        return $footer;
    }

    private function createListGroup(): TagInterface
    {
        $listGroup = Html::tag('ul', ['class' => 'list-group list-group-flush']);
        $items = [];

        foreach ($this->listItems as $item) {
            $items[] = Html::tag('li', ['class' => 'list-group-item'], $item);
        }

        $listGroup->content($items);
        return $listGroup;
    }

    private function createTabs(): TagInterface
    {
        $tabContainer = Html::tag('div', ['class' => 'card-header']);
        $nav = Html::tag('ul', ['class' => 'nav nav-tabs card-header-tabs']);
        $tabContent = Html::tag('div', ['class' => 'tab-content']);
        $tabItems = [];
        $tabPanes = [];

        foreach ($this->tabs as $id => $tab) {
            $isActive = empty($tabItems);
            $tabItems[] = Html::tag('li', ['class' => 'nav-item'])
                ->content(
                    Html::tag('a', [
                        'class' => 'nav-link' . ($isActive ? ' active' : ''),
                        'data-bs-toggle' => 'tab',
                        'href' => '#' . $id,
                        'role' => 'tab'
                    ], $tab['title'])
                );

            $tabPanes[] = Html::tag('div', [
                'class' => 'tab-pane fade' . ($isActive ? ' show active' : ''),
                'id' => $id,
                'role' => 'tabpanel'
            ], $tab['content']);
        }

        $nav->content($tabItems);
        $tabContainer->content($nav);
        $tabContent->content($tabPanes);

        return Html::tag('div')
            ->content([$tabContainer, $tabContent]);
    }

    /**
     * Crea una tarjeta horizontal
     * 
     * @param string $imageUrl URL de la imagen
     * @param string|null $title Título de la tarjeta
     * @param mixed $content Contenido de la tarjeta
     * @param array $attributes Atributos HTML adicionales
     * @return self
     */
    public static function horizontal(
        string $imageUrl,
        ?string $title = null,
        $content = null,
        array $attributes = []
    ): self {
        // Agregar clase flex-row para layout horizontal
        $attributes['class'] = isset($attributes['class'])
            ? $attributes['class'] . ' flex-row'
            : 'flex-row';

        return new self([
            'image' => $imageUrl,
            'title' => $title,
            'content' => $content,
            'attributes' => $attributes
        ]);
    }
}
