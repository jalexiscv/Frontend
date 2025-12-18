<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Progress de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'value': int - Valor actual [default: 0]
 * - 'min': int - Valor mínimo [default: 0]
 * - 'max': int - Valor máximo [default: 100]
 * - 'variant': string - Variante de color [default: 'primary']
 * - 'striped': bool - Si tiene rayas [default: false]
 * - 'animated': bool - Si está animado [default: false]
 * - 'label': string|null - Etiqueta visible [default: null]
 * - 'height': string|null - Altura CSS [default: null]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Progress extends AbstractComponent implements ComponentInterface
{
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'value' => $options['value'] ?? 0,
            'min' => $options['min'] ?? 0,
            'max' => $options['max'] ?? 100,
            'variant' => $options['variant'] ?? 'primary',
            'striped' => $options['striped'] ?? false,
            'animated' => $options['animated'] ?? false,
            'label' => $options['label'] ?? null,
            'height' => $options['height'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $containerAttrs = $this->attributes;
        if ($this->options['height']) {
            $containerAttrs['style'] = "height: {$this->options['height']};" . ($containerAttrs['style'] ?? '');
        }

        $containerAttrs['class'] = $this->mergeClasses('progress', $containerAttrs['class'] ?? null);
        $container = Html::tag('div', $containerAttrs);

        $barClasses = ['progress-bar', "bg-{$this->options['variant']}"];
        if ($this->options['striped']) $barClasses[] = 'progress-bar-striped';
        if ($this->options['animated']) $barClasses[] = 'progress-bar-animated';

        $barAttrs = [
            'class' => implode(' ', $barClasses),
            'role' => 'progressbar',
            'aria-valuenow' => (string)$this->options['value'],
            'aria-valuemin' => (string)$this->options['min'],
            'aria-valuemax' => (string)$this->options['max'],
            'style' => "width: {$this->options['value']}%"
        ];

        $bar = Html::tag('div', $barAttrs);
        if ($this->options['label']) {
            $bar->content($this->options['label']);
        }

        $container->content($bar);
        return $container;
    }
}
