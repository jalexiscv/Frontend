<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Row de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'cols': int|string - 'row-cols-*' ('1', '2', 'auto')
 * - 'colsSm': int|string
 * - 'colsMd': int|string
 * - 'colsLg': int|string
 * - 'colsXl': int|string
 * - 'colsXxl': int|string
 * - 'gutter': int|string - 'g-*' (0-5)
 * - 'gutterX': int|string - 'gx-*'
 * - 'gutterY': int|string - 'gy-*'
 * - 'content': mixed - Contenido
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Row extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private mixed $content = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->content = $this->processContent($options);

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'cols' => $options['cols'] ?? null,
            'colsSm' => $options['colsSm'] ?? null,
            'colsMd' => $options['colsMd'] ?? null,
            'colsLg' => $options['colsLg'] ?? null,
            'colsXl' => $options['colsXl'] ?? null,
            'colsXxl' => $options['colsXxl'] ?? null,
            'gutter' => $options['gutter'] ?? null,
            'gutterX' => $options['gutterX'] ?? null,
            'gutterY' => $options['gutterY'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['row'];

        if ($this->options['cols']) $classes[] = "row-cols-{$this->options['cols']}";
        if ($this->options['colsSm']) $classes[] = "row-cols-sm-{$this->options['colsSm']}";
        if ($this->options['colsMd']) $classes[] = "row-cols-md-{$this->options['colsMd']}";
        if ($this->options['colsLg']) $classes[] = "row-cols-lg-{$this->options['colsLg']}";
        if ($this->options['colsXl']) $classes[] = "row-cols-xl-{$this->options['colsXl']}";
        if ($this->options['colsXxl']) $classes[] = "row-cols-xxl-{$this->options['colsXxl']}";

        if ($this->options['gutter'] !== null) $classes[] = "g-{$this->options['gutter']}";
        if ($this->options['gutterX'] !== null) $classes[] = "gx-{$this->options['gutterX']}";
        if ($this->options['gutterY'] !== null) $classes[] = "gy-{$this->options['gutterY']}";

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        return $this->createComponent('div', $this->attributes, $this->content);
    }
}
