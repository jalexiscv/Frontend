<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Button extends AbstractComponent
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
            'type' => 'button',
            'variant' => 'primary',
            'outline' => false,
            'size' => null,
            'block' => false,
            'active' => false,
            'disabled' => false,
            'loading' => false,
            'loadingText' => 'Cargando...',
            'icon' => null,
            'iconPosition' => 'start', // start, end
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareAttributes();
        $tag = isset($this->attributes['href']) ? 'a' : 'button';
        $button = $this->createComponent($tag, $this->attributes);
        $content = $this->prepareContent();
        $button->content($content);
        return $button;
    }

    protected function prepareAttributes(): void
    {
        // Base classes
        $classes = ['btn'];
        
        // Variant
        $classes[] = $this->options['outline'] 
            ? "btn-outline-{$this->options['variant']}"
            : "btn-{$this->options['variant']}";

        // Size
        if ($this->options['size']) {
            $classes[] = "btn-{$this->options['size']}";
        }

        // Block (d-grid gap-2 en el contenedor padre)
        if ($this->options['block']) {
            $classes[] = 'd-block w-100';
        }

        // Active state
        if ($this->options['active']) {
            $classes[] = 'active';
            $this->attributes['aria-pressed'] = 'true';
        }

        // Merge classes
        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        // Button type
        if (!isset($this->attributes['href'])) {
            $this->attributes['type'] = $this->options['type'];
        }

        // Disabled state
        if ($this->options['disabled']) {
            if (isset($this->attributes['href'])) {
                $this->attributes['aria-disabled'] = 'true';
                $this->attributes['tabindex'] = '-1';
            } else {
                $this->attributes['disabled'] = true;
            }
        }

        // Loading state
        if ($this->options['loading']) {
            $this->attributes['disabled'] = true;
        }
    }

    protected function prepareContent(): array
    {
        $content = [];

        // Loading spinner
        if ($this->options['loading']) {
            $content[] = $this->createSpinner();
            $content[] = $this->options['loadingText'];
            return $content;
        }

        // Icon at start
        if ($this->options['icon'] && $this->options['iconPosition'] === 'start') {
            $content[] = $this->createIcon();
            $content[] = ' ';
        }

        $content[] = $this->content;

        // Icon at end
        if ($this->options['icon'] && $this->options['iconPosition'] === 'end') {
            $content[] = ' ';
            $content[] = $this->createIcon();
        }

        return $content;
    }

    protected function createSpinner(): TagInterface
    {
        return $this->createComponent('span', [
            'class' => 'spinner-border spinner-border-sm me-2',
            'role' => 'status',
            'aria-hidden' => 'true'
        ]);
    }

    protected function createIcon(): TagInterface
    {
        return $this->createComponent('i', [
            'class' => $this->options['icon']
        ]);
    }

    public function setVariant(string $variant): self
    {
        $this->options['variant'] = $variant;
        return $this;
    }

    public function outline(bool $outline = true): self
    {
        $this->options['outline'] = $outline;
        return $this;
    }

    public function size(string $size): self
    {
        $this->options['size'] = $size;
        return $this;
    }

    public function block(bool $block = true): self
    {
        $this->options['block'] = $block;
        return $this;
    }

    public function active(bool $active = true): self
    {
        $this->options['active'] = $active;
        return $this;
    }

    public function disabled(bool $disabled = true): self
    {
        $this->options['disabled'] = $disabled;
        return $this;
    }

    public function loading(bool $loading = true, ?string $text = null): self
    {
        $this->options['loading'] = $loading;
        if ($text !== null) {
            $this->options['loadingText'] = $text;
        }
        return $this;
    }

    public function icon(string $icon, string $position = 'start'): self
    {
        $this->options['icon'] = $icon;
        $this->options['iconPosition'] = $position;
        return $this;
    }

    public static function submit(string $content = 'Enviar', array $attributes = []): self
    {
        return new self($content, $attributes, ['type' => 'submit']);
    }

    public static function reset(string $content = 'Restablecer', array $attributes = []): self
    {
        return new self($content, $attributes, ['type' => 'reset']);
    }

    public static function link(string $content, string $href, array $attributes = []): self
    {
        return new self($content, array_merge(['href' => $href], $attributes));
    }
}
