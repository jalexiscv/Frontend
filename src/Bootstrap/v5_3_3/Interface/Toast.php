<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Toast de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID del toast (requerido)
 * - 'content': mixed - Contenido del toast
 * - 'title': string|null - Título del toast
 * - 'autohide': bool - Si se oculta automáticamente [default: true]
 * - 'delay': int - Delay en ms [default: 5000]
 * - 'animation': bool - Si tiene animación [default: true]
 * - 'position': string|null - Posición [default: null]
 * - 'container': bool - Si usa contenedor [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Toast extends AbstractComponent implements ComponentInterface
{
    private ?string $id = null;
    private ?string $title = null;
    private mixed $content = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? null;
        $this->content = $options['content'] ?? null;
        $this->title = $options['title'] ?? null;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'autohide' => $options['autohide'] ?? true,
            'delay' => $options['delay'] ?? 5000,
            'animation' => $options['animation'] ?? true,
            'position' => $options['position'] ?? null,
            'container' => $options['container'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        if ($this->options['container']) {
            return $this->renderContainer();
        }
        return $this->renderToast();
    }

    protected function renderContainer(): TagInterface
    {
        $position = match ($this->options['position']) {
            'top-right' => 'top-0 end-0',
            'top-left' => 'top-0 start-0',
            'bottom-right' => 'bottom-0 end-0',
            'bottom-left' => 'bottom-0 start-0',
            'middle-center' => 'top-50 start-50 translate-middle',
            default => 'top-0 end-0'
        };

        return Html::tag('div', ['class' => "toast-container position-fixed {$position} p-3"])
            ->content($this->renderToast());
    }

    protected function renderToast(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'toast',
            $this->options['animation'] ? 'fade' : null,
            $this->attributes['class'] ?? null
        );

        $this->attributes['id'] = $this->id;
        $this->attributes['role'] = 'alert';
        $this->attributes['aria-live'] = 'assertive';
        $this->attributes['aria-atomic'] = 'true';

        if (!$this->options['autohide']) $this->attributes['data-bs-autohide'] = 'false';
        if ($this->options['delay'] !== 5000) $this->attributes['data-bs-delay'] = (string)$this->options['delay'];

        $toast = $this->createComponent('div', $this->attributes);
        $elements = [];

        if ($this->title) {
            $header = Html::tag('div', ['class' => 'toast-header']);
            $header->content([
                Html::tag('strong', ['class' => 'me-auto'], $this->title),
                Html::tag('button', [
                    'type' => 'button',
                    'class' => 'btn-close',
                    'data-bs-dismiss' => 'toast',
                    'aria-label' => 'Close'
                ])
            ]);
            $elements[] = $header;
        }

        $elements[] = Html::tag('div', ['class' => 'toast-body'], $this->content);
        $toast->content($elements);

        return $toast;
    }

    // Métodos fluidos opcionales
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function autohide(bool $autohide = true): self
    {
        $this->options['autohide'] = $autohide;
        return $this;
    }
    public function delay(int $milliseconds): self
    {
        $this->options['delay'] = $milliseconds;
        return $this;
    }
    public function animation(bool $animation = true): self
    {
        $this->options['animation'] = $animation;
        return $this;
    }
    public function position(string $position): self
    {
        $this->options['position'] = $position;
        $this->options['container'] = true;
        return $this;
    }
}
