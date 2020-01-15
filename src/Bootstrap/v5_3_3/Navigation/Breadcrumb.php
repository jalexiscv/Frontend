<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Breadcrumb de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'items': array - Lista de items [['label' => '', 'href' => 'url', 'active' => bool]]
 * - 'divider': string - Divisor personalizado
 * - 'attributes': array - Atributos HTML del container (nav)
 * 
 * @implements ComponentInterface
 */
class Breadcrumb extends AbstractComponent implements ComponentInterface
{
    private array $items = [];
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        if (isset($options['items']) && is_array($options['items'])) {
            $this->items = $options['items'];
        }

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'divider' => $options['divider'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $this->attributes['aria-label'] = 'breadcrumb';

        if ($this->options['divider']) {
            $this->attributes['style'] = "--bs-breadcrumb-divider: '{$this->options['divider']}';" . ($this->attributes['style'] ?? '');
        }

        $nav = $this->createComponent('nav', $this->attributes);
        $ol = Html::tag('ol', ['class' => 'breadcrumb']);

        $listItems = [];
        foreach ($this->items as $item) {
            $listItems[] = $this->createItem($item);
        }

        $ol->content($listItems);
        $nav->content($ol);

        return $nav;
    }

    protected function createItem(array $item): TagInterface
    {
        $isActive = $item['active'] ?? false;
        $li = Html::tag('li', ['class' => 'breadcrumb-item' . ($isActive ? ' active' : '')]);

        if ($isActive) {
            $li->setAttribute('aria-current', 'page');
            $li->content($item['label']);
        } else {
            $li->content(Html::tag('a', ['href' => $item['href'] ?? '#'], $item['label']));
        }

        return $li;
    }

    public function addItem(string $label, ?string $href = null, bool $active = false): self
    {
        $this->items[] = [
            'label' => $label,
            'href' => $href,
            'active' => $active
        ];
        return $this;
    }
}
