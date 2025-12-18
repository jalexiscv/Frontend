<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Navigation;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Navbar de Bootstrap 5.3.3
 * 
 * Opciones:
 * - 'brand': mixed - Brand content (string o array)
 * - 'expand': string - Breakpoint expansion ('sm', 'md', 'lg', 'xl', 'xxl') [default: 'lg']
 * - 'color': string - Color ('light', 'dark') [default: 'light'] (deprecated in BS5.3 but kept for compatibility, use theme)
 * - 'theme': string - Theme ('light', 'dark') [default: 'light'] (data-bs-theme)
 * - 'bg': string - Background class (e.g., 'bg-light', 'bg-body-tertiary')
 * - 'container': string|bool - Container type ('fluid', etc.) or false [default: 'fluid']
 * - 'content': mixed - Contenido del navbar
 * - 'attributes': array - Atributos HTML
 * 
 * @implements ComponentInterface
 */
class Navbar extends AbstractComponent implements ComponentInterface
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
            'brand' => $options['brand'] ?? null,
            'expand' => $options['expand'] ?? 'lg',
            'theme' => $options['theme'] ?? 'light',
            'bg' => $options['bg'] ?? 'bg-body-tertiary',
            'container' => $options['container'] ?? 'fluid',
        ];

        // Compatibilidad legacy color
        if (isset($options['color'])) {
            $this->options['theme'] = $options['color'];
            if (!isset($options['bg'])) {
                $this->options['bg'] = $options['color'] === 'dark' ? 'bg-dark' : 'bg-light';
            }
        }
    }

    public function render(): TagInterface
    {
        $classes = ['navbar', "navbar-expand-{$this->options['expand']}", $this->options['bg']];

        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        $this->attributes['data-bs-theme'] = $this->options['theme'];

        $navbar = $this->createComponent('nav', $this->attributes);

        $containerClass = $this->options['container'] === true ? 'container' : ($this->options['container'] === 'fluid' ? 'container-fluid' : "container-{$this->options['container']}");

        if ($this->options['container'] === false) {
            // No container wrapper
            $wrapper = $navbar;
        } else {
            $wrapper = Html::tag('div', ['class' => $containerClass]);
        }

        $innerContent = [];

        if ($this->options['brand']) {
            $brand = $this->options['brand'];
            if (is_string($brand)) {
                $brand = Html::tag('a', ['class' => 'navbar-brand', 'href' => '#'], $brand);
            }
            $innerContent[] = $brand;
        }

        // Toggler button always generated for expand
        $toggler = Html::tag('button', [
            'class' => 'navbar-toggler',
            'type' => 'button',
            'data-bs-toggle' => 'collapse',
            'data-bs-target' => '#navbarCollapse', // TODO: Make dynamic ID
            'aria-controls' => 'navbarCollapse',
            'aria-expanded' => 'false',
            'aria-label' => 'Toggle navigation'
        ]);
        $toggler->content(Html::tag('span', ['class' => 'navbar-toggler-icon']));
        $innerContent[] = $toggler;

        // Collapse content
        $collapse = Html::tag('div', ['class' => 'collapse navbar-collapse', 'id' => 'navbarCollapse']);
        if ($this->content) {
            $collapse->content($this->content);
        }
        $innerContent[] = $collapse;

        if ($this->options['container'] !== false) {
            $wrapper->content($innerContent);
            $navbar->content($wrapper);
        } else {
            $navbar->content($innerContent);
        }

        return $navbar;
    }
}
