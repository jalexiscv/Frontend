<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Input de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'type': string - Tipo ('text', 'email', 'password', etc.) [default: 'text']
 * - 'name': string - Nombre del input
 * - 'id': string - ID del input
 * - 'value': string - Valor
 * - 'placeholder': string - Placeholder
 * - 'label': string - Label superior (si se incluye, envuelve en div.mb-3)
 * - 'floating': bool - Floating label (requiere label)
 * - 'disabled': bool - Deshabilitado
 * - 'readonly': bool - Solo lectura
 * - 'size': string - 'sm', 'lg'
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Input extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'type' => $options['type'] ?? 'text',
            'name' => $options['name'] ?? null,
            'id' => $options['id'] ?? null,
            'value' => $options['value'] ?? null,
            'placeholder' => $options['placeholder'] ?? null,
            'label' => $options['label'] ?? null,
            'floating' => $options['floating'] ?? false,
            'disabled' => $options['disabled'] ?? false,
            'readonly' => $options['readonly'] ?? false,
            'size' => $options['size'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['form-control'];
        if ($this->options['size']) $classes[] = "form-control-{$this->options['size']}";

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['type'] = $this->options['type'];
        if ($this->options['name']) $this->attributes['name'] = $this->options['name'];
        if ($this->options['id']) $this->attributes['id'] = $this->options['id'];
        if ($this->options['value'] !== null) $this->attributes['value'] = (string)$this->options['value'];
        if ($this->options['placeholder']) $this->attributes['placeholder'] = $this->options['placeholder'];
        if ($this->options['disabled']) $this->attributes['disabled'] = 'disabled';
        if ($this->options['readonly']) $this->attributes['readonly'] = 'readonly';

        $input = Html::tag('input', $this->attributes);

        // Si hay label, envolvemos
        if ($this->options['label']) {
            if ($this->options['floating']) {
                $wrapper = Html::tag('div', ['class' => 'form-floating mb-3']);
                if (!$this->options['placeholder']) $input->setAttribute('placeholder', $this->options['label']); // Floating requiere placeholder
                $wrapper->addContent($input);
                $wrapper->addContent(Html::tag('label', ['for' => $this->attributes['id'] ?? ''], $this->options['label']));
                return $wrapper;
            } else {
                $wrapper = Html::tag('div', ['class' => 'mb-3']);
                $wrapper->addContent(Html::tag('label', ['for' => $this->attributes['id'] ?? '', 'class' => 'form-label'], $this->options['label']));
                $wrapper->addContent($input);
                return $wrapper;
            }
        }

        return $input;
    }
}
