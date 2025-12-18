<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Col de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'size': string|int - Tamaño ('', 'auto', '1-12')
 * - 'sm': string|int - Tamaño sm ('auto', '1-12')
 * - 'md': string|int - Tamaño md
 * - 'lg': string|int - Tamaño lg
 * - 'xl': string|int - Tamaño xl
 * - 'xxl': string|int - Tamaño xxl
 * - 'content': mixed - Contenido
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Col extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private mixed $content = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->content = $this->processContent($options);

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        // Manejamos 'size' como principal y luego los breakpoints específicos
        $this->options = [
            'size' => $options['size'] ?? null,
            'sm' => $options['sm'] ?? null,
            'md' => $options['md'] ?? null,
            'lg' => $options['lg'] ?? null,
            'xl' => $options['xl'] ?? null,
            'xxl' => $options['xxl'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $classes = [];

        if ($this->options['size'] !== null) {
            $classes[] = $this->options['size'] === '' ? 'col' : "col-{$this->options['size']}";
        } else if (empty(array_filter($this->options))) {
            // Si no hay ninguna opción de tamaño, es 'col' por defecto
            $classes[] = 'col';
        }

        foreach (['sm', 'md', 'lg', 'xl', 'xxl'] as $bp) {
            if ($this->options[$bp] !== null) {
                $classes[] = "col-{$bp}-{$this->options[$bp]}";
            }
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        return $this->createComponent('div', $this->attributes, $this->content);
    }
}
