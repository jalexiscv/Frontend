<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente ButtonGroup de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'buttons': array - Array de botones
 * - 'size': string|null - Tamaño ('sm', 'lg') [default: null]
 * - 'vertical': bool - Si es vertical [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class ButtonGroup extends AbstractComponent implements ComponentInterface
{
    private array $buttons = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['buttons']) && is_array($options['buttons'])) {
            $this->buttons = $options['buttons'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'size' => $options['size'] ?? null,
            'vertical' => $options['vertical'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = [$this->options['vertical'] ? 'btn-group-vertical' : 'btn-group'];

        if ($this->options['size']) {
            $classes[] = "btn-group-{$this->options['size']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['role'] = 'group';

        $group = $this->createComponent('div', $this->attributes);
        $group->content($this->buttons);

        return $group;
    }

    public function addButtons(array $buttons): self
    {
        foreach ($buttons as $button) {
            $this->buttons[] = $button;
        }
        return $this;
    }

    // Métodos fluidos opcionales
    public function size(string $size): self
    {
        $this->options['size'] = $size;
        return $this;
    }
    public function vertical(bool $vertical = true): self
    {
        $this->options['vertical'] = $vertical;
        return $this;
    }
}
