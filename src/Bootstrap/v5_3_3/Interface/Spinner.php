<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Tag\TagInterface;

class Spinner extends AbstractComponent
{
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->attributes = $attributes;
        $this->options = array_merge([
            'type' => 'border', // border, grow
            'variant' => 'primary',
            'size' => null, // sm
            'text' => 'Cargando...',
            'centered' => false,
            'button' => false,
            'buttonText' => null,
            'buttonVariant' => 'primary',
        ], $options);
    }

    public function render(): TagInterface
    {
        if ($this->options['button']) {
            return $this->renderButton();
        }

        if ($this->options['centered']) {
            return $this->renderCentered();
        }

        return $this->renderSpinner();
    }

    protected function renderSpinner(): TagInterface
    {
        $this->prepareClasses();
        return $this->createComponent('div', $this->attributes)
            ->content($this->options['text']);
    }

    protected function renderCentered(): TagInterface
    {
        return $this->createComponent('div', [
            'class' => 'd-flex justify-content-center'
        ])->content($this->renderSpinner());
    }

    protected function renderButton(): TagInterface
    {
        $button = Button::create($this->options['buttonText'] ?? '')
            ->setVariant($this->options['buttonVariant'])
            ->disabled()
            ->render();

        $this->attributes['class'] = $this->mergeClasses(
            "spinner-{$this->options['type']}",
            $this->options['size'] ? "spinner-{$this->options['type']}-sm" : null,
            'me-2',
            $this->attributes['class'] ?? null
        );

        $this->attributes['role'] = 'status';
        $this->attributes['aria-hidden'] = 'true';

        $spinner = $this->createComponent('span', $this->attributes);
        $button->content([$spinner, $this->options['buttonText']]);

        return $button;
    }

    protected function prepareClasses(): void
    {
        $classes = ["spinner-{$this->options['type']}"];

        if ($this->options['variant'] !== 'primary') {
            $classes[] = "text-{$this->options['variant']}";
        }

        if ($this->options['size']) {
            $classes[] = "spinner-{$this->options['type']}-{$this->options['size']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['role'] = 'status';
        $this->attributes['aria-hidden'] = 'true';
    }

    public static function create(): self
    {
        return new self();
    }

    public function border(): self
    {
        $this->options['type'] = 'border';
        return $this;
    }

    public function grow(): self
    {
        $this->options['type'] = 'grow';
        return $this;
    }

    public function setVariant(string $variant): self
    {
        $this->options['variant'] = $variant;
        return $this;
    }

    public function small(): self
    {
        $this->options['size'] = 'sm';
        return $this;
    }

    public function setText(string $text): self
    {
        $this->options['text'] = $text;
        return $this;
    }

    public function centered(bool $centered = true): self
    {
        $this->options['centered'] = $centered;
        return $this;
    }

    public function asButton(string $text, string $variant = 'primary'): self
    {
        $this->options['button'] = true;
        $this->options['buttonText'] = $text;
        $this->options['buttonVariant'] = $variant;
        return $this;
    }
}
