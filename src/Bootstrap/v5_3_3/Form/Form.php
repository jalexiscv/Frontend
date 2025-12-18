<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Form de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'action': string - URL de acción
 * - 'method': string - Método HTTP ('POST', 'GET') [default: 'POST']
 * - 'enctype': string - Enctype del form
 * - 'inline': bool - Si es inline (en desuso en BS5 pero soportado) [default: false]
 * - 'content': mixed - Contenido del formulario
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Form extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];
    private mixed $content = null;

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->content = $options['content'] ?? null;

        $this->options = [
            'action' => $options['action'] ?? null,
            'method' => $options['method'] ?? 'POST',
            'enctype' => $options['enctype'] ?? null,
            'inline' => $options['inline'] ?? false, // BS5 usa grid system para inline
        ];
    }

    public function render(): TagInterface
    {
        if ($this->options['action']) $this->attributes['action'] = $this->options['action'];
        $this->attributes['method'] = $this->options['method'];
        if ($this->options['enctype']) $this->attributes['enctype'] = $this->options['enctype'];

        if ($this->options['inline']) {
            $this->attributes['class'] = $this->mergeClasses(
                'row row-cols-lg-auto g-3 align-items-center',
                $this->attributes['class'] ?? null
            );
        }

        $form = $this->createComponent('form', $this->attributes);
        if ($this->content) {
            $form->content($this->content);
        }

        return $form;
    }

    public function addContent(mixed $content): self
    {
        if (is_array($this->content)) {
            $this->content[] = $content;
        } else {
            $this->content = array_merge((array)$this->content, [$content]);
        }
        return $this;
    }
}
