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
 * - 'content': string - Contenido de la alerta (escapado)
 * - 'htmlContent': string - Contenido HTML sin escapar (alternativa a content)
 * - 'type': string - Tipo de alerta ('primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark') [default: 'primary']
 * - 'icon': string - Clase de ícono o HTML del ícono (ej: 'fas fa-check' o SVG) [default: null]
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
    private ?string $icon = null;
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

        // Icon
        if (isset($options['icon'])) {
            $this->icon = $options['icon'];
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

        // Si hay ícono, agregar flex para alineación
        if ($this->icon) {
            $defaultClass .= ' d-flex align-items-center';
        }

        $this->attributes['class'] = $this->mergeClasses(
            $defaultClass,
            $this->attributes['class'] ?? null
        );
        $this->attributes['role'] = 'alert';

        $alert = $this->createComponent('alert', $this->attributes);

        $elements = [];

        // Agregar ícono si existe
        if ($this->icon) {
            $elements[] = $this->createIcon();
        }

        // Envolver contenido en div si hay ícono
        if ($this->icon) {
            $contentWrapper = Html::tag('div');
            $contentWrapper->content($this->content);
            $elements[] = $contentWrapper;
        } else {
            $elements[] = $this->content;
        }

        // Botón de cerrar al final
        if ($this->dismissible) {
            $closeButton = Html::tag('button', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'alert',
                'aria-label' => 'Close'
            ]);
            $elements[] = $closeButton;
        }

        $alert->content($elements);
        return $alert;
    }

    /**
     * Crea el elemento del ícono
     */
    private function createIcon(): TagInterface
    {
        // Si el ícono contiene '<' es HTML/SVG, usarlo directamente
        if (str_contains($this->icon, '<')) {
            return Html::raw($this->icon);
        }

        // Si no, asumir que es una clase de ícono (Font Awesome, Bootstrap Icons, etc.)
        $iconTag = Html::tag('i', [
            'class' => $this->icon . ' flex-shrink-0 me-2',
            'aria-hidden' => 'true'
        ]);

        return $iconTag;
    }
}
