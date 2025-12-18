<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;

/**
 * Componente de Alerta de Bootstrap 5
 */
class Alert extends AbstractComponent
{
    private string $content;
    private string $type;
    private bool $dismissible;
    private array $attributes;

    public function __construct(
        string $content,
        string $type = 'primary',
        bool $dismissible = false,
        array $attributes = []
    ) {
        $this->content = $content;
        $this->type = $type;
        $this->dismissible = $dismissible;
        $this->attributes = $attributes;
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

    /**
     * Crea una alerta de éxito
     */
    public static function success(string $content, bool $dismissible = false, array $attributes = []): self
    {
        return new self($content, 'success', $dismissible, $attributes);
    }

    /**
     * Crea una alerta de error
     */
    public static function danger(string $content, bool $dismissible = false, array $attributes = []): self
    {
        return new self($content, 'danger', $dismissible, $attributes);
    }

    /**
     * Crea una alerta de advertencia
     */
    public static function warning(string $content, bool $dismissible = false, array $attributes = []): self
    {
        return new self($content, 'warning', $dismissible, $attributes);
    }

    /**
     * Crea una alerta informativa
     */
    public static function info(string $content, bool $dismissible = false, array $attributes = []): self
    {
        return new self($content, 'info', $dismissible, $attributes);
    }
}
