<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Dropdown de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID opcional
 * - 'label': string - Texto del botón
 * - 'items': array - Items del menú [['label' => '', 'href' => '', 'divider' => bool, 'header' => bool]]
 * - 'variant': string - Variante de color [default: 'secondary']
 * - 'split': bool - Si es split button [default: false]
 * - 'dropup': bool - Si es dropup [default: false]
 * - 'dropend': bool - Si es dropend [default: false]
 * - 'dropstart': bool - Si es dropstart [default: false]
 * - 'dark': bool - Si es menú oscuro [default: false]
 * - 'size': string|null - Tamaño ('sm', 'lg')
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Dropdown extends AbstractComponent implements ComponentInterface
{
    private ?string $label = null;
    private array $items = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->label = $options['label'] ?? 'Dropdown';

        if (isset($options['items']) && is_array($options['items'])) {
            $this->items = $options['items'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'id' => $options['id'] ?? null,
            'variant' => $options['variant'] ?? 'secondary',
            'split' => $options['split'] ?? false,
            'dropup' => $options['dropup'] ?? false,
            'dropend' => $options['dropend'] ?? false,
            'dropstart' => $options['dropstart'] ?? false,
            'dark' => $options['dark'] ?? false,
            'size' => $options['size'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['btn-group'];
        if ($this->options['dropup']) $classes[] = 'dropup';
        if ($this->options['dropend']) $classes[] = 'dropend';
        if ($this->options['dropstart']) $classes[] = 'dropstart';

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $dropdown = $this->createComponent('div', $this->attributes);

        if ($this->options['split']) {
            $dropdown->content([$this->createButton(), $this->createToggle(true), $this->createMenu()]);
        } else {
            $dropdown->content([$this->createToggle(false), $this->createMenu()]);
        }

        return $dropdown;
    }

    protected function createButton(): TagInterface
    {
        $classes = ["btn", "btn-{$this->options['variant']}"];
        if ($this->options['size']) $classes[] = "btn-{$this->options['size']}";

        return Html::tag('button', [
            'class' => implode(' ', $classes),
            'type' => 'button'
        ], $this->label);
    }

    protected function createToggle(bool $isSplit): TagInterface
    {
        $classes = ["btn", "btn-{$this->options['variant']}", "dropdown-toggle"];
        if ($isSplit) $classes[] = "dropdown-toggle-split";
        if ($this->options['size']) $classes[] = "btn-{$this->options['size']}";

        $attrs = [
            'class' => implode(' ', $classes),
            'type' => 'button',
            'data-bs-toggle' => 'dropdown',
            'aria-expanded' => 'false'
        ];

        if ($this->options['id']) $attrs['id'] = $this->options['id'];

        $button = Html::tag('button', $attrs);

        if ($isSplit) {
            $button->content(Html::tag('span', ['class' => 'visually-hidden'], 'Toggle Dropdown'));
        } else {
            $button->content($this->label);
        }

        return $button;
    }

    protected function createMenu(): TagInterface
    {
        $classes = ['dropdown-menu'];
        if ($this->options['dark']) $classes[] = 'dropdown-menu-dark';

        $menu = Html::tag('ul', ['class' => implode(' ', $classes)]);
        $items = [];

        foreach ($this->items as $item) {
            if ($item['divider'] ?? false) {
                $items[] = Html::tag('li')->content(Html::tag('hr', ['class' => 'dropdown-divider']));
                continue;
            }

            if ($item['header'] ?? false) {
                $items[] = Html::tag('li')->content(
                    Html::tag('h6', ['class' => 'dropdown-header'], $item['label'] ?? '')
                );
                continue;
            }

            $link = Html::tag('a', [
                'class' => 'dropdown-item' . (($item['active'] ?? false) ? ' active' : ''),
                'href' => $item['href'] ?? '#'
            ], $item['label'] ?? '');

            $items[] = Html::tag('li')->content($link);
        }

        $menu->content($items);
        return $menu;
    }

    public function addItem(string $label, string $href = '#', bool $active = false): self
    {
        $this->items[] = ['label' => $label, 'href' => $href, 'active' => $active];
        return $this;
    }
}
