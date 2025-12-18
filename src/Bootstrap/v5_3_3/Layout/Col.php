<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Col extends AbstractComponent
{
    private string $size;
    private array $attributes;

    public function __construct(string $size = '', array $attributes = [])
    {
        $this->size = $size;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        if ($this->size) {
            $this->attributes['class'] = $this->mergeClasses(
                $this->size,
                $this->attributes['class'] ?? null
            );
        } else {
            // Default to 'col' if no specifics are given, but AbstractComponent usually handles classes well.
            // If size is empty, we might want just 'col' or let the user decide.
            // Bootstrap default column class is 'col'
            $this->attributes['class'] = $this->mergeClasses(
                'col',
                $this->attributes['class'] ?? null
            );
        }

        return $this->createComponent('div', $this->attributes);
    }
}
