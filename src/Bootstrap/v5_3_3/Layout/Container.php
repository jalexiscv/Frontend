<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Layout;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Container extends AbstractComponent
{
    private string $type;
    private array $attributes;
    private mixed $content;

    public function __construct(
        string $type = 'default',
        array $attributes = [],
        mixed $content = null
    ) {
        $this->type = $type;
        $this->attributes = $attributes;
        $this->content = $content;
    }

    public function render(): TagInterface
    {
        $class = match ($this->type) {
            'fluid' => 'container-fluid',
            'sm' => 'container-sm',
            'md' => 'container-md',
            'lg' => 'container-lg',
            'xl' => 'container-xl',
            'xxl' => 'container-xxl',
            default => 'container'
        };

        $this->attributes['class'] = $this->mergeClasses(
            $class,
            $this->attributes['class'] ?? null
        );

        $container = $this->createComponent('container', $this->attributes);
        if ($this->content !== null) {
            $container->content($this->content);
        }

        return $container;
    }

    public static function fluid(array $attributes = [], mixed $content = null): self
    {
        return new self('fluid', $attributes, $content);
    }

    public static function responsive(
        string $breakpoint,
        array $attributes = [],
        mixed $content = null
    ): self {
        return new self($breakpoint, $attributes, $content);
    }
}
