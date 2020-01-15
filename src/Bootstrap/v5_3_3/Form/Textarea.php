<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Textarea de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'name': string - Nombre
 * - 'id': string - ID
 * - 'value': string - Valor inicial
 * - 'placeholder': string - Placeholder
 * - 'label': string - Label superior (si existe, envuelve en div.mb-3)
 * - 'floating': bool - Floating label
 * - 'rows': int - Número de filas
 * - 'disabled': bool - Deshabilitado
 * - 'readonly': bool - Solo lectura
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Textarea extends AbstractComponent implements ComponentInterface
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
            'value' => $options['value'] ?? null,
            'placeholder' => $options['placeholder'] ?? null,
            'label' => $options['label'] ?? null,
            'floating' => $options['floating'] ?? false,
            'rows' => $options['rows'] ?? null,
            'disabled' => $options['disabled'] ?? false,
            'readonly' => $options['readonly'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'form-control',
            $this->attributes['class'] ?? null
        );

        if ($this->options['name']) $this->attributes['name'] = $this->options['name'];
        if ($this->options['id']) $this->attributes['id'] = $this->options['id'];
        if ($this->options['placeholder']) $this->attributes['placeholder'] = $this->options['placeholder'];
        if ($this->options['rows']) $this->attributes['rows'] = (string)$this->options['rows'];
        if ($this->options['disabled']) $this->attributes['disabled'] = 'disabled';
        if ($this->options['readonly']) $this->attributes['readonly'] = 'readonly';

        $textarea = Html::tag('textarea', $this->attributes, $this->options['value'] ?? '');

        // Wrapper si hay label
        if ($this->options['label']) {
            if ($this->options['floating']) {
                $wrapper = Html::tag('div', ['class' => 'form-floating mb-3']);
                if (!$this->options['placeholder']) $textarea->setAttribute('placeholder', $this->options['label']);
                $wrapper->addContent($textarea);
                $wrapper->addContent(Html::tag('label', ['for' => $this->attributes['id'] ?? ''], $this->options['label']));
                return $wrapper;
            } else {
                $wrapper = Html::tag('div', ['class' => 'mb-3']);
                $wrapper->addContent(Html::tag('label', ['for' => $this->attributes['id'] ?? '', 'class' => 'form-label'], $this->options['label']));
                $wrapper->addContent($textarea);
                return $wrapper;
            }
        }

        return $textarea;
    }
}
