<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Check extends AbstractComponent
{
    private string $type;
    private string $name;
    private string $label;
    private mixed $value;
    private bool $checked;
    private array $attributes;
    private array $options;

    public function __construct(
        string $type,
        string $name,
        string $label,
        mixed $value = null,
        bool $checked = false,
        array $attributes = [],
        array $options = []
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'inline' => false,
            'switch' => false,
            'button' => false,
            'buttonStyle' => 'outline-primary',
            'size' => null, // sm, lg
            'disabled' => false,
            'required' => false,
            'validation' => null,
            'feedback' => null,
        ], $options);
    }

    public function render(): TagInterface
    {
        if ($this->options['button']) {
            return $this->renderButtonStyle();
        }

        $wrapper = Html::tag('div', $this->getWrapperClasses());

        $input = $this->createInput();
        $label = $this->createLabel();

        $elements = [$input, $label];

        if ($this->options['feedback']) {
            $elements[] = $this->createFeedback();
        }

        $wrapper->content($elements);
        return $wrapper;
    }

    protected function getWrapperClasses(): array
    {
        $classes = [$this->type];

        if ($this->options['inline']) {
            $classes[] = "{$this->type}-inline";
        }

        if ($this->options['switch'] && $this->type === 'form-check') {
            $classes[] = 'form-switch';
        }

        return ['class' => implode(' ', $classes)];
    }

    protected function createInput(): TagInterface
    {
        $classes = ["{$this->type}-input"];

        if ($this->options['validation']) {
            $classes[] = "is-{$this->options['validation']}";
        }

        $attributes = array_merge($this->attributes, [
            'type' => $this->type === 'form-check' ? 'checkbox' : 'radio',
            'name' => $this->name,
            'id' => $this->attributes['id'] ?? "{$this->name}_{$this->value}",
            'class' => $this->mergeClasses(
                implode(' ', $classes),
                $this->attributes['class'] ?? null
            )
        ]);

        if ($this->value !== null) {
            $attributes['value'] = $this->value;
        }

        if ($this->checked) {
            $attributes['checked'] = true;
        }

        if ($this->options['disabled']) {
            $attributes['disabled'] = true;
        }

        if ($this->options['required']) {
            $attributes['required'] = true;
        }

        return Html::tag('input', $attributes);
    }

    protected function createLabel(): TagInterface
    {
        return Html::tag('label', [
            'class' => "{$this->type}-label",
            'for' => $this->attributes['id'] ?? "{$this->name}_{$this->value}"
        ], $this->label);
    }

    protected function createFeedback(): TagInterface
    {
        $type = $this->options['validation'] === 'valid' ? 'valid' : 'invalid';
        return Html::tag('div', [
            'class' => "{$type}-feedback"
        ], $this->options['feedback']);
    }

    protected function renderButtonStyle(): TagInterface
    {
        $input = Html::tag('input', [
            'type' => $this->type === 'form-check' ? 'checkbox' : 'radio',
            'name' => $this->name,
            'id' => $this->attributes['id'] ?? "{$this->name}_{$this->value}",
            'class' => 'btn-check',
            'value' => $this->value,
            'checked' => $this->checked,
            'disabled' => $this->options['disabled'],
            'required' => $this->options['required'],
        ]);

        $labelClasses = ['btn'];
        if ($this->options['buttonStyle']) {
            $labelClasses[] = "btn-{$this->options['buttonStyle']}";
        }
        if ($this->options['size']) {
            $labelClasses[] = "btn-{$this->options['size']}";
        }

        $label = Html::tag('label', [
            'class' => implode(' ', $labelClasses),
            'for' => $this->attributes['id'] ?? "{$this->name}_{$this->value}"
        ], $this->label);

        $wrapper = Html::tag('div');
        $wrapper->content([$input, $label]);
        return $wrapper;
    }

    public static function checkbox(
        string $name,
        string $label,
        mixed $value = null,
        bool $checked = false,
        array $attributes = []
    ): self {
        return new self('form-check', $name, $label, $value, $checked, $attributes);
    }

    public static function radio(
        string $name,
        string $label,
        mixed $value,
        bool $checked = false,
        array $attributes = []
    ): self {
        return new self('form-check', $name, $label, $value, $checked, $attributes);
    }

    public static function switch(
        string $name,
        string $label,
        mixed $value = null,
        bool $checked = false,
        array $attributes = []
    ): self {
        return new self('form-check', $name, $label, $value, $checked, $attributes, [
            'switch' => true
        ]);
    }
}
