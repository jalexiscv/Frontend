<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente InputGroup de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'prepend': mixed - Contenido a prepender (string o array)
 * - 'append': mixed - Contenido a apender (string o array)
 * - 'content': mixed - Input principal
 * - 'size': string - 'sm', 'lg'
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class InputGroup extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'prepend' => $options['prepend'] ?? null,
            'append' => $options['append'] ?? null,
            'content' => $options['content'] ?? null,
            'size' => $options['size'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['input-group', 'mb-3'];
        if ($this->options['size']) $classes[] = "input-group-{$this->options['size']}";

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $group = Html::tag('div', $this->attributes);
        $contents = [];

        if ($this->options['prepend']) {
            foreach ((array)$this->options['prepend'] as $item) {
                $contents[] = $this->wrapAddon($item);
            }
        }

        if ($this->options['content']) {
            $contents[] = $this->options['content'];
        }

        if ($this->options['append']) {
            foreach ((array)$this->options['append'] as $item) {
                $contents[] = $this->wrapAddon($item);
            }
        }

        $group->content($contents);
        return $group;
    }

    protected function wrapAddon(mixed $item): TagInterface|string
    {
        if (is_string($item)) {
            return Html::tag('span', ['class' => 'input-group-text'], $item);
        }
        return $item;
    }
}
