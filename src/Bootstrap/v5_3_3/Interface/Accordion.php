<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Accordion de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'id': string - ID del acordeón (requerido)
 * - 'items': array - Items del acordeón [['title' => '', 'content' => '', 'show' => bool]]
 * - 'flush': bool - Si es flush [default: false]
 * - 'alwaysOpen': bool - Si permite múltiples abiertos [default: false]
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Accordion extends AbstractComponent implements ComponentInterface
{
    private ?string $id = null;
    private array $items = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->id = $options['id'] ?? null;

        if (isset($options['items']) && is_array($options['items'])) {
            $this->items = $options['items'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'flush' => $options['flush'] ?? false,
            'alwaysOpen' => $options['alwaysOpen'] ?? false,
        ];
    }

    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            'accordion',
            $this->options['flush'] ? 'accordion-flush' : null,
            $this->attributes['class'] ?? null
        );
        $this->attributes['id'] = $this->id;

        $accordion = $this->createComponent('div', $this->attributes);

        foreach ($this->items as $index => $item) {
            $accordion->content($this->createAccordionItem($item, $index));
        }

        return $accordion;
    }

    protected function createAccordionItem(array $item, int $index): TagInterface
    {
        $itemId = "{$this->id}_item{$index}";
        $headingId = "{$this->id}_heading{$index}";
        $collapseId = "{$this->id}_collapse{$index}";
        $show = $item['show'] ?? false;

        // Item wrapper
        $accordionItem = Html::tag('div', ['class' => 'accordion-item']);

        // Header
        $header = Html::tag('h2', ['class' => 'accordion-header', 'id' => $headingId]);

        // Button
        $button = Html::tag('button', [
            'class' => 'accordion-button' . ($show ? '' : ' collapsed'),
            'type' => 'button',
            'data-bs-toggle' => 'collapse',
            'data-bs-target' => "#{$collapseId}",
            'aria-expanded' => $show ? 'true' : 'false',
            'aria-controls' => $collapseId
        ], $item['title']);

        $header->content($button);

        // Collapse
        $collapse = Html::tag('div', [
            'id' => $collapseId,
            'class' => 'accordion-collapse collapse' . ($show ? ' show' : ''),
            'aria-labelledby' => $headingId,
            'data-bs-parent' => $this->options['alwaysOpen'] ? null : "#{$this->id}"
        ]);

        // Body
        $body = Html::tag('div', ['class' => 'accordion-body'], $item['content']);

        $collapse->content($body);
        $accordionItem->content([$header, $collapse]);

        return $accordionItem;
    }

    public function addItem(string $title, mixed $content, bool $show = false): self
    {
        $this->items[] = [
            'title' => $title,
            'content' => $content,
            'show' => $show
        ];
        return $this;
    }

    // Métodos fluidos opcionales
    public function flush(bool $flush = true): self
    {
        $this->options['flush'] = $flush;
        return $this;
    }
    public function alwaysOpen(bool $alwaysOpen = true): self
    {
        $this->options['alwaysOpen'] = $alwaysOpen;
        return $this;
    }
}
