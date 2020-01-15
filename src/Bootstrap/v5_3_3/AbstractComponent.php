<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3;

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;

/**
 * Clase base para todos los componentes de Bootstrap 5
 */
abstract class AbstractComponent
{
    /**
     * Método que debe implementar cada componente para renderizarse
     */
    abstract public function render(): TagInterface;

    /**
     * Combina clases CSS existentes con nuevas y elimina duplicados
     */
    protected function mergeClasses(string $defaultClasses, ?string $additionalClasses = null): string
    {
        $classes = array_filter(explode(' ', $defaultClasses));
        
        if ($additionalClasses) {
            $additional = array_filter(explode(' ', $additionalClasses));
            $classes = array_merge($classes, $additional);
        }
        
        return implode(' ', array_unique($classes));
    }

    /**
     * Crea un elemento HTML estándar
     */
    protected function createComponent(string $name, array $attributes = []): TagInterface
    {
        return Html::tag($name, $attributes);
    }

    /**
     * Agrega un atributo data-* al componente
     */
    protected function addDataAttribute(TagInterface $element, string $name, string $value): void
    {
        $element->setAttribute('data-' . $name, $value);
    }

    /**
     * Agrega múltiples atributos data-* al componente
     */
    protected function addDataAttributes(TagInterface $element, array $data): void
    {
        foreach ($data as $name => $value) {
            $this->addDataAttribute($element, $name, $value);
        }
    }

    /**
     * Valida que un valor esté en un conjunto de opciones válidas
     */
    protected function validateOption($value, array $validOptions, string $optionName): void
    {
        if (!in_array($value, $validOptions)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Opción inválida "%s" para %s. Opciones válidas: %s',
                    (string)$value,
                    $optionName,
                    implode(', ', $validOptions)
                )
            );
        }
    }

    /**
     * Agrega clases de tamaño a un elemento
     */
    protected function addSizeClasses(TagInterface $element, ?string $size, string $prefix = ''): void
    {
        if ($size !== null) {
            $class = $prefix ? $prefix . '-' . $size : $size;
            $element->addClass($class);
        }
    }

    /**
     * Agrega clases de variante a un elemento
     */
    protected function addVariantClasses(TagInterface $element, string $variant): void
    {
        $validVariants = [
            'primary',
            'secondary',
            'success',
            'danger',
            'warning',
            'info',
            'light',
            'dark'
        ];

        $this->validateOption($variant, $validVariants, 'variant');
        $element->addClass('bg-' . $variant);
    }

    /**
     * Agrega clases de alineación
     */
    protected function addAlignmentClasses(TagInterface $element, string $alignment): void
    {
        $validAlignments = [
            'start',
            'center',
            'end',
            'baseline',
            'stretch'
        ];

        $this->validateOption($alignment, $validAlignments, 'alignment');
        $element->addClass('align-' . $alignment);
    }

    /**
     * Agrega clases de margen o padding
     */
    protected function addSpacingClasses(TagInterface $element, string $type, $size, ?string $breakpoint = null): void
    {
        $validTypes = ['m', 'p'];
        $validSizes = [0, 1, 2, 3, 4, 5];

        $this->validateOption($type, $validTypes, 'spacing type');
        $this->validateOption($size, $validSizes, 'spacing size');

        $class = $type . '-' . $size;
        if ($breakpoint) {
            $validBreakpoints = ['sm', 'md', 'lg', 'xl', 'xxl'];
            $this->validateOption($breakpoint, $validBreakpoints, 'breakpoint');
            $class = $type . '-' . $breakpoint . '-' . $size;
        }

        $element->addClass($class);
    }
}
