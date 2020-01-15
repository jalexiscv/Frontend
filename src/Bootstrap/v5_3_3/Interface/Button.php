<?php

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Button extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private mixed $content = null;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->content = $this->processContent($options);

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'type' => $options['type'] ?? 'button',
            'variant' => $options['variant'] ?? 'primary',
            'outline' => $options['outline'] ?? false,
            'size' => $options['size'] ?? null,
            'block' => $options['block'] ?? false,
            'active' => $options['active'] ?? false,
            'disabled' => $options['disabled'] ?? false,
            'loading' => $options['loading'] ?? false,
            'loadingText' => $options['loadingText'] ?? 'Cargando...',
            'icon' => $options['icon'] ?? null,
            'iconPosition' => $options['iconPosition'] ?? 'start',
        ];
    }

    public function render(): TagInterface
    {
        if (isset($this->attributes['href'])) {
            $button = Html::tag('a', $this->attributes);
        } else {
            $button = $this->createComponent('button', $this->attributes);
        }

        // Aplicamos variantes
        $this->addVariantClasses($button, $this->options['variant']);

        // Aplicamos tamaño
        if ($this->options['size']) {
            $this->addSizeClasses($button, $this->options['size'], 'btn');
        }

        // Aplicamos clases base y adicionales
        $button->addClass('btn');

        if ($this->options['outline']) {
            // Reemplazamos la clase de variante normal por la de outline
            $button->removeClass("btn-{$this->options['variant']}");
            $button->addClass("btn-outline-{$this->options['variant']}");
        }

        if ($this->options['block']) {
            $button->addClass('d-block w-100');
        }

        if ($this->options['active']) {
            $button->addClass('active');
            $button->setAttribute('aria-pressed', 'true');
        }

        if (isset($this->attributes['href'])) {
            if (!$button->getAttribute('role')) {
                $button->setAttribute('role', 'button');
            }
        } else {
            $button->setAttribute('type', $this->options['type']);
        }

        if ($this->options['disabled']) {
            if (isset($this->attributes['href'])) {
                $button->setAttribute('aria-disabled', 'true');
                $button->setAttribute('tabindex', '-1');
            } else {
                $button->setAttribute('disabled', 'disabled');
            }
        }

        if ($this->options['loading']) {
            $button->setAttribute('disabled', 'disabled');
        }

        $content = $this->prepareContent();
        if (is_array($content)) {
            foreach ($content as $item) {
                if ($item !== null && $item !== '') {
                    $button->append($item);
                }
            }
        } else {
            $button->content($content);
        }

        return $button;
    }

    protected function addVariantClasses(TagInterface $element, string $variant): void
    {
        $element->addClass('btn-' . $variant);
    }

    protected function prepareContent(): array
    {
        $content = [];

        if ($this->options['loading']) {
            $content[] = $this->createSpinner();
            $content[] = $this->options['loadingText'];
            return $content;
        }

        if ($this->options['icon'] && $this->options['iconPosition'] === 'start') {
            $content[] = $this->createIcon();
            $content[] = ' ';
        }

        $content[] = $this->content;

        if ($this->options['icon'] && $this->options['iconPosition'] === 'end') {
            $content[] = ' ';
            $content[] = $this->createIcon();
        }

        return $content;
    }

    protected function createSpinner(): TagInterface
    {
        return Html::tag('span', [
            'class' => 'spinner-border spinner-border-sm me-2',
            'role' => 'status',
            'aria-hidden' => 'true'
        ]);
    }

    protected function createIcon(): TagInterface
    {
        return Html::tag('i', [
            'class' => $this->options['icon']
        ]);
    }
}
