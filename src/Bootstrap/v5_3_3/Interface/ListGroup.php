<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class ListGroup extends AbstractComponent
{
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->items = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'flush' => false,
            'numbered' => false,
            'horizontal' => false,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareClasses();
        $list = $this->createComponent($this->options['numbered'] ? 'ol' : 'ul', $this->attributes);
        $list->content($this->items);
        return $list;
    }

    protected function prepareClasses(): void
    {
        $classes = ['list-group'];

        if ($this->options['flush']) {
            $classes[] = 'list-group-flush';
        }

        if ($this->options['numbered']) {
            $classes[] = 'list-group-numbered';
        }

        if ($this->options['horizontal']) {
            $classes[] = is_string($this->options['horizontal'])
                ? "list-group-horizontal-{$this->options['horizontal']}"
                : 'list-group-horizontal';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    protected function createItem(
        string $content,
        ?string $href = null,
        array $attributes = []
    ): TagInterface {
        $classes = ['list-group-item'];

        if (isset($attributes['active'])) {
            $classes[] = 'active';
        }

        if (isset($attributes['disabled'])) {
            $classes[] = 'disabled';
        }

        if (isset($attributes['variant'])) {
            $classes[] = "list-group-item-{$attributes['variant']}";
        }

        if ($href || isset($attributes['action'])) {
            $classes[] = 'list-group-item-action';
        }

        $itemAttributes = array_merge($attributes, [
            'class' => implode(' ', $classes)
        ]);

        if ($href) {
            $itemAttributes['href'] = $href;
            return Html::tag('a', $itemAttributes, $content);
        }

        return Html::tag('li', $itemAttributes, $content);
    }

    public function addItem(string $content, ?string $href = null, array $attributes = []): self
    {
        $this->items[] = $this->createItem($content, $href, $attributes);
        return $this;
    }

    public function addItems(array $items): self
    {
        foreach ($items as $item) {
            $this->addItem(
                $item['content'],
                $item['href'] ?? null,
                $item['attributes'] ?? []
            );
        }
        return $this;
    }

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

    public function horizontal(bool|string $breakpoint = true): self
    {
        $this->options['horizontal'] = $breakpoint;
        return $this;
    }

    public static function create(): self
    {
        return new self();
    }
}
