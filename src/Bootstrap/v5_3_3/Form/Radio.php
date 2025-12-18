<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Radio extends AbstractComponent
{
    private string $name;
    private array $attributes;

    public function __construct(string $name, array $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $this->attributes['type'] = 'radio';
        $this->attributes['name'] = $this->name;

        $this->attributes['class'] = $this->mergeClasses(
            'form-check-input',
            $this->attributes['class'] ?? null
        );

        return Html::tag('input', $this->attributes);
    }
}
