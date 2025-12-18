<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Toast extends AbstractComponent
{
    private string $id;
    private ?string $title;
    private mixed $content;
    private array $attributes;
    private array $options;

    public function __construct(
        string $id,
        mixed $content,
        ?string $title = null,
        array $attributes = [],
        array $options = []
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->title = $title;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'autohide' => true,
            'delay' => 5000,
            'animation' => true,
            'position' => null, // top-right, top-left, bottom-right, bottom-left, middle-center
            'container' => false,
        ], $options);
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

        return Html::tag('div', [
            'class' => "toast-container position-fixed {$position} p-3"
        ])->content($this->renderToast());
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

        if (!$this->options['autohide']) {
            $this->attributes['data-bs-autohide'] = 'false';
        }

        if ($this->options['delay'] !== 5000) {
            $this->attributes['data-bs-delay'] = $this->options['delay'];
        }

        $toast = $this->createComponent('div', $this->attributes);
        $elements = [];

        if ($this->title) {
            $elements[] = $this->createHeader();
        }

        $elements[] = $this->createBody();
        $toast->content($elements);

        return $toast;
    }

    protected function createHeader(): TagInterface
    {
        $header = Html::tag('div', ['class' => 'toast-header']);
        
        $elements = [
            Html::tag('strong', ['class' => 'me-auto'], $this->title),
            Html::tag('button', [
                'type' => 'button',
                'class' => 'btn-close',
                'data-bs-dismiss' => 'toast',
                'aria-label' => 'Close'
            ])
        ];

        $header->content($elements);
        return $header;
    }

    protected function createBody(): TagInterface
    {
        return Html::tag('div', ['class' => 'toast-body'], $this->content);
    }

    public static function create(string $id, mixed $content): self
    {
        return new self($id, $content);
    }

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
