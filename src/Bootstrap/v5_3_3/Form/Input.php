<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Input extends AbstractComponent
{
    private string $type;
    private string $name;
    private array $attributes;

    public function __construct(string $type = 'text', string $name = '', array $attributes = [])
    {
        $this->type = $type;
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $this->attributes['type'] = $this->type;
        $this->attributes['id'] = $this->attributes['id'] ?? "input-{$this->name}";
        $this->attributes['name'] = $this->name;

        $this->attributes['class'] = $this->mergeClasses(
            'form-control',
            $this->attributes['class'] ?? null
        );

        return Html::tag('input', $this->attributes);
    }
}
