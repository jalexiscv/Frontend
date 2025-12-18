<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Container de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'type': string - Tipo ('fluid', 'sm', 'md', 'lg', 'xl', 'xxl') [default: '']
 * - 'content': mixed - Contenido
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Container extends AbstractComponent implements ComponentInterface
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
            'type' => $options['type'] ?? '', // '' es container normal
        ];
    }

    public function render(): TagInterface
    {
        $class = 'container';
        if ($this->options['type']) {
            $class = "container-{$this->options['type']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            $class,
            $this->attributes['class'] ?? null
        );

        return $this->createComponent('div', $this->attributes, $this->content);
    }
}
