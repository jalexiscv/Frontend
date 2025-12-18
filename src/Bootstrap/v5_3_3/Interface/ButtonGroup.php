<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class ButtonGroup extends AbstractComponent
{
    private array $buttons;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->buttons = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'vertical' => false,
            'size' => null,
            'aria-label' => 'Button group',
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            $this->options['vertical'] ? 'btn-group-vertical' : 'btn-group',
            $this->options['size'] ? "btn-group-{$this->options['size']}" : null,
            $this->attributes['class'] ?? null
        );

        $this->attributes['role'] = 'group';
        $this->attributes['aria-label'] = $this->options['aria-label'];

        $group = $this->createComponent('div', $this->attributes);
        $group->content($this->buttons);

        return $group;
    }

    public function addButton(Button $button): self
    {
        $this->buttons[] = $button;
        return $this;
    }

    public function addButtons(array $buttons): self
    {
        foreach ($buttons as $button) {
            if ($button instanceof Button) {
                $this->buttons[] = $button;
            }
        }
        return $this;
    }

    public function vertical(bool $vertical = true): self
    {
        $this->options['vertical'] = $vertical;
        return $this;
    }

    public function size(string $size): self
    {
        $this->options['size'] = $size;
        return $this;
    }

    public function setAriaLabel(string $label): self
    {
        $this->options['aria-label'] = $label;
        return $this;
    }

    public static function create(): self
    {
        return new self();
    }

    public static function toolbar(array $groups, array $attributes = []): TagInterface
    {
        $attributes['class'] = self::mergeClasses(
            'btn-toolbar',
            $attributes['class'] ?? null
        );
        $attributes['role'] = 'toolbar';

        $toolbar = (new self())->createComponent('div', $attributes);
        $toolbar->content($groups);

        return $toolbar;
    }
}
