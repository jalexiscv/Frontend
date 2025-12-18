<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Carousel extends AbstractComponent
{
    private string $id;
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(
        string $id,
        array $attributes = [],
        array $options = []
    ) {
        $this->id = $id;
        $this->items = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'controls' => true,
            'indicators' => true,
            'dark' => false,
            'fade' => false,
            'interval' => 5000,
            'keyboard' => true,
            'pause' => 'hover',
            'ride' => true,
            'touch' => true,
            'wrap' => true,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareAttributes();
        $carousel = $this->createComponent('div', $this->attributes);

        $elements = [];

        if ($this->options['indicators']) {
            $elements[] = $this->createIndicators();
        }

        $elements[] = $this->createInner();

        if ($this->options['controls']) {
            $elements[] = $this->createControl('prev');
            $elements[] = $this->createControl('next');
        }

        $carousel->content($elements);
        return $carousel;
    }

    protected function prepareAttributes(): void
    {
        $classes = ['carousel', 'slide'];

        if ($this->options['fade']) {
            $classes[] = 'carousel-fade';
        }

        if ($this->options['dark']) {
            $classes[] = 'carousel-dark';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['id'] = $this->id;

        if (!$this->options['touch']) {
            $this->attributes['data-bs-touch'] = 'false';
        }

        if (!$this->options['keyboard']) {
            $this->attributes['data-bs-keyboard'] = 'false';
        }

        if ($this->options['interval'] !== 5000) {
            $this->attributes['data-bs-interval'] = $this->options['interval'];
        }

        if ($this->options['pause'] !== 'hover') {
            $this->attributes['data-bs-pause'] = $this->options['pause'];
        }

        if (!$this->options['ride']) {
            $this->attributes['data-bs-ride'] = 'false';
        }

        if (!$this->options['wrap']) {
            $this->attributes['data-bs-wrap'] = 'false';
        }
    }

    protected function createIndicators(): TagInterface
    {
        $indicators = Html::tag('div', [
            'class' => 'carousel-indicators'
        ]);

        foreach ($this->items as $index => $item) {
            $button = Html::tag('button', [
                'type' => 'button',
                'data-bs-target' => "#{$this->id}",
                'data-bs-slide-to' => $index,
                'aria-label' => "Slide {$index}",
            ]);

            if ($index === 0) {
                $button->setAttribute('class', 'active');
                $button->setAttribute('aria-current', 'true');
            }

            $indicators->content($button);
        }

        return $indicators;
    }

    protected function createInner(): TagInterface
    {
        $inner = Html::tag('div', ['class' => 'carousel-inner']);

        foreach ($this->items as $index => $item) {
            $itemElement = Html::tag('div', [
                'class' => 'carousel-item' . ($index === 0 ? ' active' : '')
            ]);

            if (isset($item['image'])) {
                $image = Html::tag('img', [
                    'src' => $item['image'],
                    'class' => 'd-block w-100',
                    'alt' => $item['alt'] ?? ''
                ]);
                $itemElement->content($image);
            }

            if (isset($item['caption'])) {
                $caption = Html::tag('div', ['class' => 'carousel-caption d-none d-md-block'])
                    ->content([
                        isset($item['title']) ? Html::tag('h5', [], $item['title']) : null,
                        Html::tag('p', [], $item['caption'])
                    ]);
                $itemElement->content($caption);
            }

            $inner->content($itemElement);
        }

        return $inner;
    }

    protected function createControl(string $type): TagInterface
    {
        $button = Html::tag('button', [
            'class' => "carousel-control-{$type}",
            'type' => 'button',
            'data-bs-target' => "#{$this->id}",
            'data-bs-slide' => $type
        ]);

        $button->content([
            Html::tag('span', [
                'class' => "carousel-control-{$type}-icon",
                'aria-hidden' => 'true'
            ]),
            Html::tag('span', [
                'class' => 'visually-hidden'
            ], ucfirst($type))
        ]);

        return $button;
    }

    public function addItem(
        string $image,
        ?string $caption = null,
        ?string $title = null,
        ?string $alt = null
    ): self {
        $this->items[] = array_filter([
            'image' => $image,
            'caption' => $caption,
            'title' => $title,
            'alt' => $alt
        ]);
        return $this;
    }

    public static function create(string $id): self
    {
        return new self($id);
    }

    public function controls(bool $show = true): self
    {
        $this->options['controls'] = $show;
        return $this;
    }

    public function indicators(bool $show = true): self
    {
        $this->options['indicators'] = $show;
        return $this;
    }

    public function dark(bool $dark = true): self
    {
        $this->options['dark'] = $dark;
        return $this;
    }

    public function fade(bool $fade = true): self
    {
        $this->options['fade'] = $fade;
        return $this;
    }

    public function interval(int $milliseconds): self
    {
        $this->options['interval'] = $milliseconds;
        return $this;
    }

    public function keyboard(bool $keyboard = true): self
    {
        $this->options['keyboard'] = $keyboard;
        return $this;
    }

    public function pause(string $event): self
    {
        $this->options['pause'] = $event;
        return $this;
    }

    public function ride(bool $ride = true): self
    {
        $this->options['ride'] = $ride;
        return $this;
    }

    public function touch(bool $touch = true): self
    {
        $this->options['touch'] = $touch;
        return $this;
    }

    public function wrap(bool $wrap = true): self
    {
        $this->options['wrap'] = $wrap;
        return $this;
    }
}
