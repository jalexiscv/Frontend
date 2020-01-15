# Row - Componente de Layout Bootstrap 5.3.3

## Descripción

El componente `Row` crea filas del sistema de grid de Bootstrap, que actúan como contenedores para columnas (`Col`).

## Características

- Sistema de 12 columnas
- Control de gutters (espaciado entre columnas)
- Configuración de columnas por fila
- Soporte responsivo completo

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `cols` | `int\|string` | `null` | Número de columnas por fila (1-12, 'auto') |
| `colsSm` | `int\|string` | `null` | Columnas para breakpoint SM |
| `colsMd` | `int\|string` | `null` | Columnas para breakpoint MD |
| `colsLg` | `int\|string` | `null` | Columnas para breakpoint LG |
| `colsXl` | `int\|string` | `null` | Columnas para breakpoint XL |
| `colsXxl` | `int\|string` | `null` | Columnas para breakpoint XXL |
| `gutter` | `int\|string` | `null` | Espaciado general (0-5) |
| `gutterX` | `int\|string` | `null` | Espaciado horizontal (0-5) |
| `gutterY` | `int\|string` | `null` | Espaciado vertical (0-5) |
| `content` | `mixed` | `null` | Contenido (escapado automáticamente) |
| `htmlContent` | `string` | - | Contenido HTML sin escapar |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

## Ejemplos

### Row Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;

$row = new Row([
    'content' => 'Contenido de la fila'
]);

echo $row->render();
// Output: <bs5-div class="row">Contenido de la fila</bs5-div>
```

### Row con Gutter

```php
$rowGutter = new Row([
    'gutter' => 3,
    'content' => 'Fila con espaciado de nivel 3'
]);

echo $rowGutter->render();
// Output: <bs5-div class="row g-3">Fila con espaciado de nivel 3</bs5-div>
```

### Row con Gutters Horizontales y Verticales

```php
$rowCustomGutter = new Row([
    'gutterX' => 4,
    'gutterY' => 2,
    'content' => 'Espaciado horizontal 4, vertical 2'
]);

echo $rowCustomGutter->render();
// Output: <bs5-div class="row gx-4 gy-2">...</bs5-div>
```

### Row con Columnas Automáticas

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

$col1 = new Col(['content' => 'Col 1']);
$col2 = new Col(['content' => 'Col 2']);
$col3 = new Col(['content' => 'Col 3']);

$row = new Row([
    'cols' => 3,  // 3 columnas por fila
    'htmlContent' => $col1->render() . $col2->render() . $col3->render()
]);

echo $row->render();
// Output: <bs5-div class="row row-cols-3">...</bs5-div>
```

### Row con Configuración Responsiva

```php
$rowResponsive = new Row([
    'cols' => 1,      // Mobile: 1 columna
    'colsMd' => 2,    // Tablet: 2 columnas
    'colsLg' => 3,    // Desktop: 3 columnas
    'gutter' => 4,
    'content' => 'Grid responsivo'
]);

echo $rowResponsive->render();
// Output: <bs5-div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">...</bs5-div>
```

### Row Completo con Columnas

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Container;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

// Crear columnas
$col1 = new Col([
    'md' => 4,
    'content' => 'Primera columna'
]);

$col2 = new Col([
    'md' => 4,
    'content' => 'Segunda columna'
]);

$col3 = new Col([
    'md' => 4,
    'content' => 'Tercera columna'
]);

// Crear row
$row = new Row([
    'gutter' => 3,
    'htmlContent' => $col1->render() . $col2->render() . $col3->render()
]);

// Envolver en container
$container = new Container([
    'htmlContent' => (string)$row->render()
]);

echo $container->render();
```

### Row sin Gutters

```php
$rowNoGutter = new Row([
    'gutter' => 0,
    'content' => 'Fila sin espaciado entre columnas'
]);

echo $rowNoGutter->render();
// Output: <bs5-div class="row g-0">...</bs5-div>
```

### Row con Atributos Personalizados

```php
$rowCustom = new Row([
    'gutter' => 2,
    'content' => 'Row con ID y clases',
    'attributes' => [
        'id' => 'product-row',
        'class' => 'mb-4 align-items-center',
        'data-category' => 'featured'
    ]
]);

echo $rowCustom->render();
// Output: <bs5-div class="row g-2 mb-4 align-items-center" id="product-row" data-category="featured">...</bs5-div>
```

## Sistema de Gutters

| Clase | Espaciado | Descripción |
|-------|-----------|-------------|
| `g-0` | 0 | Sin espaciado |
| `g-1` | 0.25rem | Espaciado mínimo |
| `g-2` | 0.5rem | Espaciado pequeño |
| `g-3` | 1rem | Espaciado por defecto |
| `g-4` | 1.5rem | Espaciado medio |
| `g-5` | 3rem | Espaciado grande |

- `g-*`: Gutter horizontal y vertical
- `gx-*`: Solo gutter horizontal
- `gy-*`: Solo gutter vertical

## Row Cols (Columnas Automáticas)

La opción `cols` y sus variantes responsivas controlan cuántas columnas se muestran por fila automáticamente:

```php
// 2 columnas iguales en todas las columnas hijas
$row = new Row(['cols' => 2]);

// Responsivo: 1 en móvil, 2 en tablet, 4 en desktop
$row = new Row([
    'cols' => 1,
    'colsMd' => 2,
    'colsLg' => 4
]);
```

## Notas de Uso

1. **Row debe estar dentro de Container**: Siempre usa Row dentro de un Container
2. **Columnas como hijos**: Los hijos de Row deben ser componentes Col
3. **Sistema de 12 columnas**: Las columnas deben sumar 12 para llenar la fila
4. **Gutters**: Usa `gutter` para espaciado uniforme o `gutterX`/`gutterY` para control preciso

## Ver También

- [Container](Container.md) - Contenedores responsivos
- [Col](Col.md) - Sistema de columnas
- [Grid](Grid.md) - CSS Grid wrapper
