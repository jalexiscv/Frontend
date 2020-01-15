<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente File de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'name': string - Nombre del input
 * - 'id': string - ID opcional
 * - 'label': string - Etiqueta
 * - 'multiple': bool - Si permite múltiples archivos [default: false]
 * - 'disabled': bool - Si está deshabilitado [default: false]
 * - 'size': string|null - Tamaño ('sm', 'lg') [default: null]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class File extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'name' => $options['name'] ?? null,
            'id' => $options['id'] ?? null,
            'label' => $options['label'] ?? null,
            'multiple' => $options['multiple'] ?? false,
            'disabled' => $options['disabled'] ?? false,
            'size' => $options['size'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $container = Html::tag('div', ['class' => 'mb-3']);
        $inputId = $this->options['id'] ?? ($this->options['name'] ? $this->options['name'] . '_' . uniqid() : uniqid('file_'));

        if ($this->options['label']) {
            $container->addContent(Html::tag('label', [
                'for' => $inputId,
                'class' => 'form-label'
            ], $this->options['label']));
        }

        $this->attributes['type'] = 'file';
        $classes = ['form-control'];
        if ($this->options['size']) $classes[] = "form-control-{$this->options['size']}";

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
        $this->attributes['id'] = $inputId;

        if ($this->options['name']) $this->attributes['name'] = $this->options['name'];
        if ($this->options['multiple']) $this->attributes['multiple'] = 'multiple';
        if ($this->options['disabled']) $this->attributes['disabled'] = 'disabled';

        $input = Html::tag('input', $this->attributes);
        $container->addContent($input);

        return $container;
    }
}
