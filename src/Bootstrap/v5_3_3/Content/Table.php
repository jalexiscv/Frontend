<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Table extends AbstractComponent
{
    private array $headers;
    private array $rows;
    private array $attributes;
    private array $options;

    public function __construct(
        array $headers = [],
        array $rows = [],
        array $attributes = [],
        array $options = []
    ) {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'striped' => false,
            'bordered' => false,
            'hover' => false,
            'small' => false,
            'responsive' => false,
            'dark' => false,
            'caption' => null,
            'captionTop' => false,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareTableClasses();

        if ($this->options['responsive']) {
            return $this->renderResponsiveWrapper();
        }

        return $this->renderTable();
    }

    private function prepareTableClasses(): void
    {
        $classes = ['table'];

        if ($this->options['striped']) {
            $classes[] = 'table-striped';
        }
        if ($this->options['bordered']) {
            $classes[] = 'table-bordered';
        }
        if ($this->options['hover']) {
            $classes[] = 'table-hover';
        }
        if ($this->options['small']) {
            $classes[] = 'table-sm';
        }
        if ($this->options['dark']) {
            $classes[] = 'table-dark';
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    private function renderTable(): TagInterface
    {
        $table = $this->createComponent('table', $this->attributes);
        $elements = [];

        // Caption
        if ($this->options['caption']) {
            $captionAttrs = [];
            if ($this->options['captionTop']) {
                $captionAttrs['class'] = 'caption-top';
            }
            $elements[] = Html::tag('caption', $captionAttrs, $this->options['caption']);
        }

        // Headers
        if (!empty($this->headers)) {
            $headerRow = Html::tag('tr');
            foreach ($this->headers as $header) {
                if (is_array($header)) {
                    $headerRow->content(Html::tag('th', $header['attributes'] ?? [], $header['content']));
                } else {
                    $headerRow->content(Html::tag('th', [], $header));
                }
            }
            $elements[] = Html::tag('thead')->content($headerRow);
        }

        // Rows
        if (!empty($this->rows)) {
            $tbody = Html::tag('tbody');
            foreach ($this->rows as $row) {
                $tr = Html::tag('tr');
                foreach ($row as $cell) {
                    if (is_array($cell)) {
                        $tr->content(Html::tag('td', $cell['attributes'] ?? [], $cell['content']));
                    } else {
                        $tr->content(Html::tag('td', [], $cell));
                    }
                }
                $tbody->content($tr);
            }
            $elements[] = $tbody;
        }

        $table->content($elements);
        return $table;
    }

    private function renderResponsiveWrapper(): TagInterface
    {
        $wrapper = Html::tag('div', [
            'class' => is_string($this->options['responsive'])
                ? "table-responsive-{$this->options['responsive']}"
                : 'table-responsive'
        ]);
        
        $wrapper->content($this->renderTable());
        return $wrapper;
    }

    public static function create(): self
    {
        return new self();
    }

    public function addHeader(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function addRow(array $row): self
    {
        $this->rows[] = $row;
        return $this;
    }

    public function addRows(array $rows): self
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
        return $this;
    }

    public function striped(bool $value = true): self
    {
        $this->options['striped'] = $value;
        return $this;
    }

    public function bordered(bool $value = true): self
    {
        $this->options['bordered'] = $value;
        return $this;
    }

    public function hover(bool $value = true): self
    {
        $this->options['hover'] = $value;
        return $this;
    }

    public function small(bool $value = true): self
    {
        $this->options['small'] = $value;
        return $this;
    }

    public function dark(bool $value = true): self
    {
        $this->options['dark'] = $value;
        return $this;
    }

    public function responsive(bool|string $value = true): self
    {
        $this->options['responsive'] = $value;
        return $this;
    }

    public function caption(string $caption, bool $top = false): self
    {
        $this->options['caption'] = $caption;
        $this->options['captionTop'] = $top;
        return $this;
    }
}
