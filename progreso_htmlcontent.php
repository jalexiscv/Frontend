<?php

/**
 * Script para listar componentes pendientes de refactorización
 */

$componentes = [
    // Ya implementados con trait
    ['nombre' => 'Button', 'ruta' => 'Interface', 'estado' => '✅'],
    ['nombre' => 'Alert', 'ruta' => 'Interface', 'estado' => '✅'],
    ['nombre' => 'Badge', 'ruta' => 'Interface', 'estado' => '✅'],
    ['nombre' => 'Typography', 'ruta' => 'Content', 'estado' => '✅'],
    ['nombre' => 'Container', 'ruta' => 'Layout', 'estado' => '✅'],

    // Pendientes
    ['nombre' => 'Tooltip', 'ruta' => 'Interface', 'estado' => '📝'],
    ['nombre' => 'Popover', 'ruta' => 'Interface', 'estado' => '📝'],
    ['nombre' => 'Toast', 'ruta' => 'Interface', 'estado' => '📝'],
    ['nombre' => 'Collapse', 'ruta' => 'Interface', 'estado' => '📝'],
    ['nombre' => 'Col', 'ruta' => 'Layout', 'estado' => '📝'],
    ['nombre' => 'Row', 'ruta' => 'Layout', 'estado' => '📝'],
    ['nombre' => 'Grid', 'ruta' => 'Layout', 'estado' => '📝'],
    ['nombre' => 'Form', 'ruta' => 'Form', 'estado' => '📝'],
    ['nombre' => 'Navbar', 'ruta' => 'Navigation', 'estado' => '📝'],
];

echo "PROGRESO DE IMPLEMENTACIÓN DE htmlContent\n";
echo str_repeat("=", 60) . "\n\n";

$total = count($componentes);
$completados = 0;

foreach ($componentes as $comp) {
    echo sprintf("%s %s (%s)\n", $comp['estado'], $comp['nombre'], $comp['ruta']);
    if ($comp['estado'] === '✅') {
        $completados++;
    }
}

echo "\n" . str_repeat("=", 60) . "\n";
echo sprintf(
    "Progreso: %d/%d componentes (%d%%)\n",
    $completados,
    $total,
    round(($completados / $total) * 100)
);
echo str_repeat("=", 60) . "\n";
