<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Table de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'header': array - Encabezados de tabla (th)
 * - 'rows': array - Filas de datos (td)
 * - 'striped': bool|string - 'columns' or bool [default: false]
 * - 'hover': bool - Hoverable rows [default: false]
 * - 'bordered': bool - Bordered table [default: false]
 * - 'borderless': bool - Borderless table [default: false]
 * - 'small': bool - Small table [default: false]
 * - 'variant': string - Theme variant ('primary', 'dark', etc.)
 * - 'caption': string - Caption text
 * - 'captionTop': bool - Caption placement [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Table extends AbstractComponent implements ComponentInterface
{
    private array $bodyRows = [];
    private array $header = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->header = $options['header'] ?? [];
        $this->bodyRows = $options['rows'] ?? [];

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'striped' => $options['striped'] ?? false,
            'hover' => $options['hover'] ?? false,
            'bordered' => $options['bordered'] ?? false,
            'borderless' => $options['borderless'] ?? false,
            'small' => $options['small'] ?? false,
            'variant' => $options['variant'] ?? null,
            'caption' => $options['caption'] ?? null,
            'captionTop' => $options['captionTop'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['table'];
        if ($this->options['striped']) $classes[] = $this->options['striped'] === 'columns' ? 'table-striped-columns' : 'table-striped';
        if ($this->options['hover']) $classes[] = 'table-hover';
        if ($this->options['bordered']) $classes[] = 'table-bordered';
        if ($this->options['borderless']) $classes[] = 'table-borderless';
        if ($this->options['small']) $classes[] = 'table-sm';
        if ($this->options['variant']) $classes[] = "table-{$this->options['variant']}";
        if ($this->options['captionTop']) $classes[] = 'caption-top';

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $table = $this->createComponent('table', $this->attributes);
        $contents = [];

        if ($this->options['caption']) {
            $contents[] = Html::tag('caption', [], $this->options['caption']);
        }

        if (!empty($this->header)) {
            $thead = Html::tag('thead');
            $tr = Html::tag('tr');
            foreach ($this->header as $h) {
                $tr->addContent(Html::tag('th', ['scope' => 'col'], $h));
            }
            $thead->content($tr);
            $contents[] = $thead;
        }

        if (!empty($this->bodyRows)) {
            $tbody = Html::tag('tbody');
            foreach ($this->bodyRows as $row) {
                $tr = Html::tag('tr');
                if (is_array($row)) {
                    foreach ($row as $cell) {
                        $tr->addContent(Html::tag('td', [], $cell));
                    }
                } else {
                    // Assume we might want literal row content, but usually safer to stick to structure
                    $tr->content($row);
                }
                $tbody->addContent($tr);
            }
            $contents[] = $tbody;
        }

        $table->content($contents);
        return $table;
    }
}
