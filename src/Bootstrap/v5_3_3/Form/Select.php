<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Select de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'name': string - Nombre del select
 * - 'id': string - ID del select
 * - 'options': array - Opciones del select ['value' => 'label'] o [['value'=>'', 'label'=>'', 'selected'=>bool]]
 * - 'label': string - Label superior (si existe, envuelve en div.mb-3)
 * - 'floating': bool - Floating label
 * - 'multiple': bool - Múltiple selección
 * - 'disabled': bool - Deshabilitado
 * - 'size': string - 'sm', 'lg'
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Select extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = []; // Opciones de configuración
    private array $selectOptions = []; // Opciones del dropdown

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->selectOptions = $options['options'] ?? [];

        $this->options = [
            'name' => $options['name'] ?? null,
            'id' => $options['id'] ?? null,
            'label' => $options['label'] ?? null,
            'floating' => $options['floating'] ?? false,
            'multiple' => $options['multiple'] ?? false,
            'disabled' => $options['disabled'] ?? false,
            'size' => $options['size'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = ['form-select'];
        if ($this->options['size']) $classes[] = "form-select-{$this->options['size']}";

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        if ($this->options['name']) $this->attributes['name'] = $this->options['name'];
        if ($this->options['id']) $this->attributes['id'] = $this->options['id'];
        if ($this->options['multiple']) $this->attributes['multiple'] = 'multiple';
        if ($this->options['disabled']) $this->attributes['disabled'] = 'disabled';

        $select = Html::tag('select', $this->attributes);
        $optionTags = [];

        foreach ($this->selectOptions as $key => $val) {
            $optAttrs = [];
            $label = '';

            if (is_array($val)) {
                $optAttrs['value'] = (string)($val['value'] ?? '');
                $label = $val['label'] ?? '';
                if ($val['selected'] ?? false) $optAttrs['selected'] = 'selected';
                if ($val['disabled'] ?? false) $optAttrs['disabled'] = 'disabled';
            } else {
                $optAttrs['value'] = (string)$key;
                $label = $val;
            }

            $optionTags[] = Html::tag('option', $optAttrs, $label);
        }

        $select->content($optionTags);

        // Wrapper si hay label
        if ($this->options['label']) {
            if ($this->options['floating']) {
                $wrapper = Html::tag('div', ['class' => 'form-floating mb-3']);
                $wrapper->addContent($select);
                $wrapper->addContent(Html::tag('label', ['for' => $this->attributes['id'] ?? ''], $this->options['label']));
                return $wrapper;
            } else {
                $wrapper = Html::tag('div', ['class' => 'mb-3']);
                $wrapper->addContent(Html::tag('label', ['for' => $this->attributes['id'] ?? '', 'class' => 'form-label'], $this->options['label']));
                $wrapper->addContent($select);
                return $wrapper;
            }
        }

        return $select;
    }
}
