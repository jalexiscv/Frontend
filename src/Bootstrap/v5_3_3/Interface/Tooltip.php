<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Tooltip extends AbstractComponent
{
    private mixed $content;
    private string $title;
    private array $attributes;
    private array $options;

    public function __construct(
        mixed $content,
        string $title,
        array $attributes = [],
        array $options = []
    ) {
        $this->content = $content;
        $this->title = $title;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'placement' => 'top',
            'animation' => true,
            'html' => false,
            'trigger' => 'hover focus',
            'delay' => ['show' => 0, 'hide' => 0],
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
        $this->attributes['data-bs-toggle'] = 'tooltip';
        $this->attributes['data-bs-placement'] = $this->options['placement'];
        $this->attributes['title'] = $this->title;

        if (!$this->options['animation']) {
            $this->attributes['data-bs-animation'] = 'false';
        }

        if ($this->options['html']) {
            $this->attributes['data-bs-html'] = 'true';
        }

        if ($this->options['trigger'] !== 'hover focus') {
            $this->attributes['data-bs-trigger'] = $this->options['trigger'];
        }

        if ($this->options['delay']['show'] > 0 || $this->options['delay']['hide'] > 0) {
            $this->attributes['data-bs-delay'] = json_encode($this->options['delay']);
        }
    }

    public static function create(mixed $content, string $title): self
    {
        return new self($content, $title);
    }

    public function placement(string $placement): self
    {
        $this->options['placement'] = $placement;
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

    public function trigger(string $trigger): self
    {
        $this->options['trigger'] = $trigger;
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
}
