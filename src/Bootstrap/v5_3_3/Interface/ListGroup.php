<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente ListGroup de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'items': array - Lista de items [['content' => '', 'active' => bool, 'disabled' => bool, 'href' => '']]
 * - 'flush': bool - Si es flush [default: false]
 * - 'numbered': bool - Si es numerada [default: false]
 * - 'horizontal': bool|string - Si es horizontal o breakpoint ('sm', 'md', etc.) [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class ListGroup extends AbstractComponent implements ComponentInterface
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
            'flush' => $options['flush'] ?? false,
            'numbered' => $options['numbered'] ?? false,
            'horizontal' => $options['horizontal'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['list-group'];
        if ($this->options['flush']) $classes[] = 'list-group-flush';
        if ($this->options['numbered']) $classes[] = 'list-group-numbered';

        if ($this->options['horizontal']) {
            $classes[] = is_string($this->options['horizontal'])
                ? "list-group-horizontal-{$this->options['horizontal']}"
                : 'list-group-horizontal';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $tag = $this->hasLinks() ? 'div' : ($this->options['numbered'] ? 'ol' : 'ul');
        $list = $this->createComponent($tag, $this->attributes);
        $content = [];

        foreach ($this->items as $item) {
            $content[] = $this->createItem($item);
        }

        $list->content($content);
        return $list;
    }

    protected function createItem(array $item): TagInterface
    {
        $isLink = isset($item['href']);
        $tag = $isLink ? 'a' : 'li';

        $classes = ['list-group-item'];
        if ($isLink) {
            $classes[] = 'list-group-item-action';
        }
        if ($item['active'] ?? false) $classes[] = 'active';
        if ($item['disabled'] ?? false) $classes[] = 'disabled';
        if (isset($item['variant'])) $classes[] = "list-group-item-{$item['variant']}";

        $attrs = [
            'class' => implode(' ', $classes)
        ];

        if ($isLink) {
            $attrs['href'] = $item['href'];
            if ($item['active'] ?? false) $attrs['aria-current'] = 'true';
            if ($item['disabled'] ?? false) {
                $attrs['tabindex'] = '-1';
                $attrs['aria-disabled'] = 'true';
            }
        } elseif ($item['disabled'] ?? false) {
            $attrs['aria-disabled'] = 'true';
        }

        return Html::tag($tag, $attrs, $item['content'] ?? '');
    }

    protected function hasLinks(): bool
    {
        foreach ($this->items as $item) {
            if (isset($item['href'])) return true;
        }
        return false;
    }

    public function addItem(mixed $content, bool $active = false, bool $disabled = false): self
    {
        $this->items[] = [
            'content' => $content,
            'active' => $active,
            'disabled' => $disabled
        ];
        return $this;
    }

    // Métodos fluidos opcionales
    public function flush(bool $flush = true): self
    {
        $this->options['flush'] = $flush;
        return $this;
    }
    public function numbered(bool $numbered = true): self
    {
        $this->options['numbered'] = $numbered;
        return $this;
    }
    public function horizontal(bool|string $horizontal = true): self
    {
        $this->options['horizontal'] = $horizontal;
        return $this;
    }
}
