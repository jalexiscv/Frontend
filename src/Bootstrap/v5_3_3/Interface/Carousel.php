<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Carousel de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID del carousel (requerido)
 * - 'slides': array - Slides [['image' => '', 'caption' => '', 'title' => '', 'active' => bool]]
 * - 'controls': bool - Mostrar controles [default: true]
 * - 'indicators': bool - Mostrar indicadores [default: true]
 * - 'fade': bool - Animación fade [default: false]
 * - 'dark': bool - Versión oscura [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Carousel extends AbstractComponent implements ComponentInterface
{
    private ?string $id = null;
    private array $slides = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? null;

        if (isset($options['slides']) && is_array($options['slides'])) {
            $this->slides = $options['slides'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'controls' => $options['controls'] ?? true,
            'indicators' => $options['indicators'] ?? true,
            'fade' => $options['fade'] ?? false,
            'dark' => $options['dark'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['carousel', 'slide'];
        if ($this->options['fade']) $classes[] = 'carousel-fade';
        if ($this->options['dark']) $classes[] = 'carousel-dark';

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['id'] = $this->id;
        $this->attributes['data-bs-ride'] = 'carousel';

        $carousel = $this->createComponent('div', $this->attributes);
        $content = [];

        if ($this->options['indicators']) {
            $content[] = $this->createIndicators();
        }

        $content[] = $this->createInner();

        if ($this->options['controls']) {
            $content[] = $this->createControl('prev');
            $content[] = $this->createControl('next');
        }

        $carousel->content($content);
        return $carousel;
    }

    protected function createIndicators(): TagInterface
    {
        $indicators = Html::tag('div', ['class' => 'carousel-indicators']);
        $buttons = [];

        foreach ($this->slides as $index => $slide) {
            $buttons[] = Html::tag('button', [
                'type' => 'button',
                'data-bs-target' => "#{$this->id}",
                'data-bs-slide-to' => (string)$index,
                'class' => ($slide['active'] ?? $index === 0) ? 'active' : '',
                'aria-current' => ($slide['active'] ?? $index === 0) ? 'true' : 'false',
                'aria-label' => "Slide " . ($index + 1)
            ]);
        }

        $indicators->content($buttons);
        return $indicators;
    }

    protected function createInner(): TagInterface
    {
        $inner = Html::tag('div', ['class' => 'carousel-inner']);
        $items = [];

        foreach ($this->slides as $index => $slide) {
            $items[] = $this->createItem($slide, $index);
        }

        $inner->content($items);
        return $inner;
    }

    protected function createItem(array $slide, int $index): TagInterface
    {
        $isActive = $slide['active'] ?? $index === 0;
        $item = Html::tag('div', ['class' => 'carousel-item' . ($isActive ? ' active' : '')]);

        $img = Html::tag('img', [
            'src' => $slide['image'],
            'class' => 'd-block w-100',
            'alt' => $slide['title'] ?? ''
        ]);

        $content = [$img];

        if (isset($slide['caption']) || isset($slide['title'])) {
            $caption = Html::tag('div', ['class' => 'carousel-caption d-none d-md-block']);
            if (isset($slide['title'])) {
                $caption->content(Html::tag('h5', [], $slide['title']));
            }
            if (isset($slide['caption'])) {
                $caption->addContent(Html::tag('p', [], $slide['caption']));
            }
            $content[] = $caption;
        }

        $item->content($content);
        return $item;
    }

    protected function createControl(string $direction): TagInterface
    {
        $label = $direction === 'prev' ? 'Previous' : 'Next';
        $icon = "carousel-control-{$direction}-icon";

        $button = Html::tag('button', [
            'class' => "carousel-control-{$direction}",
            'type' => 'button',
            'data-bs-target' => "#{$this->id}",
            'data-bs-slide' => $direction
        ]);

        $button->content([
            Html::tag('span', ['class' => $icon, 'aria-hidden' => 'true']),
            Html::tag('span', ['class' => 'visually-hidden'], $label)
        ]);

        return $button;
    }

    // Métodos fluidos opcionales
    public function controls(bool $controls = true): self
    {
        $this->options['controls'] = $controls;
        return $this;
    }
    public function indicators(bool $indicators = true): self
    {
        $this->options['indicators'] = $indicators;
        return $this;
    }
    public function fade(bool $fade = true): self
    {
        $this->options['fade'] = $fade;
        return $this;
    }
    public function dark(bool $dark = true): self
    {
        $this->options['dark'] = $dark;
        return $this;
    }
}
