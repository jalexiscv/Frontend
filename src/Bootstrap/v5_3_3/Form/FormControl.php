<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente FormControl de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'type': string - Tipo de control ('text', 'email', etc.) [default: 'text']
 * - 'name': string - Nombre del control
 * - 'id': string - ID del control
 * - 'value': string - Valor inicial
 * - 'placeholder': string - Placeholder
 * - 'label': string - Etiqueta
 * - 'help': string - Texto de ayuda
 * - 'disabled': bool - Si está deshabilitado
 * - 'readonly': bool - Si es solo lectura
 * - 'size': string - Tamaño ('sm', 'lg')
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class FormControl extends AbstractComponent implements ComponentInterface
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
            'help' => $options['help'] ?? null,
            'disabled' => $options['disabled'] ?? false,
            'readonly' => $options['readonly'] ?? false,
            'size' => $options['size'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        // En BS5, FormControl puede ser Input o Textarea
        // Aqui simplificamos a Input, Textarea tiene su propia clase
        return (new Input(array_merge($this->options, ['attributes' => $this->attributes])))->render();
    }
}
