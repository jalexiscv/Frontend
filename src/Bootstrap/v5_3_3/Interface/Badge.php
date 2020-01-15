<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Badge de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'content': string - Contenido del badge
 * - 'variant': string - Variante ('primary', 'secondary', etc.) [default: 'primary']
 * - 'pill': bool - Si es pill [default: false]
 * - 'position': string|null - Posición [default: null]
 * - 'notification': bool - Si es notificación [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Badge extends AbstractComponent implements ComponentInterface
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

        $this->options = [
            'variant' => $options['variant'] ?? 'primary',
            'pill' => $options['pill'] ?? false,
            'position' => $options['position'] ?? null,
            'notification' => $options['notification'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        if ($this->options['notification']) {
            return $this->renderNotification();
        }

        $this->prepareClasses();
        $badge = $this->createComponent('span', $this->attributes);
        $badge->content($this->content);
        return $badge;
    }

    protected function prepareClasses(): void
    {
        $classes = ['badge'];

        $classes[] = "bg-{$this->options['variant']}";

        if ($this->options['pill']) {
            $classes[] = 'rounded-pill';
        }

        if ($this->options['position']) {
            $classes[] = "position-absolute top-0 start-100 translate-middle";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    protected function renderNotification(): TagInterface
    {
        $wrapper = $this->createComponent('button', [
            'type' => 'button',
            'class' => 'btn btn-primary position-relative'
        ])->content($this->content);

        $this->options['position'] = true;
        $this->prepareClasses();

        $badge = $this->createComponent('span', $this->attributes)
            ->content($this->content);

        $wrapper->content($badge);
        return $wrapper;
    }

    // Métodos fluidos opcionales
    public function setVariant(string $variant): self
    {
        $this->options['variant'] = $variant;
        return $this;
    }

    public function pill(bool $pill = true): self
    {
        $this->options['pill'] = $pill;
        return $this;
    }

    public function position(string $position): self
    {
        $this->options['position'] = $position;
        return $this;
    }

    public function notification(bool $notification = true): self
    {
        $this->options['notification'] = $notification;
        return $this;
    }
}
