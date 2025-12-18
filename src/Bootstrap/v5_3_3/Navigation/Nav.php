<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Nav extends AbstractComponent
{
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->items = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'type' => 'nav', // nav, tabs, pills
            'fill' => false,
            'justified' => false,
            'vertical' => false,
            'alignment' => null, // center, end
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareClasses();
        $nav = $this->createComponent('ul', $this->attributes);
        $nav->content($this->items);
        return $nav;
    }

    protected function prepareClasses(): void
    {
        $classes = ['nav'];

        if ($this->options['type'] !== 'nav') {
            $classes[] = "nav-{$this->options['type']}";
        }

        if ($this->options['fill']) {
            $classes[] = 'nav-fill';
        }

        if ($this->options['justified']) {
            $classes[] = 'nav-justified';
        }

        if ($this->options['vertical']) {
            $classes[] = 'flex-column';
        }

        if ($this->options['alignment']) {
            $classes[] = "justify-content-{$this->options['alignment']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    public function addItem(string $content, ?string $href = null, array $attributes = []): self
    {
        $item = $this->createNavItem($content, $href, $attributes);
        $this->items[] = $item;
        return $this;
    }

    public function addDropdown(string $text, array $items, array $attributes = []): self
    {
        $dropdown = $this->createDropdown($text, $items, $attributes);
        $this->items[] = $dropdown;
        return $this;
    }

    protected function createNavItem(string $content, ?string $href, array $attributes = []): TagInterface
    {
        $li = Html::tag('li', ['class' => 'nav-item']);
        
        $linkAttributes = array_merge([
            'class' => 'nav-link',
            'href' => $href ?? '#'
        ], $attributes);

        if (isset($attributes['active'])) {
            $linkAttributes['class'] .= ' active';
            $linkAttributes['aria-current'] = 'page';
        }

        if (isset($attributes['disabled'])) {
            $linkAttributes['class'] .= ' disabled';
            $linkAttributes['tabindex'] = '-1';
            $linkAttributes['aria-disabled'] = 'true';
        }

        $link = Html::tag('a', $linkAttributes, $content);
        $li->content($link);

        return $li;
    }

    protected function createDropdown(string $text, array $items, array $attributes = []): TagInterface
    {
        $li = Html::tag('li', ['class' => 'nav-item dropdown']);
        
        $toggle = Html::tag('a', [
            'class' => 'nav-link dropdown-toggle',
            'href' => '#',
            'role' => 'button',
            'data-bs-toggle' => 'dropdown',
            'aria-expanded' => 'false'
        ], $text);

        $menu = Html::tag('ul', ['class' => 'dropdown-menu']);
        foreach ($items as $item) {
            if ($item === 'divider') {
                $menu->content(Html::tag('li')->content(
                    Html::tag('hr', ['class' => 'dropdown-divider'])
                ));
                continue;
            }

            $menuItem = Html::tag('li')->content(
                Html::tag('a', [
                    'class' => 'dropdown-item',
                    'href' => $item['href'] ?? '#'
                ], $item['text'])
            );
            $menu->content($menuItem);
        }

        $li->content([$toggle, $menu]);
        return $li;
    }

    public static function create(): self
    {
        return new self();
    }

    public function tabs(): self
    {
        $this->options['type'] = 'tabs';
        return $this;
    }

    public function pills(): self
    {
        $this->options['type'] = 'pills';
        return $this;
    }

    public function fill(): self
    {
        $this->options['fill'] = true;
        return $this;
    }

    public function justified(): self
    {
        $this->options['justified'] = true;
        return $this;
    }

    public function vertical(): self
    {
        $this->options['vertical'] = true;
        return $this;
    }

    public function align(string $alignment): self
    {
        $this->options['alignment'] = $alignment;
        return $this;
    }
}
