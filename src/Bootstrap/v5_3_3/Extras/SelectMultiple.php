<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente SelectMultiple de Bootstrap 5.3.3
 * 
 * Genera un combo de selección múltiple (select multiple) que aprovecha clases nativas
 * de forms y soporta librerías externas de select si las clases apropiadas son provistas.
 * 
 * Opciones disponibles:
 * - 'id': string - Atributo ID del select (requerido)
 * - 'name': string - Atributo Name del select, usualmente terminará en [] (requerido)
 * - 'options': array - Arreglo de opciones a renderizar (requerido)
 * - 'selected': array - Arreglo de los valores pre-seleccionados [default: []]
 * - 'class': string - Clases adicionales al 'form-select' [default: '']
 * - 'attributes': array - Atributos HTML adicionales para el elemento select [default: []]
 * 
 * Estructura del array 'options':
 * Cada elemento debe contener:
 * - 'value': string - Valor de la opción
 * - 'label': string - Etiqueta a mostrar
 * 
 * @implements ComponentInterface
 */
class SelectMultiple extends AbstractComponent implements ComponentInterface
{
    private string $id;
    private string $name;
    private array $options = [];
    private array $selected = [];
    private string $class = '';
    private array $attributes = [];

    /**
     * Constructor
     * 
     * @param array $config Opciones de configuración
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['id'])) {
            throw new \InvalidArgumentException('El parámetro "id" es requerido para SelectMultiple.');
        }
        $this->id = $config['id'];

        if (!isset($config['name'])) {
            throw new \InvalidArgumentException('El parámetro "name" es requerido para SelectMultiple.');
        }
        $this->name = $config['name'];

        if (isset($config['options']) && is_array($config['options'])) {
            $this->options = $config['options'];
        }

        if (isset($config['selected']) && is_array($config['selected'])) {
            $this->selected = $config['selected'];
        }

        if (isset($config['class'])) {
            $this->class = (string)$config['class'];
        }

        if (isset($config['attributes']) && is_array($config['attributes'])) {
            $this->attributes = $config['attributes'];
        }
    }

    /**
     * Renderiza el componente completo
     * 
     * @return TagInterface
     */
    public function render(): TagInterface
    {
        $selectOptions = array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'multiple' => 'multiple',
            'class' => $this->mergeClasses('form-select', $this->class)
        ], $this->attributes);

        $select = Html::tag('select', $selectOptions);
        
        $optionTags = [];
        foreach ($this->options as $opt) {
            $value = isset($opt['value']) ? (string)$opt['value'] : '';
            $label = isset($opt['label']) ? (string)$opt['label'] : $value;
            
            $optAttrs = ['value' => $value];
            if (in_array($value, $this->selected)) {
                $optAttrs['selected'] = 'selected';
            }
            
            $optionTag = Html::tag('option', $optAttrs);
            $optionTag->content($label);
            $optionTags[] = $optionTag;
        }

        $select->content($optionTags);
        return $select;
    }
}
