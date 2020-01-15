<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Check de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'name': string - Nombre del input
 * - 'id': string - ID del input (si no se da, se genera random o basado en name)
 * - 'label': string - Etiqueta
 * - 'checked': bool - Si está marcado [default: false]
 * - 'inline': bool - Si es inline [default: false]
 * - 'switch': bool - Si es tipo switch [default: false]
 * - 'reverse': bool - Si es reverse [default: false]
 * - 'disabled': bool - Si está deshabilitado [default: false]
 * - 'value': string - Valor del input [default: '1']
 * - 'attributes': array - Atributos HTML del input
 * 
 * @implements ComponentInterface
 */
class Check extends AbstractComponent implements ComponentInterface
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
            'label' => $options['label'] ?? '',
            'checked' => $options['checked'] ?? false,
            'inline' => $options['inline'] ?? false,
            'switch' => $options['switch'] ?? false,
            'reverse' => $options['reverse'] ?? false,
            'disabled' => $options['disabled'] ?? false,
            'value' => $options['value'] ?? '1',
        ];
    }

    public function render(): TagInterface
    {
        $containerClasses = ['form-check'];
        if ($this->options['inline']) $containerClasses[] = 'form-check-inline';
        if ($this->options['switch']) $containerClasses[] = 'form-switch';
        if ($this->options['reverse']) $containerClasses[] = 'form-check-reverse';

        $container = Html::tag('div', ['class' => implode(' ', $containerClasses)]);

        $inputId = $this->options['id'] ?? ($this->options['name'] ? $this->options['name'] . '_' . uniqid() : uniqid('check_'));

        $this->attributes['type'] = 'checkbox';
        $this->attributes['class'] = $this->mergeClasses(
            'form-check-input',
            $this->attributes['class'] ?? null
        );
        $this->attributes['id'] = $inputId;

        if ($this->options['name']) $this->attributes['name'] = $this->options['name'];
        if ($this->options['checked']) $this->attributes['checked'] = 'checked';
        if ($this->options['disabled']) $this->attributes['disabled'] = 'disabled';
        if ($this->options['value']) $this->attributes['value'] = (string)$this->options['value'];
        if ($this->options['switch']) $this->attributes['role'] = 'switch';

        $input = Html::tag('input', $this->attributes);
        $container->addContent($input);

        if ($this->options['label']) {
            $label = Html::tag('label', [
                'class' => 'form-check-label',
                'for' => $inputId
            ], $this->options['label']);
            $container->addContent($label);
        }

        return $container;
    }
}
