<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class FormControl extends AbstractComponent
{
    protected string $type;
    protected string $name;
    protected ?string $label;
    protected mixed $value;
    protected array $attributes;
    protected array $options;
    protected array $validationRules;

    public function __construct(
        string $type,
        string $name,
        ?string $label = null,
        mixed $value = null,
        array $attributes = [],
        array $options = []
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'floating' => false,
            'size' => null, // sm, lg
            'plaintext' => false,
            'readonly' => false,
            'disabled' => false,
            'required' => false,
            'help' => null,
            'validation' => null, // is-valid, is-invalid
            'feedback' => null,
        ], $options);
        $this->validationRules = [];
    }

    public function render(): TagInterface
    {
        if ($this->options['floating']) {
            return $this->renderFloatingLabel();
        }

        $group = Html::tag('div', ['class' => 'mb-3']);
        $elements = [];

        if ($this->label) {
            $elements[] = $this->createLabel();
        }

        $elements[] = $this->createInput();

        if ($this->options['help']) {
            $elements[] = $this->createHelpText();
        }

        if ($this->options['feedback']) {
            $elements[] = $this->createFeedback();
        }

        $group->content($elements);
        return $group;
    }

    protected function createInput(): TagInterface
    {
        $this->prepareInputAttributes();

        if ($this->type === 'textarea') {
            return Html::tag('textarea', $this->attributes, $this->value);
        }

        if ($this->type === 'select') {
            return $this->createSelect();
        }

        return Html::tag('input', $this->attributes);
    }

    protected function prepareInputAttributes(): void
    {
        $this->attributes['type'] = $this->type;
        $this->attributes['name'] = $this->name;
        $this->attributes['id'] = $this->attributes['id'] ?? $this->name;

        if ($this->value !== null && !in_array($this->type, ['password', 'file'])) {
            $this->attributes['value'] = $this->value;
        }

        $classes = ['form-control'];

        if ($this->options['plaintext']) {
            $classes = ['form-control-plaintext'];
        }

        if ($this->options['size']) {
            $classes[] = "form-control-{$this->options['size']}";
        }

        if ($this->options['validation']) {
            $classes[] = "is-{$this->options['validation']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        if ($this->options['readonly']) {
            $this->attributes['readonly'] = true;
        }

        if ($this->options['disabled']) {
            $this->attributes['disabled'] = true;
        }

        if ($this->options['required']) {
            $this->attributes['required'] = true;
        }

        foreach ($this->validationRules as $rule => $value) {
            if (is_bool($value) && $value) {
                $this->attributes[$rule] = true;
            } else {
                $this->attributes[$rule] = $value;
            }
        }
    }

    protected function createLabel(): TagInterface
    {
        return Html::tag('label', [
            'for' => $this->attributes['id'] ?? $this->name,
            'class' => 'form-label'
        ], $this->label);
    }

    protected function createHelpText(): TagInterface
    {
        return Html::tag('div', [
            'class' => 'form-text',
            'id' => "{$this->name}Help"
        ], $this->options['help']);
    }

    protected function createFeedback(): TagInterface
    {
        $type = $this->options['validation'] === 'valid' ? 'valid' : 'invalid';
        return Html::tag('div', [
            'class' => "{$type}-feedback"
        ], $this->options['feedback']);
    }

    protected function createSelect(): TagInterface
    {
        $select = Html::tag('select', $this->attributes);
        $options = [];

        foreach ($this->value as $value => $label) {
            if (is_array($label)) {
                $optgroup = Html::tag('optgroup', ['label' => $value]);
                $groupOptions = [];
                foreach ($label as $val => $lbl) {
                    $groupOptions[] = $this->createOption($val, $lbl);
                }
                $optgroup->content($groupOptions);
                $options[] = $optgroup;
            } else {
                $options[] = $this->createOption($value, $label);
            }
        }

        $select->content($options);
        return $select;
    }

    protected function createOption($value, $label): TagInterface
    {
        $attributes = ['value' => $value];
        if (isset($this->attributes['value']) && $this->attributes['value'] == $value) {
            $attributes['selected'] = true;
        }
        return Html::tag('option', $attributes, $label);
    }

    protected function renderFloatingLabel(): TagInterface
    {
        $wrapper = Html::tag('div', ['class' => 'form-floating']);
        $this->options['size'] = null; // Floating labels don't support sizing
        $input = $this->createInput();
        $label = Html::tag('label', [
            'for' => $this->attributes['id'] ?? $this->name
        ], $this->label);

        $elements = [$input, $label];

        if ($this->options['help']) {
            $elements[] = $this->createHelpText();
        }

        if ($this->options['feedback']) {
            $elements[] = $this->createFeedback();
        }

        $wrapper->content($elements);
        return $wrapper;
    }

    public function setValidation(string $state, ?string $feedback = null): self
    {
        $this->options['validation'] = $state;
        if ($feedback) {
            $this->options['feedback'] = $feedback;
        }
        return $this;
    }

    public function addValidationRule(string $rule, mixed $value = true): self
    {
        $this->validationRules[$rule] = $value;
        return $this;
    }

    public static function input(
        string $name,
        ?string $label = null,
        ?string $value = null,
        array $attributes = []
    ): self {
        return new self('text', $name, $label, $value, $attributes);
    }

    public static function textarea(
        string $name,
        ?string $label = null,
        ?string $value = null,
        array $attributes = []
    ): self {
        return new self('textarea', $name, $label, $value, $attributes);
    }

    public static function select(
        string $name,
        array $options,
        ?string $label = null,
        mixed $selected = null,
        array $attributes = []
    ): self {
        return new self('select', $name, $label, $options, array_merge($attributes, [
            'value' => $selected
        ]));
    }

    public static function email(
        string $name,
        ?string $label = null,
        ?string $value = null,
        array $attributes = []
    ): self {
        return new self('email', $name, $label, $value, $attributes);
    }

    public static function password(
        string $name,
        ?string $label = null,
        array $attributes = []
    ): self {
        return new self('password', $name, $label, null, $attributes);
    }

    public static function file(
        string $name,
        ?string $label = null,
        array $attributes = []
    ): self {
        $attributes['class'] = self::mergeClasses(
            'form-control',
            $attributes['class'] ?? null
        );
        return new self('file', $name, $label, null, $attributes);
    }

    public static function range(
        string $name,
        ?string $label = null,
        mixed $value = null,
        array $attributes = []
    ): self {
        $attributes['class'] = 'form-range';
        return new self('range', $name, $label, $value, $attributes);
    }
}
