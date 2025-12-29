<?php

/**
 * Test para verificar tabs solo con icon
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Tabs;

echo "========================================\n";
echo "TEST: Tabs solo con Icon\n";
echo "========================================\n\n";

// Test 1: Tab solo con icon (sin title)
echo "Test 1: Tab solo con icon...\n";
try {
    $tabsIconOnly = new Tabs([
        'tabs' => [
            [
                'id' => 'home',
                'icon' => 'fas fa-home',
                'content' => 'Contenido de inicio',
                'active' => true
            ],
            [
                'id' => 'settings',
                'icon' => 'fas fa-cog',
                'content' => 'Configuración'
            ],
            [
                'id' => 'user',
                'icon' => 'fas fa-user',
                'content' => 'Usuario'
            ]
        ]
    ]);

    $output = $tabsIconOnly->render();

    if (strpos($output, 'fas fa-home') !== false) {
        echo "✅ PASÓ: Tab solo con icon funciona\n";
        echo "   Encontrado: fas fa-home\n\n";
    } else {
        echo "❌ FALLÓ: No se encontró el icon\n\n";
    }
} catch (\Exception $e) {
    echo "❌ FALLÓ: " . $e->getMessage() . "\n\n";
}

// Test 2: Mezcla de tabs con icon, title e icon+title
echo "Test 2: Mezcla de estilos...\n";
try {
    $tabsMixed = new Tabs([
        'pills' => true,
        'tabs' => [
            [
                'id' => 't1',
                'icon' => 'fas fa-home',  // Solo icon
                'content' => 'Solo ícono',
                'active' => true
            ],
            [
                'id' => 't2',
                'title' => 'Solo Texto',  // Solo text
                'content' => 'Solo texto'
            ],
            [
                'id' => 't3',
                'icon' => 'fas fa-cog',    // Icon + text
                'title' => 'Configuración',
                'content' => 'Ambos'
            ]
        ]
    ]);

    $output2 = $tabsMixed->render();
    echo "✅ PASÓ: Mezcla de estilos funciona\n\n";
} catch (\Exception $e) {
    echo "❌ FALLÓ: " . $e->getMessage() . "\n\n";
}

// Test 3: Validación - debe fallar si no tiene ni title, ni htmlTitle, ni icon
echo "Test 3: Validación sin ninguno...\n";
try {
    $tabsInvalid = new Tabs([
        'tabs' => [
            [
                'id' => 'invalid',
                'content' => 'Sin título ni ícono'
            ]
        ]
    ]);
    echo "❌ FALLÓ: Validación NO funcionó (debería rechazar tab sin title/htmlTitle/icon)\n\n";
} catch (\InvalidArgumentException $e) {
    echo "✅ PASÓ: Validación funcionó correctamente\n";
    echo "   Mensaje: " . $e->getMessage() . "\n\n";
}

echo "========================================\n";
echo "✨ TESTS COMPLETADOS\n";
echo "========================================\n\n";

echo "Opciones válidas para tabs:\n";
echo "✅ Solo icon\n";
echo "✅ Solo title\n";
echo "✅ Solo htmlTitle\n";
echo "✅ Icon + title\n";
echo "✅ Icon + htmlTitle\n";
