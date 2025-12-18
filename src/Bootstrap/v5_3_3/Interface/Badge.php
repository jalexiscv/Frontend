<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Badge extends AbstractComponent
{
    private string $content;
    private array $attributes;
    private array $options;

    public function __construct(
        string $content,
        array $attributes = [],
        array $options = []
    ) {
        $this->content = $content;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'variant' => 'primary',
            'pill' => false,
            'position' => null, // top-right, top-left, bottom-right, bottom-left
            'notification' => false,
        ], $options);
    }

    public function render(): TagInterface
    {
        if ($this->options['notification']) {
            return $this->renderNotification();
        }

        $this->prepareClasses();
        $badge = $this->createComponent('span', $this->attributes);
        $badge->content($this->content);
        return $badge;
    }

    protected function prepareClasses(): void
    {
        $classes = ['badge'];

        $classes[] = "bg-{$this->options['variant']}";

        if ($this->options['pill']) {
            $classes[] = 'rounded-pill';
        }

        if ($this->options['position']) {
            $classes[] = "position-absolute top-0 start-100 translate-middle";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    protected function renderNotification(): TagInterface
    {
        $wrapper = $this->createComponent('button', [
            'type' => 'button',
            'class' => 'btn btn-primary position-relative'
        ])->content($this->content);

        $this->options['position'] = true;
        $this->prepareClasses();

        $badge = $this->createComponent('span', $this->attributes)
            ->content($this->content);

        $wrapper->content($badge);
        return $wrapper;
    }

    public static function create(string $content): self
    {
        return new self($content);
    }

    public function setVariant(string $variant): self
    {
        $this->options['variant'] = $variant;
        return $this;
    }

    public function pill(bool $pill = true): self
    {
        $this->options['pill'] = $pill;
        return $this;
    }

    public function position(string $position): self
    {
        $this->options['position'] = $position;
        return $this;
    }

    public function notification(bool $notification = true): self
    {
        $this->options['notification'] = $notification;
        return $this;
    }
}
