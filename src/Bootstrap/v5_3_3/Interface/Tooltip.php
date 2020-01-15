<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Tooltip de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'content': string - Texto del tooltip (requerido)
 * - 'placement': string - Posición ('top', 'right', 'bottom', 'left') [default: 'top']
 * - 'html': bool - Si el contenido es HTML [default: false]
 * - 'attributes': array - Atributos HTML del elemento trigger
 * 
 * @implements ComponentInterface
 */
class Tooltip extends AbstractComponent implements ComponentInterface
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
            'placement' => $options['placement'] ?? 'top',
            'html' => $options['html'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        // El tooltip se aplica sobre un elemento existente
        // Aquí asumimos que creamos un botón/link con el tooltip, 
        // o si se pasa un 'tag' específico lo usamos.

        $tag = $this->attributes['tag'] ?? 'button';
        unset($this->attributes['tag']);

        if ($tag === 'button' && !isset($this->attributes['type'])) {
            $this->attributes['type'] = 'button';
        }

        if ($tag === 'button' && !isset($this->attributes['class'])) {
            $this->attributes['class'] = 'btn btn-secondary';
        }

        $this->attributes['data-bs-toggle'] = 'tooltip';
        $this->attributes['data-bs-placement'] = $this->options['placement'];
        $this->attributes['title'] = $this->content;

        if ($this->options['html']) {
            $this->attributes['data-bs-html'] = 'true';
        }

        return $this->createComponent($tag, $this->attributes)
            ->content($this->attributes['label'] ?? 'Tooltip');
    }
}
