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

    /**
     * Constructor de Card
     * 
     * @param string|null $title Título de la tarjeta
     * @param mixed $content Contenido del cuerpo de la tarjeta
     * @param string|null $footer Pie de la tarjeta
     * @param string|null $imageUrl URL de la imagen
     * @param array $attributes Atributos HTML adicionales
     */
    public function __construct(
        ?string $title = null,
        $content = null,
        ?string $footer = null,
        ?string $imageUrl = null,
        array $attributes = []
    ) {
        if ($title !== null) {
            $this->title = $title;
        }
        if ($content !== null) {
            $this->content = $content;
        }
        if ($footer !== null) {
            $this->footer = $footer;
        }
        if ($imageUrl !== null) {
            $this->imageUrl = $imageUrl;
        }
        $this->attributes = $attributes;
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
     */
    public static function horizontal(
        string $imageUrl,
        ?string $title = null,
        $content = null,
        array $attributes = []
    ): self {
        $card = new self();
        $card->attributes = array_merge(['class' => 'flex-row'], $attributes);
        $card->image($imageUrl);

        if ($title) {
            $card->header($title);
        }

        if ($content) {
            $card->body($content);
        }

        return $card;
    }
}
