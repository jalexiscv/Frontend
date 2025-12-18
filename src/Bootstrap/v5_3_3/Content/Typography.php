<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Typography de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'tag': string - h1-h6, p, span, etc. [default: 'p']
 * - 'content': string - Texto
 * - 'display': int - Display size (1-6)
 * - 'lead': bool - Lead paragraph
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Typography extends AbstractComponent implements ComponentInterface
{
    private mixed $content = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->content = $options['content'] ?? '';

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'tag' => $options['tag'] ?? 'p',
            'display' => $options['display'] ?? null,
            'lead' => $options['lead'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $classes = [];
        if ($this->options['display']) $classes[] = "display-{$this->options['display']}";
        if ($this->options['lead']) $classes[] = 'lead';

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        return $this->createComponent($this->options['tag'], $this->attributes, $this->content);
    }
}
