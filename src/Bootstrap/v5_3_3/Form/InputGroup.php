<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Form;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class InputGroup extends AbstractComponent
{
    private array $prepend;
    private array $append;
    private ?FormControl $control;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->prepend = [];
        $this->append = [];
        $this->control = null;
        $this->attributes = $attributes;
        $this->options = array_merge([
            'size' => null, // sm, lg
        ], $options);
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'input-group',
            $this->options['size'] ? "input-group-{$this->options['size']}" : null,
            $this->attributes['class'] ?? null
        );

        $group = $this->createComponent('div', $this->attributes);
        $elements = [];

        // Prepend elements
        foreach ($this->prepend as $element) {
            $elements[] = $this->wrapAddon($element);
        }

        // Input control
        if ($this->control) {
            $elements[] = $this->control->render();
        }

        // Append elements
        foreach ($this->append as $element) {
            $elements[] = $this->wrapAddon($element);
        }

        $group->content($elements);
        return $group;
    }

    protected function wrapAddon(mixed $content): TagInterface
    {
        if ($content instanceof TagInterface) {
            if (in_array('btn', explode(' ', $content->getAttribute('class') ?? ''))) {
                return $content;
            }
        }

        return Html::tag('span', ['class' => 'input-group-text'], $content);
    }

    public function prependText(string $text): self
    {
        $this->prepend[] = $text;
        return $this;
    }

    public function appendText(string $text): self
    {
        $this->append[] = $text;
        return $this;
    }

    public function prependHtml(mixed $html): self
    {
        $this->prepend[] = $html;
        return $this;
    }

    public function appendHtml(mixed $html): self
    {
        $this->append[] = $html;
        return $this;
    }

    public function setControl(FormControl $control): self
    {
        $this->control = $control;
        return $this;
    }

    public static function create(): self
    {
        return new self();
    }
}
