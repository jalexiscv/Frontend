<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Nav de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'items': array - Items [['label' => '', 'href' => '', 'active' => bool, 'disabled' => bool]]
 * - 'variant': string - 'tabs', 'pills', 'underline'
 * - 'fill': bool - Fill items [default: false]
 * - 'justified': bool - Justify items [default: false]
 * - 'vertical': bool - Vertical layout [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Nav extends AbstractComponent implements ComponentInterface
{
    private array $items = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['items']) && is_array($options['items'])) {
            $this->items = $options['items'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'variant' => $options['variant'] ?? null,
            'fill' => $options['fill'] ?? false,
            'justified' => $options['justified'] ?? false,
            'vertical' => $options['vertical'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['nav'];
        if ($this->options['variant']) $classes[] = "nav-{$this->options['variant']}";
        if ($this->options['fill']) $classes[] = 'nav-fill';
        if ($this->options['justified']) $classes[] = 'nav-justified';
        if ($this->options['vertical']) $classes[] = 'flex-column';

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $nav = $this->createComponent('ul', $this->attributes);
        $listItems = [];

        foreach ($this->items as $item) {
            $listItems[] = $this->createItem($item);
        }

        $nav->content($listItems);
        return $nav;
    }

    protected function createItem(array $item): TagInterface
    {
        $li = Html::tag('li', ['class' => 'nav-item']);

        $linkClasses = ['nav-link'];
        if ($item['active'] ?? false) $linkClasses[] = 'active';
        if ($item['disabled'] ?? false) $linkClasses[] = 'disabled';

        $attrs = [
            'class' => implode(' ', $linkClasses),
            'href' => $item['href'] ?? '#'
        ];

        if ($item['active'] ?? false) $attrs['aria-current'] = 'page';
        if ($item['disabled'] ?? false) {
            $attrs['tabindex'] = '-1';
            $attrs['aria-disabled'] = 'true';
        }

        $link = Html::tag('a', $attrs, $item['label']);
        $li->content($link);

        return $li;
    }

    public function addItem(string $label, string $href = '#', bool $active = false, bool $disabled = false): self
    {
        $this->items[] = [
            'label' => $label,
            'href' => $href,
            'active' => $active,
            'disabled' => $disabled
        ];
        return $this;
    }
}
