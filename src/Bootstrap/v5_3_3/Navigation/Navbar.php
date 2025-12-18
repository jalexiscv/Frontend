<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Navbar extends AbstractComponent
{
    private array $brand;
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->brand = [];
        $this->items = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'expand' => 'lg',
            'scheme' => 'light',
            'background' => 'light',
            'container' => true,
            'fixed' => null, // top, bottom
            'sticky' => false,
            'offcanvas' => false,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareClasses();

        $navbar = $this->createComponent('nav', $this->attributes);

        $content = [];

        // Brand
        if (!empty($this->brand)) {
            $content[] = $this->renderBrand();
        }

        // Toggler
        if (!empty($this->items)) {
            $content[] = $this->renderToggler();
        }

        // Collapse/Offcanvas
        if (!empty($this->items)) {
            $content[] = $this->renderCollapse();
        }

        if ($this->options['container']) {
            $container = Html::tag('div', ['class' => 'container-fluid']);
            $container->content($content);
            $navbar->content($container);
        } else {
            $navbar->content($content);
        }

        return $navbar;
    }



    protected function prepareClasses(): void
    {
        $classes = ['navbar'];

        if ($this->options['expand']) {
            $classes[] = "navbar-expand-{$this->options['expand']}";
        }

        $classes[] = "navbar-{$this->options['scheme']}";
        $classes[] = "bg-{$this->options['background']}";

        if ($this->options['fixed']) {
            $classes[] = "fixed-{$this->options['fixed']}";
        }

        if ($this->options['sticky']) {
            $classes[] = 'sticky-top';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    protected function renderBrand(): TagInterface
    {
        $attributes = array_merge([
            'class' => 'navbar-brand',
            'href' => '#'
        ], $this->brand['attributes'] ?? []);

        return Html::tag('a', $attributes, $this->brand['content']);
    }

    protected function renderToggler(): TagInterface
    {
        $id = $this->attributes['id'] ?? 'navbar';
        $target = $this->options['offcanvas'] ? "{$id}Offcanvas" : "{$id}Collapse";

        return Html::tag('button', [
            'class' => 'navbar-toggler',
            'type' => 'button',
            'data-bs-toggle' => $this->options['offcanvas'] ? 'offcanvas' : 'collapse',
            'data-bs-target' => "#{$target}",
            'aria-controls' => $target,
            'aria-expanded' => 'false',
            'aria-label' => 'Toggle navigation'
        ])->content(
            Html::tag('span', ['class' => 'navbar-toggler-icon'])
        );
    }

    protected function renderCollapse(): TagInterface
    {
        $id = $this->attributes['id'] ?? 'navbar';

        if ($this->options['offcanvas']) {
            return $this->renderOffcanvas($id);
        }

        $collapse = Html::tag('div', [
            'class' => 'collapse navbar-collapse',
            'id' => "{$id}Collapse"
        ]);

        $collapse->content($this->renderNavItems());
        return $collapse;
    }

    protected function renderOffcanvas(string $id): TagInterface
    {
        $offcanvas = Html::tag('div', [
            'class' => 'offcanvas offcanvas-end',
            'tabindex' => '-1',
            'id' => "{$id}Offcanvas"
        ]);

        $header = Html::tag('div', ['class' => 'offcanvas-header'])->content([
            Html::tag('h5', ['class' => 'offcanvas-title'], $this->brand['content'] ?? 'Menu'),
            Html::tag('button', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'offcanvas',
                'aria-label' => 'Close'
            ])
        ]);

        $body = Html::tag('div', ['class' => 'offcanvas-body'])->content(
            $this->renderNavItems()
        );

        $offcanvas->content([$header, $body]);
        return $offcanvas;
    }

    protected function renderNavItems(): array
    {
        $items = [];

        if (!empty($this->items['start'])) {
            $items[] = Html::tag('ul', ['class' => 'navbar-nav me-auto mb-2 mb-lg-0'])
                ->content($this->items['start']);
        }

        if (!empty($this->items['end'])) {
            $items[] = Html::tag('ul', ['class' => 'navbar-nav'])
                ->content($this->items['end']);
        }

        if (!empty($this->items['form'])) {
            $items[] = $this->items['form'];
        }

        return $items;
    }

    public function setBrand(string $content, ?string $href = null, array $attributes = []): self
    {
        $this->brand = [
            'content' => $content,
            'attributes' => array_merge(['href' => $href ?? '#'], $attributes)
        ];
        return $this;
    }

    public function addItem(string $content, ?string $href = null, array $attributes = [], string $position = 'start'): self
    {
        $item = $this->createNavItem($content, $href, $attributes);
        $this->items[$position][] = $item;
        return $this;
    }

    public function addDropdown(string $text, array $items, array $attributes = [], string $position = 'start'): self
    {
        $dropdown = $this->createDropdown($text, $items, $attributes);
        $this->items[$position][] = $dropdown;
        return $this;
    }

    public function addForm(TagInterface $form, string $position = 'start'): self
    {
        $this->items['form'] = $form;
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

    public function expand(?string $breakpoint): self
    {
        $this->options['expand'] = $breakpoint;
        return $this;
    }

    public function scheme(string $scheme): self
    {
        $this->options['scheme'] = $scheme;
        return $this;
    }

    public function background(string $color): self
    {
        $this->options['background'] = $color;
        return $this;
    }

    public function container(bool $container = true): self
    {
        $this->options['container'] = $container;
        return $this;
    }

    public function fixed(?string $position): self
    {
        $this->options['fixed'] = $position;
        return $this;
    }

    public function sticky(bool $sticky = true): self
    {
        $this->options['sticky'] = $sticky;
        return $this;
    }

    public function offcanvas(bool $offcanvas = true): self
    {
        $this->options['offcanvas'] = $offcanvas;
        return $this;
    }
}
