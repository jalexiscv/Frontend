<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Extras;

use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;
use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Componente Indicator de Bootstrap 5.3.3
 * 
 * Componente para mostrar indicadores numéricos (KPIs, métricas, estadísticas)
 * en diferentes formatos visuales.
 * 
 * Opciones:
 * - 'mode': string - Modo de visualización ['basic'] [default: 'basic']
 * - 'value': string|int - Valor principal a mostrar (ej: "5", "125", "$1,200") [required]
 * - 'label': string - Etiqueta descriptiva (ej: "Total", "Usuarios") [required]
 * - 'variant': string|null - Variante de color Bootstrap ('primary', 'secondary', 'success', 'danger', 'warning', 'info') [default: null]
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * @implements ComponentInterface
 * 
 * @example
 * // Indicador básico con variante
 * new Indicator([
 *     'mode' => 'basic',
 *     'value' => '5',
 *     'label' => 'Total',
 *     'variant' => 'secondary'
 * ]);
 * 
 * @example
 * // Indicador sin variante (neutral)
 * new Indicator([
 *     'value' => '125',
 *     'label' => 'Usuarios Activos'
 * ]);
 */
class Indicator extends AbstractComponent implements ComponentInterface
{
    private string $mode = 'basic';
    private string|int $value;
    private string $label;
    private ?string $variant = null;
    private array $attributes = [];

    private const VALID_MODES = ['basic'];
    private const VALID_VARIANTS = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

    /**
     * Constructor
     * 
     * @param array $options Array de opciones de configuración
     * @throws \InvalidArgumentException Si faltan opciones requeridas o valores inválidos
     */
    public function __construct(array $options = [])
    {
        // Mode
        if (isset($options['mode'])) {
            $this->mode = $options['mode'];
        }

        // Value (requerido)
        if (!isset($options['value'])) {
            throw new \InvalidArgumentException('La opción "value" es requerida para el componente Indicator');
        }
        $this->value = $options['value'];

        // Label (requerido)
        if (!isset($options['label'])) {
            throw new \InvalidArgumentException('La opción "label" es requerida para el componente Indicator');
        }
        $this->label = $options['label'];

        // Variant
        if (isset($options['variant'])) {
            $this->variant = $options['variant'];
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
        // Validar modo
        if (!in_array($this->mode, self::VALID_MODES)) {
            throw new \InvalidArgumentException(
                "Modo inválido: {$this->mode}. Modos válidos: " . implode(', ', self::VALID_MODES)
            );
        }

        // Validar variante (si está definida)
        if ($this->variant !== null && !in_array($this->variant, self::VALID_VARIANTS)) {
            throw new \InvalidArgumentException(
                "Variante inválida: {$this->variant}. Variantes válidas: " . implode(', ', self::VALID_VARIANTS)
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
        return match ($this->mode) {
            'basic' => $this->renderBasic(),
            default => throw new \RuntimeException("Modo no implementado: {$this->mode}")
        };
    }

    /**
     * Renderiza el modo "basic"
     * 
     * Card centrada con número grande y etiqueta
     * 
     * @return TagInterface
     */
    private function renderBasic(): TagInterface
    {
        // Clases del card
        $cardClasses = ['card', 'text-center'];

        // Añadir borde con variante si está definida
        if ($this->variant !== null) {
            $cardClasses[] = "border-{$this->variant}";
        }

        // Mergear con clases adicionales si existen
        $this->attributes['class'] = $this->mergeClasses(
            implode(' ', $cardClasses),
            $this->attributes['class'] ?? null
        );

        // Crear card principal
        $card = Html::tag('div', $this->attributes);

        // Card body
        $cardBody = Html::tag('div', ['class' => 'card-body']);

        // Valor (h2)
        $valueClasses = [];
        if ($this->variant !== null) {
            $valueClasses[] = "text-{$this->variant}";
        }

        $valueTag = Html::tag('h2', [
            'class' => implode(' ', $valueClasses)
        ], (string)$this->value);

        // Label (p)
        $labelTag = Html::tag('p', ['class' => 'mb-0'], $this->label);

        // Ensamblar
        $cardBody->content([$valueTag, $labelTag]);
        $card->content($cardBody);

        return $card;
    }
}
