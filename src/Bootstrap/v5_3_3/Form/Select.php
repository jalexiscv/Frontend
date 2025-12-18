<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Select extends AbstractComponent
{
    private string $name;
    private array $options;
    private array $attributes;

    public function __construct(string $name, array $options = [], array $attributes = [])
    {
        $this->name = $name;
        $this->options = $options;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $this->attributes['name'] = $this->name;
        $this->attributes['id'] = $this->attributes['id'] ?? "select-{$this->name}";

        $this->attributes['class'] = $this->mergeClasses(
            'form-select',
            $this->attributes['class'] ?? null
        );

        $select = Html::tag('select', $this->attributes);

        foreach ($this->options as $value => $label) {
            $option = Html::tag('option', ['value' => $value])->content($label);
            $select->content($option);
        }

        return $select;
    }
}
