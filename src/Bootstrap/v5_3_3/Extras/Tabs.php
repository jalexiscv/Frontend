<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente Tabs de Bootstrap 5.3.3
 * 
 * Crea un sistema de pestañas (tabs) con navegación y contenido.
 * 
 * Opciones disponibles:
 * - 'tabs': array - Array de pestañas (requerido)
 * - 'id': string - ID base para las pestañas [default: 'myTab']
 * - 'pills': bool - Usar estilo pills en lugar de tabs [default: false]
 * - 'vertical': bool - Orientación vertical [default: false]
 * - 'fade': bool - Animación fade [default: true]
 * - 'justified': bool - Tabs ocupan todo el ancho [default: false]
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * Estructura de cada tab en el array 'tabs':
 * - 'id': string - ID único de la pestaña (requerido)
 * - 'title': string - Título de la pestaña (requerido si no hay htmlTitle ni icon)
 * - 'htmlTitle': string - Título HTML sin escapar (alternativa a title)
 * - 'icon': string - Clase de ícono (alternativa a title/htmlTitle, o adicional)
 * - 'content': string - Contenido (se escapa por defecto)
 * - 'htmlContent': string - Contenido HTML sin escapar (alternativa a content)
 * - 'active': bool - Si es la pestaña activa [default: false en todas]
 * - 'disabled': bool - Si está deshabilitada [default: false]
 * - 'class': string - Clases CSS adicionales para el botón
 * 
 * @implements ComponentInterface
 * 
 * @example
 * new Tabs([
 *     'tabs' => [
 *         ['id' => 'home', 'title' => 'Inicio', 'content' => 'Contenido de inicio', 'active' => true],
 *         ['id' => 'profile', 'title' => 'Perfil', 'htmlContent' => '<p>Contenido del perfil</p>'],
 *         ['id' => 'settings', 'icon' => 'fas fa-cog', 'title' => 'Configuración', 'content' => 'Opciones']
 *     ]
 * ]);
 */
class Tabs extends AbstractComponent implements ComponentInterface
{
    use HtmlContentTrait;

    private array $tabs = [];
    private string $id = 'myTab';
    private bool $pills = false;
    private bool $vertical = false;
    private bool $fade = true;
    private bool $justified = false;
    private array $attributes = [];

    /**
     * Constructor
     * 
     * @param array $options Array de opciones de configuración
     */
    public function __construct(array $options = [])
    {
        // Tabs (requerido)
        if (isset($options['tabs']) && is_array($options['tabs'])) {
            $this->tabs = $options['tabs'];
        }

        // ID base
        if (isset($options['id'])) {
            $this->id = $options['id'];
        }

        // Estilo pills
        if (isset($options['pills'])) {
            $this->pills = (bool)$options['pills'];
        }

        // Orientación vertical
        if (isset($options['vertical'])) {
            $this->vertical = (bool)$options['vertical'];
        }

        // Animación fade
        if (isset($options['fade'])) {
            $this->fade = (bool)$options['fade'];
        }

        // Justified
        if (isset($options['justified'])) {
            $this->justified = (bool)$options['justified'];
        }

        // Atributos
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }

        // Validar
        $this->validate();
    }

    /**
     * Valida las opciones del componente
     * 
     * @throws \InvalidArgumentException
     */
    private function validate(): void
    {
        if (empty($this->tabs)) {
            throw new \InvalidArgumentException('Tabs: se requiere al menos una pestaña en el array "tabs"');
        }

        foreach ($this->tabs as $index => $tab) {
            if (!isset($tab['id'])) {
                throw new \InvalidArgumentException("Tabs: falta 'id' en la pestaña índice {$index}");
            }
            if (!isset($tab['title']) && !isset($tab['htmlTitle']) && !isset($tab['icon'])) {
                throw new \InvalidArgumentException("Tabs: la pestaña '{$tab['id']}' debe tener al menos 'title', 'htmlTitle' o 'icon'");
            }
        }
    }

    /**
     * Renderiza el componente
     * 
     * @return TagInterface
     */
    public function render(): TagInterface
    {
        $container = Html::tag('div', $this->attributes);
        $elements = [];

        // Crear navegación de tabs
        $elements[] = $this->createNav();

        // Crear contenido de tabs
        $elements[] = $this->createTabContent();

        $container->content($elements);
        return $container;
    }

    /**
     * Crea la navegación de tabs
     */
    private function createNav(): TagInterface
    {
        $navType = $this->pills ? 'nav-pills' : 'higgs-tabs nav-tabs';
        $classes = ['nav', $navType];

        if ($this->justified) {
            $classes[] = 'nav-justified';
        }

        if ($this->vertical) {
            $classes[] = 'flex-column';
        }

        $nav = Html::tag('ul', [
            'class' => implode(' ', $classes),
            'id' => $this->id,
            'role' => 'tablist'
        ]);

        $navItems = [];
        foreach ($this->tabs as $tab) {
            $navItems[] = $this->createNavItem($tab);
        }

        $nav->content($navItems);
        return $nav;
    }

    /**
     * Crea un item de navegación
     */
    private function createNavItem(array $tab): TagInterface
    {
        $li = Html::tag('li', [
            'class' => 'nav-item',
            'role' => 'presentation'
        ]);

        $button = $this->createNavButton($tab);
        $li->content($button);

        return $li;
    }

    /**
     * Crea el botón de navegación
     */
    private function createNavButton(array $tab): TagInterface
    {
        $classes = ['nav-link'];

        if (!empty($tab['active'])) {
            $classes[] = 'active';
        }

        if (!empty($tab['disabled'])) {
            $classes[] = 'disabled';
        }

        if (!empty($tab['class'])) {
            $classes[] = $tab['class'];
        }

        $button = Html::tag('button', [
            'class' => implode(' ', $classes),
            'id' => $tab['id'] . '-tab',
            'data-bs-toggle' => 'tab',
            'data-bs-target' => '#' . $tab['id'],
            'type' => 'button',
            'role' => 'tab',
            'aria-controls' => $tab['id'],
            'aria-selected' => !empty($tab['active']) ? 'true' : 'false'
        ]);

        // Contenido del botón (ícono y/o título)
        $buttonContent = [];

        if (!empty($tab['icon'])) {
            $buttonContent[] = Html::tag('i', ['class' => $tab['icon']]);
            if (isset($tab['title']) || isset($tab['htmlTitle'])) {
                $buttonContent[] = ' ';
            }
        }

        if (isset($tab['htmlTitle'])) {
            $buttonContent[] = Html::raw($tab['htmlTitle']);
        } elseif (isset($tab['title'])) {
            $buttonContent[] = $tab['title'];
        }

        $button->content($buttonContent);
        return $button;
    }

    /**
     * Crea el contenedor de contenido de tabs
     */
    private function createTabContent(): TagInterface
    {
        $tabContent = Html::tag('div', [
            'class' => 'tab-content',
            'id' => $this->id . 'Content'
        ]);

        $panes = [];
        foreach ($this->tabs as $tab) {
            $panes[] = $this->createTabPane($tab);
        }

        $tabContent->content($panes);
        return $tabContent;
    }

    /**
     * Crea un panel de contenido de tab
     */
    private function createTabPane(array $tab): TagInterface
    {
        $classes = ['tab-pane'];

        if ($this->fade) {
            $classes[] = 'fade';
        }

        if (!empty($tab['active'])) {
            $classes[] = 'show active';
        }

        $pane = Html::tag('div', [
            'class' => implode(' ', $classes),
            'id' => $tab['id'],
            'role' => 'tabpanel',
            'aria-labelledby' => $tab['id'] . '-tab'
        ]);

        // Contenido del pane
        if (isset($tab['htmlContent'])) {
            $pane->content(Html::raw($tab['htmlContent']));
        } elseif (isset($tab['content'])) {
            $pane->content($tab['content']);
        }

        return $pane;
    }
}
