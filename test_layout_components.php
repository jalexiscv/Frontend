<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Container;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Grid;

echo "=== PRUEBA DE COMPONENTES LAYOUT ===\n\n";

// Test 1: Container simple
echo "1. Container simple:\n";
$container = new Container([
    'type' => 'fluid',
    'content' => 'Contenido del container',
    'attributes' => ['class' => 'mt-4']
]);
$result = $container->render();
echo "Tipo de resultado: " . get_class($result) . "\n";
echo "HTML: " . $result . "\n\n";

// Test 2: Container con HTML
echo "2. Container con HTML sin escapar:\n";
$container2 = new Container([
    'htmlContent' => '<strong>Texto en negrita</strong> y <em>cursiva</em>',
    'attributes' => ['class' => 'bg-light p-3']
]);
echo "HTML: " . $container2->render() . "\n\n";

// Test 3: Row simple
echo "3. Row simple:\n";
$row = new Row([
    'content' => 'Contenido del row',
    'attributes' => ['class' => 'mb-3']
]);
echo "HTML: " . $row->render() . "\n\n";

// Test 4: Row con opciones
echo "4. Row con gutter:\n";
$row2 = new Row([
    'gutter' => 3,
    'cols' => 2,
    'content' => 'Row con configuración'
]);
echo "HTML: " . $row2->render() . "\n\n";

// Test 5: Col simple
echo "5. Col simple:\n";
$col = new Col([
    'content' => 'Contenido de columna',
    'attributes' => ['class' => 'text-center']
]);
echo "HTML: " . $col->render() . "\n\n";

// Test 6: Col con tamaños responsivos
echo "6. Col con tamaños responsivos:\n";
$col2 = new Col([
    'size' => 12,
    'md' => 6,
    'lg' => 4,
    'content' => 'Columna responsiva'
]);
echo "HTML: " . $col2->render() . "\n\n";

// Test 7: Grid simple
echo "7. Grid simple:\n";
$grid = new Grid([
    'content' => 'Contenido del grid',
    'attributes' => ['class' => 'gap-3']
]);
echo "HTML: " . $grid->render() . "\n\n";

// Test 8: Composición completa
echo "8. Composición Container > Row > Col:\n";
$colContent1 = new Col([
    'md' => 6,
    'content' => 'Columna 1'
]);
$colContent2 = new Col([
    'md' => 6,
    'content' => 'Columna 2'
]);

$rowContent = new Row([
    'htmlContent' => $colContent1->render() . $colContent2->render()
]);

$containerFull = new Container([
    'htmlContent' => (string)$rowContent->render()
]);
echo "HTML: " . $containerFull->render() . "\n\n";

echo "=== TODAS LAS PRUEBAS COMPLETADAS ===\n";
