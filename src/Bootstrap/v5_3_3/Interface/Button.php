<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Button de Bootstrap 5.3.3
 * 
 * Opciones disponibles:
 * - 'content': string - Contenido del botón (requerido)
 * - 'variant': string - Variante del botón ('primary', 'secondary', etc.) [default: 'primary']
 * - 'outline': bool - Si es outline [default: false]
 * - 'size': string|null - Tamaño ('sm', 'lg') [default: null]
 * - 'block': bool - Si es block [default: false]
 * - 'active': bool - Si está activo [default: false]
 * - 'disabled': bool - Si está disabled [default: false]
 * - 'loading': bool - Si está cargando [default: false]
 * - 'loadingText': string - Texto mientras carga [default: 'Cargando...']
 * - 'icon': string|null - Clase del ícono [default: null]
 * - 'iconPosition': string - Posición del ícono ('start', 'end') [default: 'start']
 * - 'type': string - Tipo de botón ('button', 'submit', 'reset') [default: 'button']
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * @implements ComponentInterface
 * 
 * @example
 * new Button(['content' => 'Click', 'variant' => 'primary', 'size' => 'lg']);
 */
class Button extends AbstractComponent implements ComponentInterface
{
    private ?string $content = null;
    private array $attributes = [];
    private array $options = [];

    /**
     * Constructor
     * 
     * @param array $options Array de opciones de configuración
     */
    public function __construct(array $options = [])
    {
        // Content
        $this->content = $options['content'] ?? null;

        // Attributes
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        // Options con valores por defecto
        $this->options = [
            'type' => $options['type'] ?? 'button',
            'variant' => $options['variant'] ?? 'primary',
            'outline' => $options['outline'] ?? false,
            'size' => $options['size'] ?? null,
            'block' => $options['block'] ?? false,
            'active' => $options['active'] ?? false,
            'disabled' => $options['disabled'] ?? false,
            'loading' => $options['loading'] ?? false,
            'loadingText' => $options['loadingText'] ?? 'Cargando...',
            'icon' => $options['icon'] ?? null,
            'iconPosition' => $options['iconPosition'] ?? 'start',
        ];
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
}
