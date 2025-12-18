<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;

/**
 * Componente de Tarjeta de Bootstrap 5
 */
class Card extends AbstractComponent
{
    private ?string $title = null;
    private $content = null;
    private ?string $footer = null;
    private ?string $imageUrl = null;
    private ?string $imagePosition = 'top';
    private array $attributes = [];
    private array $headerAttributes = [];
    private array $bodyAttributes = [];
    private array $footerAttributes = [];
    private array $listItems = [];
    private array $tabs = [];

    // Header completo (alternativo al title simple en body)
    private ?string $headerTitle = null;
    private ?string $headerClass = null;
    private array $headerButtons = [];

    /**
     * Constructor de Card
     * 
     * Acepta un array de opciones para configurar la tarjeta:
     * - 'title': string - Título de la tarjeta (se muestra en el body)
     * - 'content': mixed - Contenido del cuerpo de la tarjeta
     * - 'footer': string - Pie de la tarjeta
     * - 'image': string - URL de la imagen
     * - 'imagePosition': string - Posición de la imagen ('top' o 'bottom')
     * - 'attributes': array - Atributos HTML adicionales para el contenedor
     * - 'headerAttributes': array - Atributos para el header
     * - 'bodyAttributes': array - Atributos para el body
     * - 'footerAttributes': array - Atributos para el footer
     * - 'headerTitle': string - Título en el header (crea un header separado)
     * - 'headerClass': string - Clases CSS adicionales para el header
     * - 'headerButtons': array - Botones para mostrar alineados a la derecha en el header
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
     *     'attributes' => ['class' => 'shadow']
     * ])
     */
    public function __construct(array $options = [])
    {
        // Título
        if (isset($options['title'])) {
            $this->title = $options['title'];
        }

        // Contenido
        if (isset($options['content'])) {
            $this->content = $options['content'];
        }

        // Footer
        if (isset($options['footer'])) {
            $this->footer = $options['footer'];
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

        // Header completo
        if (isset($options['headerTitle'])) {
            $this->headerTitle = $options['headerTitle'];
        }

        // Clase CSS del header
        if (isset($options['headerClass'])) {
            $this->headerClass = $options['headerClass'];
        }

        // Botones del header
        if (isset($options['headerButtons']) && is_array($options['headerButtons'])) {
            $this->headerButtons = $options['headerButtons'];
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

        if ($this->footer) {
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
        // Preparar clases del header
        $headerClasses = 'card-header';
        if ($this->headerClass) {
            $headerClasses .= ' ' . $this->headerClass;
        }

        $this->headerAttributes['class'] = $this->mergeClasses(
            $headerClasses,
            $this->headerAttributes['class'] ?? null
        );

        $header = Html::tag('div', $this->headerAttributes);

        // Si no hay botones, solo mostrar el título
        if (empty($this->headerButtons)) {
            $header->content($this->headerTitle ?? '');
            return $header;
        }

        // Si hay botones, usar layout flex con título a la izquierda y botones a la derecha
        $container = Html::tag('div', ['class' => 'd-flex justify-content-between align-items-center']);

        // Título a la izquierda
        if ($this->headerTitle) {
            $titleElement = Html::tag('div', ['class' => 'card-header-title']);
            $titleElement->content($this->headerTitle);
            $containerContent[] = $titleElement;
        }

        // Botones a  la derecha
        $buttonGroup = Html::tag('div', ['class' => 'card-header-buttons']);
        $buttonGroup->content($this->headerButtons);
        $containerContent[] = $buttonGroup;

        $container->content($containerContent ?? []);
        $header->content($container);

        return $header;
    }

    private function createImage(): TagInterface
    {
        return Html::tag('img', [
            'src' => $this->imageUrl,
            'class' => 'card-img-' . $this->imagePosition,
            'alt' => $this->title ?? 'Card image'
        ]);
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
                $bodyContent[] = Html::tag('div', ['class' => 'card-text'], $this->content);
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

        return Html::tag('div', $this->footerAttributes, $this->footer);
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
