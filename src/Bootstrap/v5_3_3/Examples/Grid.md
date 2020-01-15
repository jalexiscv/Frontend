# Grid - Componente de Layout Bootstrap 5.3.3

## Descripción

El componente `Grid` es un wrapper genérico que aplica la clase `.grid` para usar CSS Grid nativo. Es una alternativa al sistema tradicional de Container/Row/Col cuando se necesita más control con CSS Grid.

> **Nota**: Este componente es experimental y opcional en Bootstrap 5.3.3. El sistema Grid de CSS es diferente al sistema de Grid Flexbox tradicional de Bootstrap.

## Opciones

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `content` | `mixed` | `null` | Contenido (escapado automáticamente) |
| `htmlContent` | `string` | - | Contenido HTML sin escapar |
| `attributes` | `array` | `[]` | Atributos HTML adicionales |

## Ejemplos

### Grid Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Grid;

$grid = new Grid([
    'content' => 'Contenido del grid'
]);

echo $grid->render();
// Output: <bs5-div class="grid">Contenido del grid</bs5-div>
```

### Grid con Gap

```php
$gridWithGap = new Grid([
    'content' => 'Grid con espaciado',
    'attributes' => [
        'class' => 'gap-3'
    ]
]);

echo $gridWithGap->render();
// Output: <bs5-div class="grid gap-3">Grid con espaciado</bs5-div>
```

### Grid con Columnas CSS

```php
$gridCols = new Grid([
    'htmlContent' => '
        <div>Item 1</div>
        <div>Item 2</div>
        <div>Item 3</div>
        <div>Item 4</div>
    ',
    'attributes' => [
        'class' => 'gap-2',
        'style' => 'grid-template-columns: repeat(2, 1fr);'
    ]
]);

echo $gridCols->render();
// Resultado: Grid de 2 columnas con gap
```

### Grid Auto-Fill Responsivo

```php
$gridAutoFill = new Grid([
    'htmlContent' => '
        <div class="p-3 border">1</div>
        <div class="p-3 border">2</div>
        <div class="p-3 border">3</div>
        <div class="p-3 border">4</div>
        <div class="p-3 border">5</div>
        <div class="p-3 border">6</div>
    ',
    'attributes' => [
        'class' => 'gap-3',
        'style' => 'grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));'
    ]
]);

echo $gridAutoFill->render();
// Resultado: Grid que se ajusta automáticamente
```

### Grid para Dashboard

```php
$dashboard = new Grid([
    'htmlContent' => '
        <div class="card">Header</div>
        <div class="card">Sidebar</div>
        <div class="card">Main Content</div>
        <div class="card">Footer</div>
    ',
    'attributes' => [
        'class' => 'gap-3',
        'style' => '
            grid-template-areas:
                "header header"
                "sidebar main"
                "footer footer";
            grid-template-columns: 250px 1fr;
            grid-template-rows: auto 1fr auto;
        '
    ]
]);

echo $dashboard->render();
```

### Grid de Galería de Imágenes

```php
$images = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 'img5.jpg', 'img6.jpg'];
$imageHtml = '';

foreach ($images as $img) {
    $imageHtml .= "<div class=\"ratio ratio-1x1\"><img src=\"$img\" class=\"img-fluid\"></div>";
}

$galleryGrid = new Grid([
    'htmlContent' => $imageHtml,
    'attributes' => [
        'class' => 'gap-2',
        'style' => 'grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));'
    ]
]);

echo $galleryGrid->render();
```

### Grid con Areas Nombradas

```php
$layoutGrid = new Grid([
    'htmlContent' => '
        <div style="grid-area: header;" class="bg-primary text-white p-3">Header</div>
        <div style="grid-area: nav;" class="bg-light p-3">Navigation</div>
        <div style="grid-area: main;" class="bg-white p-3">Main Content</div>
        <div style="grid-area: sidebar;" class="bg-light p-3">Sidebar</div>
        <div style="grid-area: footer;" class="bg-dark text-white p-3">Footer</div>
    ',
    'attributes' => [
        'class' => 'gap-2',
        'style' => '
            display: grid;
            grid-template-areas:
                "header header header"
                "nav main sidebar"
                "footer footer footer";
            grid-template-columns: 200px 1fr 200px;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
        '
    ]
]);

echo $layoutGrid->render();
```

### Grid Responsivo con Media Queries CSS

```php
$responsiveGrid = new Grid([
    'htmlContent' => '
        <div class="card p-3">Card 1</div>
        <div class="card p-3">Card 2</div>
        <div class="card p-3">Card 3</div>
        <div class="card p-3">Card 4</div>
    ',
    'attributes' => [
        'class' => 'gap-3 responsive-grid',
        'id' => 'main-grid'
    ]
]);

// En tu CSS:
// .responsive-grid {
//     display: grid;
//     grid-template-columns: 1fr;
// }
// @media (min-width: 768px) {
//     .responsive-grid {
//         grid-template-columns: repeat(2, 1fr);
//     }
// }
// @media (min-width: 1200px) {
//     .responsive-grid {
//         grid-template-columns: repeat(4, 1fr);
//     }
// }
```

### Grid con Subgrid

```php
$subgridExample = new Grid([
    'htmlContent' => '
        <div style="display: grid; grid-column: 1 / -1;">
            <div class="p-2 border">Nested 1</div>
            <div class="p-2 border">Nested 2</div>
        </div>
    ',
    'attributes' => [
        'class' => 'gap-2',
        'style' => 'grid-template-columns: repeat(3, 1fr);'
    ]
]);
```

## Clases de Gap de Bootstrap

Bootstrap 5.3.3 incluye clases de utilidad para `gap`:

| Clase | Espaciado |
|-------|-----------|
| `gap-0` | 0 |
| `gap-1` | 0.25rem |
| `gap-2` | 0.5rem |
| `gap-3` | 1rem |
| `gap-4` | 1.5rem |
| `gap-5` | 3rem |

También disponibles:
- `row-gap-*`: Solo espaciado vertical
- `column-gap-*`: Solo espaciado horizontal

## Cuándo Usar Grid vs Row/Col

### Usa Grid cuando:
- ✅ Necesitas layouts complejos bidimensionales
- ✅ Quieres usar CSS Grid nativo
- ✅ Necesitas grid-template-areas
- ✅ Requieres control preciso de filas y columnas
- ✅ Diseño que no encaja en 12 columnas

### Usa Row/Col cuando:
- ✅ Diseño tradicional de Bootstrap
- ✅ Sistema de 12 columnas es suficiente
- ✅ Necesitas compatibilidad con componentes Bootstrap
- ✅ Desarrollo rápido sin CSS personalizado
- ✅ Diseño principalmente horizontal

## Propiedades CSS Grid Útiles

```css
/* Template */
grid-template-columns: repeat(3, 1fr);
grid-template-rows: auto 1fr auto;
grid-template-areas: "header header" "sidebar main" "footer footer";

/* Gap */
gap: 1rem;
column-gap: 2rem;
row-gap: 1rem;

/* Placement */
grid-column: 1 / 3;
grid-row: 2 / 4;
grid-area: header;

/* Auto */
grid-auto-flow: row;
grid-auto-columns: 1fr;
grid-auto-rows: minmax(100px, auto);

/* Alignment */
justify-items: center;
align-items: center;
place-items: center;
```

## Ejemplo Completo: Dashboard

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Container;
use Higgs\Frontend\Bootstrap\v5_3_3\Layout\Grid;

$dashboardContent = '
    <header class="bg-primary text-white p-3">
        <h1>Mi Dashboard</h1>
    </header>
    <nav class="bg-light p-3">
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link">Inicio</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Perfil</a></li>
        </ul>
    </nav>
    <main class="p-4">
        <h2>Contenido Principal</h2>
        <p>Aquí va el contenido...</p>
    </main>
    <aside class="bg-light p-3">
        <h3>Widgets</h3>
        <div class="card mb-2">Widget 1</div>
        <div class="card mb-2">Widget 2</div>
    </aside>
    <footer class="bg-dark text-white p-3">
        <p>&copy; 2026 Mi Aplicación</p>
    </footer>
';

$grid = new Grid([
    'htmlContent' => $dashboardContent,
    'attributes' => [
        'style' => '
            display: grid;
            grid-template-areas:
                "header header header"
                "nav main aside"
                "footer footer footer";
            grid-template-columns: 200px 1fr 250px;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            gap: 0;
        '
    ]
]);

// Agregar estilos a cada area (usando grid-area en el HTML arriba)
echo $grid->render();
```

## Notas de Uso

1. **CSS Grid Nativo**: Este componente usa CSS Grid estándar, no el sistema Flexbox de Bootstrap
2. **Requiere CSS Personalizado**: Para aprovechar Grid, necesitarás agregar estilos CSS
3. **Experimental**: El soporte de Grid en Bootstrap 5.3.3 es opt-in y experimental
4. **Compatibilidad**: CSS Grid es compatible con todos los navegadores modernos

## Ver También

- [Container](Container.md) - Contenedores responsivos
- [Row](Row.md) - Sistema de filas Flexbox
- [Col](Col.md) - Sistema de columnas Flexbox
- [CSS Grid Layout](https://developer.mozilla.org/es/docs/Web/CSS/CSS_Grid_Layout) - MDN
