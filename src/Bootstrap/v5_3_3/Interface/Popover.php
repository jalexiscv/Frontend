<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Popover extends AbstractComponent
{
    private mixed $content;
    private string $title;
    private ?string $body;
    private array $attributes;
    private array $options;

    public function __construct(
        mixed $content,
        string $title,
        ?string $body = null,
        array $attributes = [],
        array $options = []
    ) {
        $this->content = $content;
        $this->title = $title;
        $this->body = $body;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'placement' => 'right',
            'trigger' => 'click',
            'animation' => true,
            'html' => false,
            'delay' => ['show' => 0, 'hide' => 0],
            'container' => 'body',
            'sanitize' => true,
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->prepareAttributes();
        $element = $this->createComponent('div', $this->attributes);
        $element->content($this->content);
        return $element;
    }

    protected function prepareAttributes(): void
    {
        $this->attributes['data-bs-toggle'] = 'popover';
        $this->attributes['data-bs-placement'] = $this->options['placement'];
        $this->attributes['title'] = $this->title;

        if ($this->body) {
            $this->attributes['data-bs-content'] = $this->body;
        }

        if (!$this->options['animation']) {
            $this->attributes['data-bs-animation'] = 'false';
        }

        if ($this->options['html']) {
            $this->attributes['data-bs-html'] = 'true';
        }

        if ($this->options['trigger'] !== 'click') {
            $this->attributes['data-bs-trigger'] = $this->options['trigger'];
        }

        if ($this->options['container'] !== 'body') {
            $this->attributes['data-bs-container'] = $this->options['container'];
        }

        if (!$this->options['sanitize']) {
            $this->attributes['data-bs-sanitize'] = 'false';
        }

        if ($this->options['delay']['show'] > 0 || $this->options['delay']['hide'] > 0) {
            $this->attributes['data-bs-delay'] = json_encode($this->options['delay']);
        }
    }

    public static function create(mixed $content, string $title, ?string $body = null): self
    {
        return new self($content, $title, $body);
    }

    public function placement(string $placement): self
    {
        $this->options['placement'] = $placement;
        return $this;
    }

    public function trigger(string $trigger): self
    {
        $this->options['trigger'] = $trigger;
        return $this;
    }

    public function animation(bool $animation = true): self
    {
        $this->options['animation'] = $animation;
        return $this;
    }

    public function html(bool $html = true): self
    {
        $this->options['html'] = $html;
        return $this;
    }

    public function delay(int $show, int $hide): self
    {
        $this->options['delay'] = [
            'show' => $show,
            'hide' => $hide
        ];
        return $this;
    }

    public function container(string $container): self
    {
        $this->options['container'] = $container;
        return $this;
    }

    public function sanitize(bool $sanitize = true): self
    {
        $this->options['sanitize'] = $sanitize;
        return $this;
    }
}
