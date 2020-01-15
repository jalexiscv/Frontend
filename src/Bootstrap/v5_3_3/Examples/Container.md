# Container - Componente de Layout Bootstrap 5.3.3

## Descripción

El componente `Container` crea contenedores responsivos de Bootstrap que centran y alinean el contenido horizontalmente.

## Tipos de Container

- **Normal** (`''`): Ancho máximo responsivo con breakpoints
- **Fluid** (`'fluid'`): Ancho completo en todos los breakpoints
- **Responsivo** (`'sm'`, `'md'`, `'lg'`, `'xl'`, `'xxl'`): Fluid hasta el breakpoint especificado

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `type` | `string` | `''` | Tipo de container: `''`, `'fluid'`, `'sm'`, `'md'`, `'lg'`, `'xl'`, `'xxl'` |
| `content` | `mixed` | `null` | Contenido (escapado automáticamente) |
| `htmlContent` | `string` | - | Contenido HTML sin escapar (solo HTML confiable) |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

## Ejemplos

### Container Normal

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Container;

$container = new Container([
    'content' => 'Contenido centrado y con márgenes responsivos'
]);

echo $container->render();
// Output: <bs5-div class="container">Contenido centrado y con márgenes responsivos</bs5-div>
```

### Container Fluid

```php
$containerFluid = new Container([
    'type' => 'fluid',
    'content' => 'Este contenedor ocupa todo el ancho de la pantalla'
]);

echo $containerFluid->render();
// Output: <bs5-div class="container-fluid">Este contenedor ocupa todo el ancho de la pantalla</bs5-div>
```

### Container Responsivo

```php
$containerMd = new Container([
    'type' => 'md',
    'content' => 'Fluid hasta MD, luego ancho fijo'
]);

echo $containerMd->render();
// Output: <bs5-div class="container-md">Fluid hasta MD, luego ancho fijo</bs5-div>
```

### Container con Atributos HTML

```php
$containerStyled = new Container([
    'type' => 'fluid',
    'content' => 'Container con clases adicionales',
    'attributes' => [
        'class' => 'mt-4 bg-light p-3',
        'id' => 'main-container'
    ]
]);

echo $containerStyled->render();
// Output: <bs5-div class="container-fluid mt-4 bg-light p-3" id="main-container">...</bs5-div>
```

### Container con HTML Sin Escapar

```php
$containerHtml = new Container([
    'htmlContent' => '<strong>Texto en negrita</strong> y <em>texto en cursiva</em>',
    'attributes' => ['class' => 'my-5']
]);

echo $containerHtml->render();
// Output: <bs5-div class="container my-5"><strong>Texto en negrita</strong> y <em>texto en cursiva</em></bs5-div>
```

### Container Anidado con Row y Col

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Row;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Col;

// Crear columnas
$col1 = new Col([
    'md' => 6,
    'content' => 'Columna 1'
]);

$col2 = new Col([
    'md' => 6,
    'content' => 'Columna 2'
]);

// Crear row con las columnas
$row = new Row([
    'htmlContent' => $col1->render() . $col2->render()
]);

// Container con el row
$container = new Container([
    'htmlContent' => (string)$row->render()
]);

echo $container->render();
```

## Notas de Seguridad

⚠️ **IMPORTANTE**: 
- Usa `content` para contenido normal (se escapa automáticamente)
- Usa `htmlContent` SOLO con HTML confiable (hardcoded)
- NUNCA uses `htmlContent` con entrada de usuario sin sanitizar

```php
// ❌ PELIGROSO - Vulnerabilidad XSS
$userInput = $_POST['html'];
$unsafe = new Container(['htmlContent' => $userInput]); // NO HACER

// ✅ SEGURO - Contenido de usuario escapado
$safe = new Container(['content' => $userInput]);

// ✅ SEGURO - HTML hardcoded
$safe = new Container(['htmlContent' => '<i class="fas fa-home"></i> Inicio']);
```

## Breakpoints de Bootstrap 5.3.3

| Breakpoint | Clase | Dimensiones |
|------------|-------|-------------|
| Extra small | `.container` | <576px: 100% |
| Small | `.container-sm` | ≥576px: 540px |
| Medium | `.container-md` | ≥768px: 720px |
| Large | `.container-lg` | ≥992px: 960px |
| Extra large | `.container-xl` | ≥1200px: 1140px |
| Extra extra large | `.container-xxl` | ≥1400px: 1320px |
| Fluid | `.container-fluid` | 100% en todos |

## Ver También

- [Row](Row.md) - Sistema de filas
- [Col](Col.md) - Sistema de columnas
- [Grid](Grid.md) - CSS Grid wrapper
