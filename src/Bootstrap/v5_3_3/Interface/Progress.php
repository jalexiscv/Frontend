<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Progress extends AbstractComponent
{
    private array $bars;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->bars = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'height' => null,
            'striped' => false,
            'animated' => false,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareAttributes();
        $progress = $this->createComponent('div', $this->attributes);
        $progress->content($this->bars);
        return $progress;
    }

    protected function prepareAttributes(): void
    {
        $this->attributes['class'] = $this->mergeClasses(
            'progress',
            $this->attributes['class'] ?? null
        );

        if ($this->options['height']) {
            $this->attributes['style'] = "height: {$this->options['height']}";
        }
    }

    public function addBar(
        int $value,
        ?string $label = null,
        string $variant = 'primary',
        array $attributes = []
    ): self {
        $classes = ['progress-bar'];

        if ($variant !== 'primary') {
            $classes[] = "bg-{$variant}";
        }

        if ($this->options['striped']) {
            $classes[] = 'progress-bar-striped';
        }

        if ($this->options['animated']) {
            $classes[] = 'progress-bar-animated';
        }

        $attributes = array_merge($attributes, [
            'class' => $this->mergeClasses(
                implode(' ', $classes),
                $attributes['class'] ?? null
            ),
            'role' => 'progressbar',
            'style' => "width: {$value}%",
            'aria-valuenow' => $value,
            'aria-valuemin' => 0,
            'aria-valuemax' => 100
        ]);

        $bar = Html::tag('div', $attributes, $label);
        $this->bars[] = $bar;

        return $this;
    }

    public static function create(): self
    {
        return new self();
    }

    public function height(string $height): self
    {
        $this->options['height'] = $height;
        return $this;
    }

    public function striped(bool $striped = true): self
    {
        $this->options['striped'] = $striped;
        return $this;
    }

    public function animated(bool $animated = true): self
    {
        $this->options['animated'] = $animated;
        $this->options['striped'] = true;
        return $this;
    }
}
