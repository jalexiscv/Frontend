<?php

/**
 * Script de verificación rápida para Html::raw()
 * 
 * Este script verifica que Html::raw() funcione correctamente
 * y que el contenido HTML no sea escapado.
 * 
 * USO: php test_html_raw.php
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Html\Html;
use Higgs\Frontend\Frontend;

echo "========================================\n";
echo "VERIFICACIÓN DE Html::raw()\n";
echo "========================================\n\n";

// Test 1: Verificar que Html::raw() existe
echo "Test 1: Verificando que Html::raw() existe...\n";
if (method_exists(Html::class, 'raw')) {
    echo "✅ PASÓ: Html::raw() existe\n\n";
} else {
    echo "❌ FALLÓ: Html::raw() no encontrado\n\n";
    exit(1);
}

// Test 2: Verificar que RawHtml existe
echo "Test 2: Verificando que la clase RawHtml existe...\n";
if (class_exists('Higgs\\Html\\RawHtml')) {
    echo "✅ PASÓ: Clase RawHtml existe\n\n";
} else {
    echo "❌ FALLÓ: Clase RawHtml no encontrada\n\n";
    exit(1);
}

// Test 3: Probar Html::raw() básico
echo "Test 3: Probando Html::raw() con contenido básico...\n";
$raw = Html::raw('<strong>Texto en negrita</strong>');
$div = Html::tag('div', [], $raw);
$html = (string)$div;

if (strpos($html, '<strong>Texto en negrita</strong>') !== false) {
    echo "✅ PASÓ: El HTML NO fue escapado\n";
    echo "   Salida: $html\n\n";
} else {
    echo "❌ FALLÓ: El HTML fue escapado incorrectamente\n";
    echo "   Salida: $html\n\n";
    exit(1);
}

// Test 4: Verificar que el contenido normal SIGUE siendo escapado
echo "Test 4: Verificando que el contenido normal sigue siendo escapado...\n";
$normal = '<script>alert("XSS")</script>';
$div2 = Html::tag('div', [], $normal);
$html2 = (string)$div2;

if (strpos($html2, '&lt;script&gt;') !== false) {
    echo "✅ PASÓ: El contenido normal fue escapado correctamente\n";
    echo "   Salida: $html2\n\n";
} else {
    echo "❌ FALLÓ: El contenido normal NO fue escapado (VULNERABILIDAD XSS)\n";
    echo "   Salida: $html2\n\n";
    exit(1);
}

// Test 5: Probar con Bootstrap Button
echo "Test 5: Probando Html::raw() con Bootstrap Button...\n";
$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

$icon = Html::raw('<i class="fas fa-user"></i>');
$button = $bootstrap->button([
    'content' => [$icon, ' Usuario'],
    'variant' => 'primary'
])->render();

if (strpos($button, '<i class="fas fa-user"></i>') !== false) {
    echo "✅ PASÓ: El ícono en el botón NO fue escapado\n";
    echo "   Salida: $button\n\n";
} else {
    echo "❌ FALLÓ: El ícono fue escapado\n";
    echo "   Salida: $button\n\n";
    exit(1);
}

// Test 6: Array mixto con Html::raw() y texto normal
echo "Test 6: Verificando array mixto (raw + texto normal)...\n";
$icon2 = Html::raw('<i class="fas fa-save"></i>');
$div3 = Html::tag('span', [], [$icon2, ' Guardar']);
$html3 = (string)$div3;

if (strpos($html3, '<i class="fas fa-save"></i>') !== false && strpos($html3, 'Guardar') !== false) {
    echo "✅ PASÓ: Array mixto funciona correctamente\n";
    echo "   Salida: $html3\n\n";
} else {
    echo "❌ FALLÓ: Array mixto no funciona\n";
    echo "   Salida: $html3\n\n";
    exit(1);
}

echo "========================================\n";
echo "✨ TODOS LOS TESTS PASARON\n";
echo "========================================\n\n";

echo "RESUMEN:\n";
echo "- Html::raw() está correctamente implementado\n";
echo "- RawHtml bypasea el escapado automático\n";
echo "- El contenido normal sigue siendo escapado (seguro)\n";
echo "- Compatible con componentes Bootstrap\n";
echo "- Arrays mixtos funcionan correctamente\n\n";

echo "✅ La implementación está completa y funcional!\n";
