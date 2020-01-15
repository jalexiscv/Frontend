# Col - Componente de Layout Bootstrap 5.3.3

## Descripción

El componente `Col` crea columnas dentro del sistema de grid de Bootstrap. Se usa dentro de un componente `Row` y soporta configuración responsiva completa.

## Sistema de 12 Columnas

Bootstrap usa un sistema de grid de 12 columnas. Las columnas especifican cuántas de las 12 columnas disponibles ocupan.

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `size` | `string\|int\|null` | `null` | Tamaño base: `''` (auto), `'auto'`, `1-12` |
| `sm` | `string\|int\|null` | `null` | Tamaño para breakpoint SM (≥576px) |
| `md` | `string\|int\|null` | `null` | Tamaño para breakpoint MD (≥768px) |
| `lg` | `string\|int\|null` | `null` | Tamaño para breakpoint LG (≥992px) |
| `xl` | `string\|int\|null` | `null` | Tamaño para breakpoint XL (≥1200px) |
| `xxl` | `string\|int\|null` | `null` | Tamaño para breakpoint XXL (≥1400px) |
| `content` | `mixed` | `null` | Contenido (escapado automáticamente) |
| `htmlContent` | `string` | - | Contenido HTML sin escapar |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

## Ejemplos

### Columna Básica (Auto)

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

$col = new Col([
    'content' => 'Columna automática'
]);

echo $col->render();
// Output: <bs5-div class="col">Columna automática</bs5-div>
```

### Columnas de Ancho Fijo

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;

$col1 = new Col([
    'size' => 4,
    'content' => 'Ocupa 4/12'
]);

$col2 = new Col([
    'size' => 8,
    'content' => 'Ocupa 8/12'
]);

$row = new Row([
    'htmlContent' => $col1->render() . $col2->render()
]);

echo $row->render();
// Resultado: Una columna de 33.33% y otra de 66.66%
```

### Tres Columnas Iguales

```php
$col1 = new Col(['size' => 4, 'content' => 'Columna 1']);
$col2 = new Col(['size' => 4, 'content' => 'Columna 2']);
$col3 = new Col(['size' => 4, 'content' => 'Columna 3']);

$row = new Row([
    'htmlContent' => $col1->render() . $col2->render() . $col3->render()
]);
```

### Columna de Ancho Automático

```php
$colAuto = new Col([
    'size' => 'auto',
    'content' => 'Ancho basado en contenido'
]);

echo $colAuto->render();
// Output: <bs5-div class="col-auto">Ancho basado en contenido</bs5-div>
```

### Columnas Responsivas

```php
// Mobile: 100% ancho
// Tablet: 50% ancho
// Desktop: 33.33% ancho
$colResponsive = new Col([
    'size' => 12,   // Mobile: full width
    'md' => 6,      // Tablet: half width
    'lg' => 4,      // Desktop: third width
    'content' => 'Columna responsiva'
]);

echo $colResponsive->render();
// Output: <bs5-div class="col-12 col-md-6 col-lg-4">Columna responsiva</bs5-div>
```

### Layout de Dos Columnas Responsivo

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Container;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;

// Columna principal
$mainCol = new Col([
    'size' => 12,
    'lg' => 8,
    'content' => 'Contenido principal'
]);

// Sidebar
$sidebarCol = new Col([
    'size' => 12,
    'lg' => 4,
    'content' => 'Sidebar'
]);

$row = new Row([
    'gutter' => 4,
    'htmlContent' => $mainCol->render() . $sidebarCol->render()
]);

$container = new Container([
    'htmlContent' => (string)$row->render()
]);

echo $container->render();
// Mobile: ambas columnas 100% apiladas
// Desktop: 66.66% principal, 33.33% sidebar
```

### Grid de Productos (4 Columnas)

```php
$products = ['Producto 1', 'Producto 2', 'Producto 3', 'Producto 4'];
$cols = '';

foreach ($products as $product) {
    $col = new Col([
        'size' => 12,    // Mobile: 1 por fila
        'sm' => 6,       // Tablet: 2 por fila
        'lg' => 3,       // Desktop: 4 por fila
        'content' => $product
    ]);
    $cols .= $col->render();
}

$row = new Row([
    'gutter' => 3,
    'htmlContent' => $cols
]);

echo $row->render();
```

### Columnas con Offset (Espaciado)

```php
// Para usar offset, agrégalo en attributes
$colWithOffset = new Col([
    'md' => 6,
    'content' => 'Columna centrada',
    'attributes' => [
        'class' => 'offset-md-3'  // Offset de 3 columnas
    ]
]);

echo $colWithOffset->render();
// Output: <bs5-div class="col-md-6 offset-md-3">Columna centrada</bs5-div>
```

### Columnas con Alineación Vertical

```php
$colAligned = new Col([
    'md' => 4,
    'content' => 'Centrado verticalmente',
    'attributes' => [
        'class' => 'align-self-center'
    ]
]);

echo $colAligned->render();
```

### Columna con HTML Complejo

```php
$htmlContent = '
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Título</h5>
            <p class="card-text">Contenido de la tarjeta</p>
        </div>
    </div>
';

$colCard = new Col([
    'md' => 4,
    'htmlContent' => $htmlContent
]);
```

## Breakpoints y Tamaños

| Breakpoint | Sufijo | Dimensión | Ejemplo |
|------------|--------|-----------|---------|
| Extra small | - | <576px | `col-6` |
| Small | `sm` | ≥576px | `col-sm-6` |
| Medium | `md` | ≥768px | `col-md-6` |
| Large | `lg` | ≥992px | `col-lg-6` |
| Extra large | `xl` | ≥1200px | `col-xl-6` |
| Extra extra large | `xxl` | ≥1400px | `col-xxl-6` |

## Anchos de Columna

| Valor | Clases | Ancho |
|-------|--------|-------|
| `1` | `col-1` | 8.33% |
| `2` | `col-2` | 16.66% |
| `3` | `col-3` | 25% |
| `4` | `col-4` | 33.33% |
| `5` | `col-5` | 41.66% |
| `6` | `col-6` | 50% |
| `7` | `col-7` | 58.33% |
| `8` | `col-8` | 66.66% |
| `9` | `col-9` | 75% |
| `10` | `col-10` | 83.33% |
| `11` | `col-11` | 91.66% |
| `12` | `col-12` | 100% |
| `'auto'` | `col-auto` | Ancho automático |
| `''` | `col` | Igual para todas |

## Patrones Comunes

### Dos Columnas Iguales

```php
$col1 = new Col(['md' => 6, 'content' => 'Izquierda']);
$col2 = new Col(['md' => 6, 'content' => 'Derecha']);
```

### Tres Columnas Iguales

```php
$col1 = new Col(['lg' => 4, 'content' => 'Col 1']);
$col2 = new Col(['lg' => 4, 'content' => 'Col 2']);
$col3 = new Col(['lg' => 4, 'content' => 'Col 3']);
```

### Sidebar + Contenido (2:1)

```php
$sidebar = new Col(['lg' => 4, 'content' => 'Sidebar']);
$main = new Col(['lg' => 8, 'content' => 'Main']);
```

## Notas de Uso

1. **Siempre dentro de Row**: Las columnas deben estar dentro de un componente Row
2. **Suma 12**: Los anchos de columna en una fila deben sumar 12
3. **Mobile First**: Define primero el comportamiento móvil, luego los breakpoints mayores
4. **Auto-wrapping**: Si las columnas suman más de 12, las siguientes se ajustarán a la siguiente línea

## Ver También

- [Container](Container.md) - Contenedores responsivos
- [Row](Row.md) - Sistema de filas
- [Grid](Grid.md) - CSS Grid wrapper
