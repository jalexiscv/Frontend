<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Modal extends AbstractComponent
{
    private string $id;
    private ?string $title;
    private mixed $body;
    private mixed $footer;
    private array $attributes;
    private array $options;

    public function __construct(
        string $id,
        ?string $title = null,
        mixed $body = null,
        mixed $footer = null,
        array $attributes = [],
        array $options = []
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->footer = $footer;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'size' => null,
            'centered' => false,
            'scrollable' => false,
            'static' => false,
            'fullscreen' => false,
            'animation' => true,
        ], $options);
    }

    public function render(): TagInterface
    {
        // Modal trigger button
        if (isset($this->attributes['trigger'])) {
            $trigger = Button::link(
                $this->attributes['trigger'],
                '#',
                [
                    'data-bs-toggle' => 'modal',
                    'data-bs-target' => "#{$this->id}"
                ]
            )->render();
        }

        // Modal dialog
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
        if ($this->options['centered']) {
            $dialogClasses[] = 'modal-dialog-centered';
        }
        if ($this->options['scrollable']) {
            $dialogClasses[] = 'modal-dialog-scrollable';
        }
        if ($this->options['size']) {
            $dialogClasses[] = "modal-{$this->options['size']}";
        }
        if ($this->options['fullscreen']) {
            $dialogClasses[] = is_string($this->options['fullscreen'])
                ? "modal-fullscreen-{$this->options['fullscreen']}-down"
                : 'modal-fullscreen';
        }

        $dialog = Html::tag('div', ['class' => implode(' ', $dialogClasses)]);

        // Content
        $content = Html::tag('div', ['class' => 'modal-content']);

        // Header
        if ($this->title) {
            $header = Html::tag('div', ['class' => 'modal-header']);
            $title = Html::tag('h5', [
                'class' => 'modal-title',
                'id' => "{$this->id}Label"
            ], $this->title);
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

        if (isset($trigger)) {
            $wrapper = Html::tag('div');
            $wrapper->content([$trigger, $modal]);
            return $wrapper;
        }
        return $modal;
    }

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

    public static function create(string $id): self
    {
        return new self($id);
    }

    public static function confirm(
        string $id,
        string $title,
        string $message,
        string $confirmText = 'Confirmar',
        string $cancelText = 'Cancelar',
        array $attributes = []
    ): self {
        $footer = [
            Button::link($cancelText, '#', [
                'class' => 'btn btn-secondary',
                'data-bs-dismiss' => 'modal'
            ])->render(),
            Button::link($confirmText, '#', [
                'class' => 'btn btn-primary',
                'id' => "{$id}Confirm"
            ])->render()
        ];

        return new self($id, $title, $message, $footer, $attributes);
    }
}
