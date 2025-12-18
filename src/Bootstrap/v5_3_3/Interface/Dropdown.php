<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

class Dropdown extends AbstractComponent
{
    private string $text;
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(
        string $text,
        array $items = [],
        array $attributes = [],
        array $options = []
    ) {
        $this->text = $text;
        $this->items = $items;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'variant' => 'primary',
            'split' => false,
            'size' => null,
            'direction' => null, // up, end, start
            'dark' => false,
            'alignment' => null, // end, start
            'autoClose' => true,
        ], $options);
    }

    public function render(): TagInterface
    {
        if ($this->options['split']) {
            return $this->renderSplitButton();
        }

        return $this->renderSingleButton();
    }

    protected function renderSingleButton(): TagInterface
    {
        $wrapper = $this->createWrapper();

        $button = Button::create($this->text)
            ->setVariant($this->options['variant'])
            ->size($this->options['size'] ?? '')
            ->render();

        $this->addDropdownAttributes($button);

        $wrapper->content([
            $button,
            $this->createMenu()
        ]);

        return $wrapper;
    }

    protected function renderSplitButton(): TagInterface
    {
        $wrapper = $this->createWrapper();
        $wrapper->content([
            Button::create($this->text)
                ->setVariant($this->options['variant'])
                ->size($this->options['size'] ?? '')
                ->render(),
            $this->createSplitToggle(),
            $this->createMenu()
        ]);

        return $wrapper;
    }

    protected function createWrapper(): TagInterface
    {
        $classes = ['btn-group'];

        if ($this->options['direction']) {
            $classes[] = "drop{$this->options['direction']}";
        }

        return Html::tag('div', [
            'class' => implode(' ', $classes)
        ]);
    }

    protected function createSplitToggle(): TagInterface
    {
        $toggle = Button::create('')
            ->setVariant($this->options['variant'])
            ->size($this->options['size'] ?? '')
            ->render();

        $this->addDropdownAttributes($toggle);
        $toggle->content(Html::tag('span', ['class' => 'visually-hidden'], 'Toggle Dropdown'));

        return $toggle;
    }

    protected function addDropdownAttributes(TagInterface $element): void
    {
        $element->setAttribute('data-bs-toggle', 'dropdown');
        $element->setAttribute('aria-expanded', 'false');

        if ($this->options['split']) {
            $element->addClass('dropdown-toggle-split');
        } else {
            $element->addClass('dropdown-toggle');
        }

        if (!$this->options['autoClose']) {
            $element->setAttribute('data-bs-auto-close', 'false');
        }
    }

    protected function createMenu(): TagInterface
    {
        $classes = ['dropdown-menu'];

        if ($this->options['dark']) {
            $classes[] = 'dropdown-menu-dark';
        }

        if ($this->options['alignment']) {
            $classes[] = "dropdown-menu-{$this->options['alignment']}";
        }

        $menu = Html::tag('ul', ['class' => implode(' ', $classes)]);

        foreach ($this->items as $item) {
            if ($item === 'divider') {
                $menu->content(Html::tag('li')->content(
                    Html::tag('hr', ['class' => 'dropdown-divider'])
                ));
                continue;
            }

            if ($item === 'header') {
                $menu->content(Html::tag('li')->content(
                    Html::tag('h6', ['class' => 'dropdown-header'], $item['text'])
                ));
                continue;
            }

            $attributes = ['class' => 'dropdown-item'];
            if (isset($item['disabled']) && $item['disabled']) {
                $attributes['class'] .= ' disabled';
                $attributes['aria-disabled'] = 'true';
                $attributes['tabindex'] = '-1';
            }

            if (isset($item['active']) && $item['active']) {
                $attributes['class'] .= ' active';
                $attributes['aria-current'] = 'true';
            }

            $menuItem = Html::tag('li')->content(
                Html::tag('a', array_merge($attributes, [
                    'href' => $item['href'] ?? '#'
                ]), $item['text'])
            );

            $menu->content($menuItem);
        }

        return $menu;
    }

    public static function create(string $text): self
    {
        return new self($text);
    }

    public function addItem(string $text, ?string $href = null, array $attributes = []): self
    {
        $this->items[] = array_merge(['text' => $text, 'href' => $href], $attributes);
        return $this;
    }

    public function addDivider(): self
    {
        $this->items[] = 'divider';
        return $this;
    }

    public function addHeader(string $text): self
    {
        $this->items[] = ['header' => true, 'text' => $text];
        return $this;
    }

    public function setVariant(string $variant): self
    {
        $this->options['variant'] = $variant;
        return $this;
    }

    public function split(bool $split = true): self
    {
        $this->options['split'] = $split;
        return $this;
    }

    public function size(string $size): self
    {
        $this->options['size'] = $size;
        return $this;
    }

    public function direction(string $direction): self
    {
        $this->options['direction'] = $direction;
        return $this;
    }

    public function dark(bool $dark = true): self
    {
        $this->options['dark'] = $dark;
        return $this;
    }

    public function alignment(string $alignment): self
    {
        $this->options['alignment'] = $alignment;
        return $this;
    }

    public function autoClose(bool $autoClose = true): self
    {
        $this->options['autoClose'] = $autoClose;
        return $this;
    }
}
