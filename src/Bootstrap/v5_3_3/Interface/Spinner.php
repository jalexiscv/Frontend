<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Spinner de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'type': string - Tipo ('border', 'grow') [default: 'border']
 * - 'size': string|null - Tamaño ('sm') [default: null]
 * - 'variant': string - Variante de color [default: 'primary']
 * - 'label': string - Texto para accesibilidad [default: 'Loading...']
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Spinner extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'type' => $options['type'] ?? 'border',
            'size' => $options['size'] ?? null,
            'variant' => $options['variant'] ?? 'primary',
            'label' => $options['label'] ?? 'Loading...',
        ];
    }

    public function render(): TagInterface
    {
        $classes = ["spinner-{$this->options['type']}", "text-{$this->options['variant']}"];

        if ($this->options['size']) {
            $classes[] = "spinner-{$this->options['type']}-{$this->options['size']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
        $this->attributes['role'] = 'status';

        $spinner = $this->createComponent('div', $this->attributes);
        $srOnly = $this->createComponent('span', ['class' => 'visually-hidden']);
        $srOnly->content($this->options['label']);
        $spinner->content($srOnly);

        return $spinner;
    }
}
