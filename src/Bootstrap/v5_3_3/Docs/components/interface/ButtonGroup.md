# ButtonGroup - Agrupación de Botones

[← Volver al Índice](../../Bootstrap.md)

## Descripción

Agrupa botones en una sola línea con ButtonGroup. Perfecto para barras de herramientas, paginación personalizada y controles relacionados.

**Clase PHP**: [`ButtonGroup.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Interface/ButtonGroup.php)

## Opciones de Configuración

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `buttons` | `array` | `[]` | Array de botones renderizados |
| `size` | `string\|null` | `null` | Tamaño: `sm`, `lg` |
| `vertical` | `bool` | `false` | Si es vertical |
| `attributes` | `array` | `[]` | Atributos HTML |

## Ejemplos Básicos

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Grupo horizontal básico
$buttonGroup = BS5::buttonGroup([
    'buttons' => [
        BS5::button(['content' => 'Izquierda', 'variant' => 'primary'])->render(),
        BS5::button(['content' => 'Centro', 'variant' => 'primary'])->render(),
        BS5::button(['content' => 'Derecha', 'variant' => 'primary'])->render()
    ]
])->render();
```

## Ejemplos Avanzados

```php
// Grupo vertical
$verticalGroup = BS5::buttonGroup([
    'vertical' => true,
    'buttons' => [
        BS5::button(['content' => 'Botón 1', 'variant' => 'secondary'])->render(),
        BS5::button(['content' => 'Botón 2', 'variant' => 'secondary'])->render(),
        BS5::button(['content' => 'Botón 3', 'variant' => 'secondary'])->render()
    ]
])->render();

// Grupo con tamaño
$largeGroup = BS5::buttonGroup([
    'size' => 'lg',
    'buttons' => [
        BS5::button(['content' => 'Grande 1'])->render(),
        BS5::button(['content' => 'Grande 2'])->render()
    ]
])->render();

// Barra de herramientas
$toolbar = '
<div class="btn-toolbar" role="toolbar">
    ' . BS5::buttonGroup([
        'buttons' => [
            BS5::button(['content' => '<i class="bi bi-save"></i>'])->render(),
            BS5::button(['content' => '<i class="bi bi-file-earmark"></i>'])->render(),
            BS5::button(['content' => '<i class="bi bi-printer"></i>'])->render()
        ]
    ])->render() . '
    <div class="mx-2"></div>
    ' . BS5::buttonGroup([
        'buttons' => [
            BS5::button(['content' => '<i class="bi bi-arrow-counterclockwise"></i>'])->render(),
            BS5::button(['content' => '<i class="bi bi-arrow-clockwise"></i>'])->render()
        ]
    ])->render() . '
</div>
';
```

## Componentes Relacionados

- [Button](Button.md) - Botones individuales
- [Dropdown](Dropdown.md) - Menús desplegables en grupos

## Documentación Oficial

[Bootstrap 5.3 Button Group](https://getbootstrap.com/docs/5.3/components/button-group/)

---

[← Volver al Índice](../../Bootstrap.md) | [Siguiente: Card →](Card.md)
