<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente Shortcuts de Bootstrap 5.3.3
 *
 * Genera una cuadrícula responsiva de accesos directos con ícono, título y descripción.
 *
 * Opciones disponibles:
 * - 'items':      array  - Arreglo de ítems de acceso directo (requerido)
 * - 'cols':       array  - Columnas responsivas [default: xxl=4, xl=4, lg=3, md=2, default=2]
 * - 'gutter':     string|int - Espaciado entre columnas (g-*)
 * - 'gutterX':    string|int - Espaciado horizontal (gx-*)
 * - 'gutterY':    string|int - Espaciado vertical (gy-*)
 * - 'class':      string - Clases adicionales para el contenedor row [default: '']
 * - 'attributes': array  - Atributos HTML adicionales para el contenedor [default: []]
 *
 * Estructura de cada elemento en 'items':
 * - 'href':        string - URL del enlace (requerido)
 * - 'icon':        string - Clases del ícono, ej: 'fa-light fa-image' (requerido)
 * - 'title':       string - Título del shortcut (requerido)
 * - 'subtitle':    string - Descripción/subtítulo [default: '']
 * - 'target':      string - Atributo target del enlace [default: '_self']
 * - 'class':       string - Clases adicionales para el enlace [default: '']
 * - 'icon_class':  string - Clases adicionales para el div contenedor del ícono [default: '']
 *
 * Ejemplo de uso:
 * ```php
 * $shortcuts = new Shortcuts([
 *     'items' => [
 *         [
 *             'href'     => '/settings/logos/view/253acc7991b32',
 *             'icon'     => 'fa-light fa-image',
 *             'title'    => 'Logotipos',
 *             'subtitle' => 'Herramienta',
 *         ],
 *     ],
 *     'gutter' => 3
 * ]);
 * echo $shortcuts->render();
 * ```
 *
 * @implements ComponentInterface
 */
class Shortcuts extends AbstractComponent implements ComponentInterface
{
    private array $items = [];
    private array $cols;
    private string $class = '';
    private array $attributes = [];
    private array $options = [];

    private const DEFAULT_COLS = [
        'xxl'     => 4,
        'xl'      => 4,
        'lg'      => 3,
        'md'      => 2,
        'default' => 2,
    ];

    /**
     * Constructor
     *
     * @param array $config Opciones de configuración
     */
    public function __construct(array $config = [])
    {
        if (empty($config['items']) || !is_array($config['items'])) {
            throw new \InvalidArgumentException('El parámetro "items" es requerido para Shortcuts y debe ser un arreglo.');
        }

        $this->items = $config['items'];
        $this->cols  = array_merge(self::DEFAULT_COLS, $config['cols'] ?? []);

        if (isset($config['class'])) {
            $this->class = (string) $config['class'];
        }

        if (isset($config['attributes']) && is_array($config['attributes'])) {
            $this->attributes = $config['attributes'];
        }

        $this->options = [
            'gutter'  => $config['gutter'] ?? null,
            'gutterX' => $config['gutterX'] ?? null,
            'gutterY' => $config['gutterY'] ?? null,
        ];

        $this->validateItems();
    }

    /**
     * Renderiza el componente completo
     *
     * @return TagInterface
     */
    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            $this->buildRowClasses(),
            $this->attributes['class'] ?? null
        );

        $row = Html::tag('div', $this->attributes);

        $cols = [];
        foreach ($this->items as $item) {
            $cols[] = $this->renderItem($item);
        }

        $row->content($cols);
        return $row;
    }

    /**
     * Construye las clases CSS del contenedor row con columnas responsivas
     */
    private function buildRowClasses(): string
    {
        $classes = ['row'];

        foreach (['xxl', 'xl', 'lg', 'md'] as $bp) {
            if (!empty($this->cols[$bp])) {
                $classes[] = "row-cols-{$bp}-{$this->cols[$bp]}";
            }
        }

        if (!empty($this->cols['default'])) {
            $classes[] = "row-cols-{$this->cols['default']}";
        }

        if ($this->options['gutter'] !== null) {
            $classes[] = "g-{$this->options['gutter']}";
        }
        if ($this->options['gutterX'] !== null) {
            $classes[] = "gx-{$this->options['gutterX']}";
        }
        if ($this->options['gutterY'] !== null) {
            $classes[] = "gy-{$this->options['gutterY']}";
        }

        $classes[] = 'text-center';
        $classes[] = 'shortcuts';

        return $this->mergeClasses(implode(' ', $classes), $this->class);
    }

    /**
     * Renderiza un ítem individual de shortcut
     */
    private function renderItem(array $item): TagInterface
    {
        $col = Html::tag('div', ['class' => 'col mb-1']);

        $linkClass = $this->mergeClasses('shortcut border w-100', $item['class'] ?? '');
        $link = Html::tag('a', [
            'href'   => $item['href'],
            'class'  => $linkClass,
            'target' => $item['target'] ?? '_self',
        ]);

        // Contenedor del ícono
        $iconContainerClass = $this->mergeClasses('container-icon', $item['icon_class'] ?? '');
        $iconContainer      = Html::tag('div', ['class' => $iconContainerClass]);
        $icon               = Html::tag('i', ['class' => $this->mergeClasses('icon', $item['icon'])]);
        $iconContainer->content([$icon]);

        // Título (Soporta Html::raw() si se pasa como tal)
        $h5 = Html::tag('h5');
        $h5->content($item['title']);

        $linkContent = [$iconContainer, $h5];

        // Subtítulo/descripción (opcional)
        if (!empty($item['subtitle'])) {
            $p = Html::tag('p');
            $p->content($item['subtitle']);
            $linkContent[] = $p;
        }

        $link->content($linkContent);
        $col->content([$link]);

        return $col;
    }

    /**
     * Valida que cada ítem tenga los campos requeridos
     */
    private function validateItems(): void
    {
        foreach ($this->items as $index => $item) {
            foreach (['href', 'icon', 'title'] as $field) {
                if (empty($item[$field])) {
                    throw new \InvalidArgumentException(
                        "El ítem [{$index}] requiere el parámetro \"{$field}\"."
                    );
                }
            }
        }
    }
}
