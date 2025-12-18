<?php
declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

class Pagination extends AbstractComponent
{
    private array $items;
    private array $attributes;
    private array $options;

    public function __construct(array $attributes = [], array $options = [])
    {
        $this->items = [];
        $this->attributes = $attributes;
        $this->options = array_merge([
            'size' => null,
            'alignment' => null,
            'ariaLabel' => 'Navegación de páginas',
        ], $options);
    }

    public function render(): TagInterface
    {
        $nav = Html::tag('nav', [
            'aria-label' => $this->options['ariaLabel']
        ]);

        $this->prepareClasses();
        $ul = $this->createComponent('ul', $this->attributes);
        $ul->content($this->items);
        $nav->content($ul);

        return $nav;
    }

    protected function prepareClasses(): void
    {
        $classes = ['pagination'];

        if ($this->options['size']) {
            $classes[] = "pagination-{$this->options['size']}";
        }

        if ($this->options['alignment']) {
            $classes[] = "justify-content-{$this->options['alignment']}";
        }

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );
    }

    protected function createPageItem(
        mixed $content,
        ?string $href = null,
        array $attributes = []
    ): TagInterface {
        $liClasses = ['page-item'];
        $aClasses = ['page-link'];

        if (isset($attributes['active'])) {
            $liClasses[] = 'active';
        }

        if (isset($attributes['disabled'])) {
            $liClasses[] = 'disabled';
        }

        $li = Html::tag('li', [
            'class' => implode(' ', $liClasses)
        ]);

        $aAttributes = array_merge($attributes, [
            'class' => implode(' ', $aClasses),
            'href' => $href ?? '#'
        ]);

        if (isset($attributes['disabled'])) {
            $aAttributes['tabindex'] = '-1';
            $aAttributes['aria-disabled'] = 'true';
        }

        if (isset($attributes['active'])) {
            $aAttributes['aria-current'] = 'page';
        }

        $a = Html::tag('a', $aAttributes, $content);
        $li->content($a);

        return $li;
    }

    public function addItem(mixed $content, ?string $href = null, array $attributes = []): self
    {
        $this->items[] = $this->createPageItem($content, $href, $attributes);
        return $this;
    }

    public function addPrevious(mixed $content = '«', ?string $href = null, bool $disabled = false): self
    {
        return $this->addItem($content, $href, [
            'disabled' => $disabled,
            'aria-label' => 'Anterior'
        ]);
    }

    public function addNext(mixed $content = '»', ?string $href = null, bool $disabled = false): self
    {
        return $this->addItem($content, $href, [
            'disabled' => $disabled,
            'aria-label' => 'Siguiente'
        ]);
    }

    public function addNumbered(int $current, int $total, string $urlPattern = '?page=%d'): self
    {
        $this->addPrevious(null, $current > 1 ? sprintf($urlPattern, $current - 1) : null, $current <= 1);

        for ($i = 1; $i <= $total; $i++) {
            $this->addItem($i, sprintf($urlPattern, $i), [
                'active' => $i === $current
            ]);
        }

        $this->addNext(null, $current < $total ? sprintf($urlPattern, $current + 1) : null, $current >= $total);

        return $this;
    }

    public function size(string $size): self
    {
        $this->options['size'] = $size;
        return $this;
    }

    public function alignment(string $alignment): self
    {
        $this->options['alignment'] = $alignment;
        return $this;
    }

    public function ariaLabel(string $label): self
    {
        $this->options['ariaLabel'] = $label;
        return $this;
    }

    public static function create(): self
    {
        return new self();
    }
}
