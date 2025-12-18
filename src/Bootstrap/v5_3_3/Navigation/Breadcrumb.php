<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Breadcrumb extends AbstractComponent
{
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->items = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'divider' => '/',
            'lastActive' => true,
        ], $options);
    }

    public function render(): TagInterface
    {
        $nav = Html::tag('nav', ['aria-label' => 'breadcrumb']);
        
        $this->attributes['class'] = $this->mergeClasses(
            'breadcrumb',
            $this->attributes['class'] ?? null
        );

        if ($this->options['divider'] !== '/') {
            $this->attributes['style'] = "--bs-breadcrumb-divider: '{$this->options['divider']}'";
        }

        $ol = $this->createComponent('ol', $this->attributes);
        
        foreach ($this->items as $index => $item) {
            $isLast = $index === count($this->items) - 1;
            $li = $this->createBreadcrumbItem($item, $isLast);
            $ol->content($li);
        }

        $nav->content($ol);
        return $nav;
    }

    protected function createBreadcrumbItem(array $item, bool $isLast): TagInterface
    {
        $attributes = ['class' => 'breadcrumb-item'];
        
        if ($isLast && $this->options['lastActive']) {
            $attributes['class'] .= ' active';
            $attributes['aria-current'] = 'page';
        }

        $li = Html::tag('li', $attributes);

        if ($isLast && $this->options['lastActive']) {
            $li->content($item['text']);
        } else {
            $li->content(Html::tag('a', [
                'href' => $item['href'] ?? '#'
            ], $item['text']));
        }

        return $li;
    }

    public function addItem(string $text, ?string $href = null): self
    {
        $this->items[] = [
            'text' => $text,
            'href' => $href
        ];
        return $this;
    }

    public function setDivider(string $divider): self
    {
        $this->options['divider'] = $divider;
        return $this;
    }

    public function lastActive(bool $active = true): self
    {
        $this->options['lastActive'] = $active;
        return $this;
    }

    public static function create(): self
    {
        return new self();
    }
}
