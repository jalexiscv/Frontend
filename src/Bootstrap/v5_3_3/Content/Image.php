<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Image de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'src': string - Source URL (requerido)
 * - 'alt': string - Alt text
 * - 'fluid': bool - Responsive image [default: true]
 * - 'thumbnail': bool - Thumbnail style [default: false]
 * - 'rounded': bool - Corners [default: false]
 * - 'align': string - 'start', 'end', 'center' (floats or d-block associated)
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Image extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'src' => $options['src'] ?? '#',
            'alt' => $options['alt'] ?? '',
            'fluid' => $options['fluid'] ?? true, // Default to fluid usually good for BS
            'thumbnail' => $options['thumbnail'] ?? false,
            'rounded' => $options['rounded'] ?? false,
            'align' => $options['align'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = [];
        if ($this->options['fluid']) $classes[] = 'img-fluid';
        if ($this->options['thumbnail']) $classes[] = 'img-thumbnail';
        if ($this->options['rounded']) $classes[] = 'rounded';

        if ($this->options['align']) {
            if ($this->options['align'] === 'center') {
                $classes[] = 'd-block mx-auto';
            } else {
                $classes[] = "float-{$this->options['align']}";
            }
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['src'] = $this->options['src'];
        $this->attributes['alt'] = $this->options['alt'];

        return $this->createComponent('img', $this->attributes);
    }
}
