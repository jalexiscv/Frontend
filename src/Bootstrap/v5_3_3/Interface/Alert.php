<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente Alert de Bootstrap 5.3.3
 * 
 * Opciones disponibles:
 * - 'content': string - Contenido de la alerta (requerido)
 * - 'type': string - Tipo de alerta ('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark') [default: 'primary']
 * - 'dismissible': bool - Si la alerta es dismissible [default: false]
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * @implements ComponentInterface
 * 
 * @example
 * new Alert(['content' => 'Mensaje', 'type' => 'danger', 'dismissible' => true]);
 */
class Alert extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private mixed $content = null;
    private string $type = 'primary';
    private bool $dismissible = false;
    private array $attributes = [];

    private const VALID_TYPES = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

    /**
     * Constructor
     * 
     * @param array $options Array de opciones de configuración
     */
    public function __construct(array $options = [])
    {
        // Content
        $this->content = $this->processContent($options);

        // Type
        if (isset($options['type'])) {
            $this->type = $options['type'];
        }

        // Dismissible
        if (isset($options['dismissible'])) {
            $this->dismissible = $options['dismissible'];
        }

        // Attributes
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        // Validar tipo
        if (!in_array($this->type, self::VALID_TYPES)) {
            throw new \InvalidArgumentException(
                "Invalid alert type: {$this->type}. Valid types: " . implode(', ', self::VALID_TYPES)
            );
        }
    }

    public function render(): TagInterface
    {
        $defaultClass = 'alert alert-' . $this->type;
        if ($this->dismissible) {
            $defaultClass .= ' alert-dismissible fade show';
        }

        $this->attributes['class'] = $this->mergeClasses(
            $defaultClass,
            $this->attributes['class'] ?? null
        );
        $this->attributes['role'] = 'alert';

        $alert = $this->createComponent('alert', $this->attributes);

        if ($this->dismissible) {
            $closeButton = Html::tag('button', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'alert',
                'aria-label' => 'Close'
            ]);
            $alert->content([$this->content, $closeButton]);
        } else {
            $alert->content($this->content);
        }

        return $alert;
    }
}
