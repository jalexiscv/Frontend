<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Figure de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'image': mixed - Contenido de imagen (tag o string src)
 * - 'caption': string - Caption del figure
 * - 'align': string - Alineación del caption ('start', 'end', 'center')
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Figure extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'image' => $options['image'] ?? null,
            'caption' => $options['caption'] ?? null,
            'align' => $options['align'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'figure',
            $this->attributes['class'] ?? null
        );

        $figure = $this->createComponent('figure', $this->attributes);

        if ($this->options['image']) {
            if (is_string($this->options['image'])) {
                // Assume it's a src URL if string
                // But better to expect a TagInterface or use Image component
                // For simplicity here, if it's string, we create an Image component
                $figure->addContent((new Image(['src' => $this->options['image'], 'class' => 'figure-img img-fluid rounded']))->render());
            } else {
                // Assume TagInterface
                $figure->addContent($this->options['image']);
            }
        }

        if ($this->options['caption']) {
            $captionClasses = ['figure-caption'];
            if ($this->options['align']) $captionClasses[] = "text-{$this->options['align']}";

            $figure->addContent($this->createComponent('figcaption', ['class' => implode(' ', $captionClasses)], $this->options['caption']));
        }

        return $figure;
    }
}
