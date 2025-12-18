<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Pagination de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'total': int - Total de páginas (requerido)
 * - 'current': int - Página actual [default: 1]
 * - 'size': string - Tamaño ('sm', 'lg')
 * - 'alignment': string - Alineación ('center', 'end')
 * - 'attributes': array - Atributos HTML del nav
 * 
 * @implements ComponentInterface
 */
class Pagination extends AbstractComponent implements ComponentInterface
{
    private int $total;
    private int $current;
    private array $attributes = [];
    private array $options = [];

    public function __construct(array $options = [])
    {
        $this->total = $options['total'] ?? 1;
        $this->current = $options['current'] ?? 1;

        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        $this->options = [
            'size' => $options['size'] ?? null,
            'alignment' => $options['alignment'] ?? null,
        ];
    }

    public function render(): TagInterface
    {
        $this->attributes['aria-label'] = 'Page navigation';
        $nav = $this->createComponent('nav', $this->attributes);

        $ulClasses = ['pagination'];
        if ($this->options['size']) $ulClasses[] = "pagination-{$this->options['size']}";
        if ($this->options['alignment']) $ulClasses[] = "justify-content-{$this->options['alignment']}";

        $ul = Html::tag('ul', ['class' => implode(' ', $ulClasses)]);
        $items = [];

        // Previous
        $items[] = $this->createItem('Previous', $this->current - 1, $this->current <= 1);

        // Pages
        // TODO: Implement logic for many pages (ellipsis)
        for ($i = 1; $i <= $this->total; $i++) {
            $items[] = $this->createItem((string)$i, $i, false, $i === $this->current);
        }

        // Next
        $items[] = $this->createItem('Next', $this->current + 1, $this->current >= $this->total);

        $ul->content($items);
        $nav->content($ul);

        return $nav;
    }

    protected function createItem(string $label, int $page, bool $disabled = false, bool $active = false): TagInterface
    {
        $li = Html::tag('li', ['class' => 'page-item' . ($disabled ? ' disabled' : '') . ($active ? ' active' : '')]);

        $attrs = ['class' => 'page-link', 'href' => $disabled ? '#' : "?page={$page}"];
        if ($disabled) {
            $attrs['tabindex'] = '-1';
            $attrs['aria-disabled'] = 'true';
        }

        $li->content(Html::tag('a', $attrs, $label));
        return $li;
    }
}
