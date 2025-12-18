<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Grid de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'content': mixed - Contenido
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Grid extends AbstractComponent implements ComponentInterface
{
    private mixed $content = null;
    private array $attributes = [];

    public function __construct(array $options = [])
    {
        $this->content = $options['content'] ?? null;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'grid', // CSS Grid (experimental/opt-in in BS5, or generic wrapper)
            $this->attributes['class'] ?? null
        );

        return $this->createComponent('div', $this->attributes, $this->content);
    }
}
