<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Content;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Image extends AbstractComponent
{
    private string $src;
    private ?string $alt;
    private array $attributes;
    private ?string $caption;

    public function __construct(
        string $src,
        ?string $alt = null,
        array $attributes = [],
        ?string $caption = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->attributes = $attributes;
        $this->caption = $caption;
    }

    public function render(): TagInterface
    {
        $this->attributes['src'] = $this->src;
        $this->attributes['alt'] = $this->alt ?? '';

        if ($this->caption) {
            return $this->renderFigure();
        }

        return $this->createComponent('img', $this->attributes);
    }

    private function renderFigure(): TagInterface
    {
        $figure = Html::tag('figure', ['class' => 'figure']);
        
        $this->attributes['class'] = $this->mergeClasses(
            'figure-img',
            $this->attributes['class'] ?? null
        );
        
        $image = $this->createComponent('img', $this->attributes);
        $caption = Html::tag('figcaption', ['class' => 'figure-caption'], $this->caption);
        
        $figure->content([$image, $caption]);
        return $figure;
    }

    public static function responsive(
        string $src,
        ?string $alt = null,
        array $attributes = []
    ): self {
        $attributes['class'] = self::mergeClasses(
            'img-fluid',
            $attributes['class'] ?? null
        );
        
        return new self($src, $alt, $attributes);
    }

    public static function thumbnail(
        string $src,
        ?string $alt = null,
        array $attributes = []
    ): self {
        $attributes['class'] = self::mergeClasses(
            'img-thumbnail',
            $attributes['class'] ?? null
        );
        
        return new self($src, $alt, $attributes);
    }

    public static function figure(
        string $src,
        string $caption,
        ?string $alt = null,
        array $attributes = []
    ): self {
        $attributes['class'] = self::mergeClasses(
            'img-fluid',
            $attributes['class'] ?? null
        );
        
        return new self($src, $alt, $attributes, $caption);
    }
}
