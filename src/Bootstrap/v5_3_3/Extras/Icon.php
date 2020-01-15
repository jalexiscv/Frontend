<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Icon de Bootstrap 5.3.3
 * 
 * Componente para renderizar iconos utilizando Font Awesome mediante
 * la etiqueta <i> con las clases correspondientes.
 * 
 * Opciones:
 * - 'icon': string - Nombre del icono Font Awesome sin prefijo de estilo (ej: "rocket", "home", "user") [required]
 * - 'style': string - Estilo del icono Font Awesome ('light', 'solid', 'regular', 'thin', 'duotone', 'brands') [default: 'light']
 * - 'size': string|null - Tamaño del icono ('xs', 'sm', 'lg', 'xl', '2xl', '1x'-'10x') [default: null]
 * - 'fixedWidth': bool - Si el icono debe tener ancho fijo (fa-fw) [default: false]
 * - 'spin': bool - Si el icono debe girar (fa-spin) [default: false]
 * - 'pulse': bool - Si el icono debe pulsar (fa-pulse) [default: false]
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * @implements ComponentInterface
 * 
 * @example
 * // Icono básico
 * new Icon(['icon' => 'rocket']);
 * // Resultado: <i class="icon fa-light fa-rocket"></i>
 * 
 * @example
 * // Icono con estilo solid y tamaño grande
 * new Icon([
 *     'icon' => 'home',
 *     'style' => 'solid',
 *     'size' => '2xl'
 * ]);
 * // Resultado: <i class="icon fa-solid fa-home fa-2xl"></i>
 * 
 * @example
 * // Icono con ancho fijo y animación
 * new Icon([
 *     'icon' => 'spinner',
 *     'style' => 'solid',
 *     'fixedWidth' => true,
 *     'spin' => true
 * ]);
 * // Resultado: <i class="icon fa-solid fa-spinner fa-fw fa-spin"></i>
 */
class Icon extends AbstractComponent implements ComponentInterface
{
    private string $icon;
    private string $style = 'light';
    private ?string $size = null;
    private bool $fixedWidth = false;
    private bool $spin = false;
    private bool $pulse = false;
    private array $attributes = [];

    private const VALID_STYLES = ['light', 'solid', 'regular', 'thin', 'duotone', 'brands'];
    private const VALID_SIZES = ['xs', 'sm', 'lg', 'xl', '2xl', '1x', '2x', '3x', '4x', '5x', '6x', '7x', '8x', '9x', '10x'];

    /**
     * Constructor
     * 
     * @param array $options Array de opciones de configuración
     * @throws \InvalidArgumentException Si faltan opciones requeridas o valores inválidos
     */
    public function __construct(array $options = [])
    {
        // Icon (requerido)
        if (!isset($options['icon'])) {
            throw new \InvalidArgumentException('La opción "icon" es requerida para el componente Icon');
        }
        $this->icon = $options['icon'];

        // Style
        if (isset($options['style'])) {
            $this->style = $options['style'];
        }

        // Size
        if (isset($options['size'])) {
            $this->size = $options['size'];
        }

        // Fixed Width
        if (isset($options['fixedWidth'])) {
            $this->fixedWidth = (bool)$options['fixedWidth'];
        }

        // Spin
        if (isset($options['spin'])) {
            $this->spin = (bool)$options['spin'];
        }

        // Pulse
        if (isset($options['pulse'])) {
            $this->pulse = (bool)$options['pulse'];
        }

        // Attributes
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
        // Validar estilo
        if (!in_array($this->style, self::VALID_STYLES)) {
            throw new \InvalidArgumentException(
                "Estilo inválido: {$this->style}. Estilos válidos: " . implode(', ', self::VALID_STYLES)
                );
        }

        // Validar tamaño (si está definido)
        if ($this->size !== null && !in_array($this->size, self::VALID_SIZES)) {
            throw new \InvalidArgumentException(
                "Tamaño inválido: {$this->size}. Tamaños válidos: " . implode(', ', self::VALID_SIZES)
                );
        }
    }

    /**
     * Renderiza el componente
     * 
     * @return TagInterface
     */
    public function render(): TagInterface
    {
        // Construir clases
        $classes = ['icon', "fa-{$this->style}", "fa-{$this->icon}"];

        // Tamaño
        if ($this->size !== null) {
            $classes[] = "fa-{$this->size}";
        }

        // Ancho fijo
        if ($this->fixedWidth) {
            $classes[] = 'fa-fw';
        }

        // Animación spin
        if ($this->spin) {
            $classes[] = 'fa-spin';
        }

        // Animación pulse
        if ($this->pulse) {
            $classes[] = 'fa-pulse';
        }

        // Mergear con clases adicionales si existen
        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $classes),
            $this->attributes['class'] ?? null
        );

        return Html::tag('i', $this->attributes);
    }
}
?>