<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Modal de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID del modal (requerido)
 * - 'title': string - Título del modal
 * - 'body': mixed - Contenido del body
 * - 'footer': mixed - Contenido del footer
 * - 'size': string|null - Tamaño ('sm', 'lg', 'xl')
 * - 'centered': bool - Si está centrado
 * - 'scrollable': bool - Si es scrollable
 * - 'static': bool - Si es estático
 * - 'fullscreen': bool|string - Fullscreen o breakpoint
 * - 'animation': bool - Si tiene animación fade
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Modal extends AbstractComponent implements ComponentInterface
{
    private ?string $id = null;
    private ?string $title = null;
    private mixed $body = null;
    private mixed $footer = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? null;
        $this->title = $options['title'] ?? null;
        $this->body = $options['body'] ?? null;
        $this->footer = $options['footer'] ?? null;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'size' => $options['size'] ?? null,
            'centered' => $options['centered'] ?? false,
            'scrollable' => $options['scrollable'] ?? false,
            'static' => $options['static'] ?? false,
            'fullscreen' => $options['fullscreen'] ?? false,
            'animation' => $options['animation'] ?? true,
        ];
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'modal',
            $this->options['animation'] ? 'fade' : null,
            $this->attributes['class'] ?? null
        );
        $this->attributes['id'] = $this->id;
        $this->attributes['tabindex'] = '-1';
        $this->attributes['aria-labelledby'] = "{$this->id}Label";
        $this->attributes['aria-hidden'] = 'true';

        if ($this->options['static']) {
            $this->attributes['data-bs-backdrop'] = 'static';
            $this->attributes['data-bs-keyboard'] = 'false';
        }

        $modal = $this->createComponent('div', $this->attributes);

        // Dialog
        $dialogClasses = ['modal-dialog'];
        if ($this->options['centered']) $dialogClasses[] = 'modal-dialog-centered';
        if ($this->options['scrollable']) $dialogClasses[] = 'modal-dialog-scrollable';
        if ($this->options['size']) $dialogClasses[] = "modal-{$this->options['size']}";
        if ($this->options['fullscreen']) {
            $dialogClasses[] = is_string($this->options['fullscreen'])
                ? "modal-fullscreen-{$this->options['fullscreen']}-down"
                : 'modal-fullscreen';
        }

        $dialog = Html::tag('div', ['class' => implode(' ', $dialogClasses)]);
        $content = Html::tag('div', ['class' => 'modal-content']);

        // Header
        if ($this->title) {
            $header = Html::tag('div', ['class' => 'modal-header']);
            $title = Html::tag('h5', ['class' => 'modal-title', 'id' => "{$this->id}Label"], $this->title);
            $closeButton = Html::tag('button', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'modal',
                'aria-label' => 'Close'
            ]);
            $header->content([$title, $closeButton]);
            $content->content($header);
        }

        // Body
        if ($this->body) {
            $body = Html::tag('div', ['class' => 'modal-body'], $this->body);
            $content->content($body);
        }

        // Footer
        if ($this->footer) {
            $footer = Html::tag('div', ['class' => 'modal-footer'], $this->footer);
            $content->content($footer);
        }

        $dialog->content($content);
        $modal->content($dialog);
        return $modal;
    }

    // Métodos fluidos opcionales
    public function size(string $size): self
    {
        $this->options['size'] = $size;
        return $this;
    }
    public function centered(bool $centered = true): self
    {
        $this->options['centered'] = $centered;
        return $this;
    }
    public function scrollable(bool $scrollable = true): self
    {
        $this->options['scrollable'] = $scrollable;
        return $this;
    }
    public function static(bool $static = true): self
    {
        $this->options['static'] = $static;
        return $this;
    }
    public function fullscreen(bool|string $breakpoint = true): self
    {
        $this->options['fullscreen'] = $breakpoint;
        return $this;
    }
    public function animation(bool $animation = true): self
    {
        $this->options['animation'] = $animation;
        return $this;
    }
}
