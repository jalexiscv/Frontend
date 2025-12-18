<?php

/**
 * Test de verificación rápida para htmlContent
 */

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Frontend;

echo "========================================\n";
echo "VERIFICACIÓN DE htmlContent\n";
echo "========================================\n\n";

$frontend = new Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();

// Test 1: Verificar que htmlContent funciona
echo "Test 1: Probando htmlContent con ícono...\n";
$btn = $bootstrap->button([
    'htmlContent' => '<i class="fas fa-user"></i> Usuario',
    'variant' => 'primary'
])->render();

if (strpos($btn, '<i class="fas fa-user"></i>') !== false) {
    echo "✅ PASÓ: El ícono NO fue escapado\n";
    echo "   Salida: $btn\n\n";
} else {
    echo "❌ FALLÓ: El ícono fue escapado\n";
    echo "   Salida: $btn\n\n";
    exit(1);
}

// Test 2: Verificar que content normal sigue escapado
echo "Test 2: Verificando que 'content' normal sigue escapado...\n";
$btn2 = $bootstrap->button([
    'content' => '<script>alert("XSS")</script>',
    'variant' => 'danger'
])->render();

if (strpos($btn2, '&lt;script&gt;') !== false) {
    echo "✅ PASÓ: El contenido fue escapado correctamente\n";
    echo "   Salida: $btn2\n\n";
} else {
    echo "❌ FALLÓ: El contenido NO fue escapado (VULNERABILIDAD)\n";
    echo "   Salida: $btn2\n\n";
    exit(1);
}

// Test 3: Ejemplo de caso de uso real
echo "Test 3: Caso de uso real - Botón de edición...\n";
$editBtn = $bootstrap->button([
    'htmlContent' => '<i class="fa-sharp fa-light fa-pen-to-square"></i>Editar',
    'variant' => 'warning',
    'size' => 'sm'
])->render();

if (
    strpos($editBtn, '<i class="fa-sharp fa-light fa-pen-to-square"></i>') !== false &&
    strpos($editBtn, 'Editar') !== false
) {
    echo "✅ PASÓ: Botón de edición renderizado correctamente\n";
    echo "   Salida: $editBtn\n\n";
} else {
    echo "❌ FALLÓ: Botón no renderizado correctamente\n";
    echo "   Salida: $editBtn\n\n";
    exit(1);
}

echo "========================================\n";
echo "✨ TODOS LOS TESTS PASARON\n";
echo "========================================\n\n";

echo "RESUMEN:\n";
echo "- htmlContent funciona correctamente\n";
echo "- El HTML NO es escapado cuando usas htmlContent\n";
echo "- El contenido normal (content) SIGUE siendo escapado\n";
echo "- Mantenida la seguridad por defecto\n\n";

echo "✅ La implementación está completa y funcional!\n";
