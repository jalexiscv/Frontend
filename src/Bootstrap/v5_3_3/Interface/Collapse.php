<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Collapse extends AbstractComponent
{
    private string $id;
    private string $content;
    private array $attributes;

    public function __construct(string $id, string $content = '', array $attributes = [])
    {
        $this->id = $id;
        $this->content = $content;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $this->attributes['id'] = $this->id;
        $this->attributes['class'] = $this->mergeClasses(
            'collapse',
            $this->attributes['class'] ?? null
        );

        $div = $this->createComponent('div', $this->attributes);

        // Collapse card body usually goes inside
        $body = $this->createComponent('div', ['class' => 'card card-body']);
        $body->content($this->content);

        $div->content($body);

        return $div;
    }
}
