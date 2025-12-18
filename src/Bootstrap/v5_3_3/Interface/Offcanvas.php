<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Offcanvas extends AbstractComponent
{
    private string $id;
    private string $title;
    private mixed $content;
    private array $attributes;
    private array $options;

    public function __construct(
        string $id,
        string $title,
        mixed $content,
        array $attributes = [],
        array $options = []
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'placement' => 'start',
            'backdrop' => true,
            'scroll' => false,
            'responsive' => null,
            'dark' => false,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareAttributes();
        $offcanvas = $this->createComponent('div', $this->attributes);

        $header = Html::tag('div', ['class' => 'offcanvas-header'])
            ->content([
                Html::tag('h5', ['class' => 'offcanvas-title', 'id' => "{$this->id}Label"], $this->title),
                Html::tag('button', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'offcanvas',
                    'aria-label' => 'Close'
                ])
            ]);

        $body = Html::tag('div', ['class' => 'offcanvas-body'])
            ->content($this->content);

        $offcanvas->content([$header, $body]);
        return $offcanvas;
    }

    protected function prepareAttributes(): void
    {
        $classes = ['offcanvas'];

        if ($this->options['responsive']) {
            $classes[] = "offcanvas-{$this->options['responsive']}";
        }

        $classes[] = "offcanvas-{$this->options['placement']}";

        if ($this->options['dark']) {
            $classes[] = 'text-bg-dark';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['tabindex'] = '-1';
        $this->attributes['id'] = $this->id;
        $this->attributes['aria-labelledby'] = "{$this->id}Label";

        if (!$this->options['backdrop']) {
            $this->attributes['data-bs-backdrop'] = 'false';
        }

        if ($this->options['scroll']) {
            $this->attributes['data-bs-scroll'] = 'true';
        }
    }

    public function renderTrigger(mixed $content = null, array $attributes = []): TagInterface
    {
        $attributes = array_merge($attributes, [
            'data-bs-toggle' => 'offcanvas',
            'data-bs-target' => "#{$this->id}",
            'aria-controls' => $this->id
        ]);

        if (!isset($attributes['type'])) {
            $attributes['type'] = 'button';
        }

        return $this->createComponent('button', $attributes)
            ->content($content ?? $this->title);
    }

    public static function create(string $id, string $title, mixed $content): self
    {
        return new self($id, $title, $content);
    }

    public function placement(string $placement): self
    {
        $this->options['placement'] = $placement;
        return $this;
    }

    public function backdrop(bool $backdrop = true): self
    {
        $this->options['backdrop'] = $backdrop;
        return $this;
    }

    public function scroll(bool $scroll = true): self
    {
        $this->options['scroll'] = $scroll;
        return $this;
    }

    public function responsive(string $breakpoint): self
    {
        $this->options['responsive'] = $breakpoint;
        return $this;
    }

    public function dark(bool $dark = true): self
    {
        $this->options['dark'] = $dark;
        return $this;
    }
}
