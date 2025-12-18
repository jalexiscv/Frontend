<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Figure extends AbstractComponent
{
    private string $src;
    private string $caption;
    private array $attributes;

    public function __construct(string $src, string $caption = '', array $attributes = [])
    {
        $this->src = $src;
        $this->caption = $caption;
        $this->attributes = $attributes;
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'figure',
            $this->attributes['class'] ?? null
        );

        $figure = $this->createComponent('figure', $this->attributes);

        $img = $this->createComponent('img', [
            'src' => $this->src,
            'class' => 'figure-img img-fluid rounded',
            'alt' => $this->caption
        ]);

        $figure->content($img);

        if ($this->caption) {
            $figCaption = $this->createComponent('figcaption', ['class' => 'figure-caption']);
            $figCaption->content($this->caption);
            $figure->content($figCaption);
        }

        return $figure;
    }
}
