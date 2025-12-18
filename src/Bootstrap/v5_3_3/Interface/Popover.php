<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Popover de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'content': string - Contenido (requerido)
 * - 'title': string - Título
 * - 'placement': string - Posición ('top', 'right', 'bottom', 'left') [default: 'right']
 * - 'trigger': string - Trigger ('click', 'hover', 'focus') [default: 'click']
 * - 'dismissible': bool - Si es dismissible [default: false]
 * - 'attributes': array - Atributos HTML del elemento trigger (usualmente un botón)
 * 
 * @implements ComponentInterface
 */
class Popover extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private mixed $content = null;
    private ?string $title = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->content = $this->processContent($options);
        $this->title = $options['title'] ?? null;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'placement' => $options['placement'] ?? 'right',
            'trigger' => $options['trigger'] ?? 'click',
            'dismissible' => $options['dismissible'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        // El popover se inicializa sobre un elemento trigger (usualmente un botón o link)
        // Por defecto usaremos un botón si no se especifica etiqueta
        $tag = $this->attributes['tag'] ?? 'button';
        unset($this->attributes['tag']);

        $defaultClasses = 'btn btn-secondary';
        if ($this->options['dismissible']) {
            $tag = 'a';
            $this->attributes['tabindex'] = '0';
            $this->attributes['role'] = 'button';
            $this->options['trigger'] = 'focus';
        }

        $this->attributes['class'] = $this->mergeClasses(
            $defaultClasses,
            $this->attributes['class'] ?? null
        );

        $this->attributes['data-bs-toggle'] = 'popover';
        $this->attributes['data-bs-content'] = $this->content;

        if ($this->title) {
            $this->attributes['title'] = $this->title;
            // Para evitar tooltip nativo del navegador
            $this->attributes['data-bs-original-title'] = $this->title;
        }

        if ($this->options['placement'] !== 'right') {
            $this->attributes['data-bs-placement'] = $this->options['placement'];
        }

        if ($this->options['trigger'] !== 'click') {
            $this->attributes['data-bs-trigger'] = $this->options['trigger'];
        }

        return $this->createComponent($tag, $this->attributes)
            ->content($this->attributes['label'] ?? 'Popover');
    }
}
