<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Row extends AbstractComponent
{
    private array $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'row',
            $this->attributes['class'] ?? null
        );

        return $this->createComponent('div', $this->attributes);
    }
}
