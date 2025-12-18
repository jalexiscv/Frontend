<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Grid extends AbstractComponent
{
    private array $columns;
    private array $attributes;
    private ?int $gutters;

    public function __construct(array $attributes = [], ?int $gutters = null)
    {
        $this->columns = [];
        $this->attributes = $attributes;
        $this->gutters = $gutters;
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'row',
            $this->attributes['class'] ?? null
        );

        if ($this->gutters !== null) {
            $this->attributes['class'] = $this->mergeClasses(
                $this->attributes['class'],
                "g-{$this->gutters}"
            );
        }

        $row = $this->createComponent('row', $this->attributes);
        $row->content($this->columns);

        return $row;
    }

    public function addColumn(mixed $content, array $sizes = [], array $attributes = []): self
    {
        $class = '';
        foreach ($sizes as $breakpoint => $size) {
            if ($breakpoint === 'xs') {
                $class .= " col-{$size}";
            } else {
                $class .= " col-{$breakpoint}-{$size}";
            }
        }

        if (empty($sizes)) {
            $class = 'col';
        }

        $attributes['class'] = $this->mergeClasses(
            trim($class),
            $attributes['class'] ?? null
        );

        $column = $this->createComponent('column', $attributes);
        $column->content($content);
        $this->columns[] = $column;

        return $this;
    }

    public function addEqualColumns(array $contents, array $attributes = []): self
    {
        foreach ($contents as $content) {
            $this->addColumn($content, [], $attributes);
        }
        return $this;
    }

    public function addResponsiveColumns(array $columns): self
    {
        foreach ($columns as $column) {
            $this->addColumn(
                $column['content'],
                $column['sizes'] ?? [],
                $column['attributes'] ?? []
            );
        }
        return $this;
    }

    public static function create(int $columns = 2, ?int $gutters = null): self
    {
        return new self([], $gutters);
    }
}
