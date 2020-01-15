# Ejemplos: Componente Table

Componente Table de Bootstrap 5.3.3 para crear tablas con encabezados, filas y múltiples estilos.

---

## ⚠️ Importante: HTML en Celdas

**El componente Table NO escapa HTML en las celdas por defecto.** Esto permite incluir HTML rico (botones, badges, iconos, etc.) pero requiere precaución con datos de usuario.

### Seguridad

```php
// ✅ SEGURO - HTML hardcoded/confiable
$rows = [
    ['<strong>1</strong>', 'Juan', '<button class="btn btn-sm">Ver</button>']
];

// ❌ PELIGROSO - Datos de usuario sin sanitizar
$rows = [
    [$_POST['id'], $_POST['name'], $_POST['html']]  // ⚠️ Vulnerabilidad XSS
];

// ✅ SEGURO - Datos de usuario escapados
$rows = [
    [htmlspecialchars($_POST['id']), htmlspecialchars($_POST['name']), 'Acción']
];
```

**Regla de oro**: Solo usa HTML directo en celdas cuando el contenido es **confiable** (hardcoded, generado por el sistema). Para datos de usuario, **siempre escapa con `htmlspecialchars()`**.

---

## Ejemplo 1: Tabla Básica

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Content\Table;

$table = new Table([
    'header' => ['ID', 'Nombre', 'Email', 'Rol'],
    'rows' => [
        [1, 'Juan Pérez', 'juan@example.com', 'Admin'],
        [2, 'María García', 'maria@example.com', 'Editor'],
        [3, 'Carlos López', 'carlos@example.com', 'Usuario']
    ]
]);

echo $table->render();
```

**Características:**
- Tabla simple con encabezados (`<thead>`)
- Filas de datos (`<tbody>`)
- Clase base `table` de Bootstrap
- Cada celda es escapada automáticamente

---

## Ejemplo 2: Tabla con Estilo Striped (Rayas)

```php
$table = new Table([
    'header' => ['Producto', 'Precio', 'Stock'],
    'rows' => [
        ['Laptop', '$1,200', '15'],
        ['Mouse', '$25', '150'],
        ['Teclado', '$75', '80'],
        ['Monitor', '$300', '45']
    ],
    'striped' => true
]);

echo $table->render();
```

**Características:**
- Filas con fondo alternado (clase `table-striped`)
- Mejora la legibilidad visual
- Compatible con todos los temas de Bootstrap

---

## Ejemplo 3: Tabla con Columnas Striped

```php
$table = new Table([
    'header' => ['Enero', 'Febrero', 'Marzo', 'Abril'],
    'rows' => [
        ['$1,200', '$1,500', '$1,350', '$1,800'],
        ['$980', '$1,100', '$1,250', '$1,400']
    ],
    'striped' => 'columns'
]);

echo $table->render();
```

**Características:**
- Columnas con fondo alternado (clase `table-striped-columns`)
- Útil para resaltar columnas en lugar de filas
- Novedad de Bootstrap 5.3+

---

## Ejemplo 4: Tabla Hoverable

```php
$table = new Table([
    'header' => ['Usuario', 'Último Acceso', 'Estado'],
    'rows' => [
        ['admin', '2026-01-07 10:30', 'Activo'],
        ['editor', '2026-01-06 15:45', 'Activo'],
        ['guest', '2026-01-05 08:20', 'Inactivo']
    ],
    'hover' => true
]);

echo $table->render();
```

**Características:**
- Efecto hover en filas (clase `table-hover`)
- Las filas se resaltan al pasar el mouse
- Mejora la interactividad

---

## Ejemplo 5: Tabla con Bordes

```php
$table = new Table([
    'header' => ['Columna 1', 'Columna 2', 'Columna 3'],
    'rows' => [
        ['Dato A', 'Dato B', 'Dato C'],
        ['Dato D', 'Dato E', 'Dato F']
    ],
    'bordered' => true
]);

echo $table->render();
```

**Características:**
- Bordes en todas las celdas (clase `table-bordered`)
- Define claramente los límites de cada celda
- Ideal para tablas con muchos datos

---

## Ejemplo 6: Tabla sin Bordes

```php
$table = new Table([
    'header' => ['Nombre', 'Valor'],
    'rows' => [
        ['Configuración 1', 'Habilitado'],
        ['Configuración 2', 'Deshabilitado']
    ],
    'borderless' => true
]);

echo $table->render();
```

**Características:**
- Sin bordes (clase `table-borderless`)
- Aspecto limpio y minimalista
- Ideal para layouts sutiles

---

## Ejemplo 7: Tabla Pequeña (Compacta)

```php
$table = new Table([
    'header' => ['#', 'Tarea', 'Completada'],
    'rows' => [
        [1, 'Revisar emails', '✓'],
        [2, 'Llamar a cliente', '✓'],
        [3, 'Preparar reporte', ''],
        [4, 'Reunión de equipo', '✓']
    ],
    'small' => true
]);

echo $table->render();
```

**Características:**
- Padding reducido (clase `table-sm`)
- Ideal para tablas con mucha información
- Ahorra espacio vertical

---

## Ejemplo 8: Tabla con Variante de Color

```php
// Tabla oscura
$tableDark = new Table([
    'header' => ['Columna 1', 'Columna 2'],
    'rows' => [
        ['Dato 1', 'Dato 2'],
        ['Dato 3', 'Dato 4']
    ],
    'variant' => 'dark'
]);

// Tabla con tema primary
$tablePrimary = new Table([
    'header' => ['Producto', 'Status'],
    'rows' => [
        ['Item A', 'Disponible'],
        ['Item B', 'Agotado']
    ],
    'variant' => 'primary'
]);

echo $tableDark->render();
echo $tablePrimary->render();
```

**Variantes disponibles:**
- `primary` - Azul
- `secondary` - Gris
- `success` - Verde
- `danger` - Rojo
- `warning` - Amarillo
- `info` - Celeste
- `light` - Claro
- `dark` - Oscuro

---

## Ejemplo 9: Tabla con Caption (Título)

```php
$table = new Table([
    'header' => ['Mes', 'Ventas'],
    'rows' => [
        ['Enero', '$45,000'],
        ['Febrero', '$52,300'],
        ['Marzo', '$48,700']
    ],
    'caption' => 'Reporte de Ventas - Q1 2026'
]);

echo $table->render();
```

**Características:**
- Caption en la parte inferior por defecto
- Describe el contenido de la tabla
- Mejora la accesibilidad (screen readers)

---

## Ejemplo 10: Tabla con Caption Superior

```php
$table = new Table([
    'header' => ['Departamento', 'Empleados', 'Presupuesto'],
    'rows' => [
        ['IT', '25', '$500,000'],
        ['Marketing', '15', '$300,000'],
        ['Ventas', '30', '$400,000']
    ],
    'caption' => 'Distribución por Departamento',
    'captionTop' => true
]);

echo $table->render();
```

**Características:**
- Caption en la parte superior (clase `caption-top`)
- Más visible que la posición por defecto
- Útil cuando el caption es importante

---

## Ejemplo 11: Tabla Combinada (Múltiples Opciones)

```php
$table = new Table([
    'header' => ['ID', 'Cliente', 'Monto', 'Estado'],
    'rows' => [
        [1001, 'Empresa A', '$15,000', 'Pagado'],
        [1002, 'Empresa B', '$8,500', 'Pendiente'],
        [1003, 'Empresa C', '$22,000', 'Pagado'],
        [1004, 'Empresa D', '$12,300', 'Vencido']
    ],
    'striped' => true,
    'hover' => true,
    'bordered' => true,
    'small' => true,
    'caption' => 'Facturas del Mes'
]);

echo $table->render();
```

**Características:**
- Combina múltiples opciones
- Striped + hover + bordered + small
- Caption descriptivo
- Tabla completa y funcional

---

## Ejemplo 12: Headers con Atributos Personalizados

```php
$table = new Table([
    'header' => [
        ['content' => '#', 'class' => 'text-center', 'style' => 'width: 50px'],
        ['content' => 'Nombre', 'class' => 'text-start'],
        ['content' => 'Email', 'class' => 'text-start d-none d-md-table-cell'],
        ['content' => 'Rol', 'class' => 'text-center', 'style' => 'width: 120px'],
        ['content' => 'Acciones', 'class' => 'text-end', 'style' => 'width: 150px']
    ],
    'rows' => [
        [1, 'Juan Pérez', 'juan@example.com', 'Admin', 'Editar'],
        [2, 'María García', 'maria@example.com', 'Editor', 'Editar'],
        [3, 'Carlos López', 'carlos@example.com', 'Usuario', 'Editar']
    ],
    'striped' => true
]);

echo $table->render();
```

**Características:**
- Cada header es un array asociativo con `content` + atributos HTML
- `content` define el texto del `<th>`
- El resto de claves se aplican como atributos HTML (`class`, `style`, `colspan`, `data-*`, etc.)
- `scope="col"` y `align-middle` se incluyen por defecto
- Las clases adicionales se fusionan con `align-middle` automáticamente

**HTML generado (primer `<th>`):**
```html
<th scope="col" class="align-middle text-center" style="width: 50px">#</th>
```

---

## Ejemplo 13: Headers Mixtos (Strings y Arrays)

```php
$table = new Table([
    'header' => [
        'ID',                                    // String simple
        'Nombre',                                // String simple
        ['content' => 'Email', 'class' => 'd-none d-lg-table-cell'],  // Array con atributos
        'Rol',                                   // String simple
        ['content' => 'Acciones', 'class' => 'text-end', 'style' => 'width: 180px']
    ],
    'rows' => [
        [1, 'Juan Pérez', 'juan@example.com', 'Admin', 'Editar | Eliminar'],
        [2, 'María García', 'maria@example.com', 'Editor', 'Editar | Eliminar']
    ],
    'hover' => true
]);

echo $table->render();
```

**Características:**
- Se pueden mezclar strings simples y arrays en el mismo header
- Los strings se renderizan con los atributos por defecto (`scope="col"`, `class="align-middle"`)
- Los arrays permiten personalizar atributos individuales por columna
- Útil cuando solo algunas columnas necesitan estilos especiales

---

## Ejemplo 14: Headers con htmlContent (HTML Crudo)

```php
$table = new Table([
    'header' => [
        ['htmlContent' => '<i class="fas fa-hashtag"></i> ID', 'class' => 'text-center', 'style' => 'width: 60px'],
        ['htmlContent' => '<i class="fas fa-user"></i> Nombre'],
        ['htmlContent' => '<i class="fas fa-envelope"></i> Email', 'class' => 'd-none d-md-table-cell'],
        ['htmlContent' => '<i class="fas fa-cog"></i> Acciones', 'class' => 'text-end']
    ],
    'rows' => [
        [1, 'Juan Pérez', 'juan@example.com', 'Editar | Eliminar'],
        [2, 'María García', 'maria@example.com', 'Editar | Eliminar']
    ],
    'hover' => true
]);

echo $table->render();
```

**Características:**
- `htmlContent` inyecta HTML crudo sin escapar (usa `Html::raw()` internamente)
- Ideal para íconos, badges o markup confiable dentro del encabezado
- `htmlContent` tiene prioridad sobre `content` si ambos están presentes
- **Seguridad:** Usar SOLO con HTML confiable (hardcoded). NUNCA con entrada de usuario

**HTML generado (primer `<th>`):**
```html
<th scope="col" class="align-middle text-center" style="width: 60px"><i class="fas fa-hashtag"></i> ID</th>
```

**Comparación content vs htmlContent:**
| Clave | Escapa HTML | Uso recomendado |
|-------|-------------|-----------------|
| `content` | Sí | Texto plano, datos de usuario |
| `htmlContent` | No | HTML confiable, íconos, badges |

---

## Ejemplo 15: Headers con colspan y Atributos Avanzados

```php
$table = new Table([
    'header' => [
        ['content' => 'Información Personal', 'colspan' => '2', 'class' => 'text-center bg-primary text-white'],
        ['content' => 'Contacto', 'colspan' => '2', 'class' => 'text-center bg-info text-white'],
        ['content' => 'Estado', 'class' => 'text-center']
    ],
    'rows' => [
        ['Juan', 'Pérez', 'juan@example.com', '555-0101', 'Activo'],
        ['María', 'García', 'maria@example.com', '555-0102', 'Inactivo']
    ],
    'bordered' => true
]);

echo $table->render();
```

**Características:**
- `colspan` para agrupar columnas bajo un mismo encabezado
- Clases de color de Bootstrap para diferenciar grupos
- Cualquier atributo HTML válido para `<th>` puede incluirse
- Se puede sobreescribir `scope` si se necesita otro valor

---

## Ejemplo 16: Tabla con Atributos de Tabla Personalizados

```php
$table = new Table([
    'header' => ['Nombre', 'Email', 'Teléfono'],
    'rows' => [
        ['Ana Silva', 'ana@example.com', '555-0101'],
        ['Luis Torres', 'luis@example.com', '555-0102']
    ],
    'attributes' => [
        'class' => 'shadow-sm',
        'id' => 'contactos-table',
        'data-filter' => 'enabled'
    ]
]);

echo $table->render();
```

**Características:**
- Clases CSS adicionales
- ID personalizado
- Data attributes para JavaScript
- Compatible con frameworks JS

---

## Ejemplo 17: Tabla Responsiva (Wrapper)

```php
$table = new Table([
    'header' => ['ID', 'Producto', 'Descripción', 'Precio', 'Stock', 'Categoría', 'Proveedor'],
    'rows' => [
        [1, 'Laptop HP', 'Core i7, 16GB RAM', '$1,200', 15, 'Electrónica', 'HP Inc.'],
        [2, 'Mouse Logitech', 'Inalámbrico ergonómico', '$25', 150, 'Accesorios', 'Logitech']
    ]
]);

// Envolver en contenedor responsivo
echo '<div class="table-responsive">';
echo $table->render();
echo '</div>';
```

**Características:**
- Scroll horizontal en pantallas pequeñas
- Usa clase `table-responsive` de Bootstrap
- Ideal para tablas anchas

---

## Ejemplo 18: Tabla con Datos Dinámicos (Base de Datos)

```php
// Simulación de datos desde base de datos
$users = [
    ['id' => 1, 'name' => 'Juan', 'email' => 'juan@example.com', 'role' => 'Admin'],
    ['id' => 2, 'name' => 'María', 'email' => 'maria@example.com', 'role' => 'Editor'],
    ['id' => 3, 'name' => 'Pedro', 'email' => 'pedro@example.com', 'role' => 'Usuario']
];

// Preparar headers
$headers = ['ID', 'Nombre', 'Email', 'Rol'];

// Preparar rows
$rows = [];
foreach ($users as $user) {
    $rows[] = [
        $user['id'],
        $user['name'],
        $user['email'],
        $user['role']
    ];
}

$table = new Table([
    'header' => $headers,
    'rows' => $rows,
    'striped' => true,
    'hover' => true
]);

echo $table->render();
```

**Características:**
- Datos reales desde base de datos
- Transformación de array asociativo a rows
- Patrón común en aplicaciones

---

## Ejemplo 19: Tabla con Acciones (Botones)

```php
use Higgs\Html\Html;

$rows = [];
$users = [
    ['id' => 1, 'name' => 'Juan Pérez', 'email' => 'juan@example.com'],
    ['id' => 2, 'name' => 'María García', 'email' => 'maria@example.com']
];

foreach ($users as $user) {
    // Crear botones de acción
    $editBtn = Html::tag('a', [
        'href' => "/usuario/editar/{$user['id']}",
        'class' => 'btn btn-sm btn-warning me-1'
    ], 'Editar');
    
    $deleteBtn = Html::tag('a', [
        'href' => "/usuario/eliminar/{$user['id']}",
        'class' => 'btn btn-sm btn-danger',
        'onclick' => "return confirm('¿Eliminar usuario?')"
    ], 'Eliminar');
    
    $actions = Html::tag('div', ['class' => 'btn-group']);
    $actions->content([$editBtn, $deleteBtn]);
    
    $rows[] = [
        $user['id'],
        $user['name'],
        $user['email'],
        $actions
    ];
}

$table = new Table([
    'header' => ['ID', 'Nombre', 'Email', 'Acciones'],
    'rows' => $rows,
    'hover' => true
]);

echo $table->render();
```

**Características:**
- Columna de acciones con botones
- Usa objetos TagInterface en celdas
- Botones Edit/Delete por fila
- Patrón CRUD común

---

## Ejemplo 20: Tabla con Badges de Estado

```php
use Higgs\Html\Html;

$orders = [
    ['id' => 1001, 'client' => 'Empresa A', 'status' => 'completed'],
    ['id' => 1002, 'client' => 'Empresa B', 'status' => 'pending'],
    ['id' => 1003, 'client' => 'Empresa C', 'status' => 'cancelled']
];

$rows = [];
foreach ($orders as $order) {
    // Determinar variante del badge según estado
    $badgeVariant = match($order['status']) {
        'completed' => 'success',
        'pending' => 'warning',
        'cancelled' => 'danger',
        default => 'secondary'
    };
    
    $statusText = match($order['status']) {
        'completed' => 'Completado',
        'pending' => 'Pendiente',
        'cancelled' => 'Cancelado',
        default => 'Desconocido'
    };
    
    $badge = Html::tag('span', [
        'class' => "badge bg-{$badgeVariant}"
    ], $statusText);
    
    $rows[] = [
        $order['id'],
        $order['client'],
        $badge
    ];
}

$table = new Table([
    'header' => ['Orden #', 'Cliente', 'Estado'],
    'rows' => $rows,
    'striped' => true
]);

echo $table->render();
```

**Características:**
- Badges coloridos según estado
- Usa `match()` para lógica condicional
- Estados visuales claros
- Ideal para dashboards

---

## Ejemplo 21: Tabla sin Datos (Vacía)

```php
$table = new Table([
    'header' => ['ID', 'Nombre', 'Email'],
    'rows' => []
]);

echo $table->render();
```

**Resultado:**
```html
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
</table>
```

**Características:**
- Solo renderiza `<thead>`
- No crea `<tbody>` si no hay rows
- Útil para estados de carga

---

## Ejemplo 22: Tabla Solo con Datos (Sin Headers)

```php
$table = new Table([
    'rows' => [
        ['Propiedad 1', 'Valor 1'],
        ['Propiedad 2', 'Valor 2'],
        ['Propiedad 3', 'Valor 3']
    ]
]);

echo $table->render();
```

**Características:**
- Sin `<thead>`
- Solo `<tbody>` con datos
- Útil para listas de propiedades

---

## Ejemplo 23: Tabla con Formato Numérico

```php
$salesData = [
    ['Enero', 45230.50, 38120.00, 7110.50],
    ['Febrero', 52300.75, 41200.30, 11100.45],
    ['Marzo', 48700.00, 39800.50, 8899.50]
];

$rows = [];
foreach ($salesData as $data) {
    $rows[] = [
        $data[0],
        '$' . number_format($data[1], 2),
        '$' . number_format($data[2], 2),
        '$' . number_format($data[3], 2)
    ];
}

$table = new Table([
    'header' => ['Mes', 'Ventas', 'Costos', 'Ganancia'],
    'rows' => $rows,
    'striped' => true,
    'bordered' => true,
    'caption' => 'Reporte Financiero Trimestral'
]);

echo $table->render();
```

**Características:**
- Formato de números con `number_format()`
- Formato monetario
- Ideal para reportes financieros

---

## Ejemplo 24: Tabla con HTML en Celdas

```php
use Higgs\Html\Html;

$products = [
    [
        'name' => 'Laptop HP',
        'price' => 1200,
        'available' => true
    ],
    [
        'name' => 'Mouse Logitech',
        'price' => 25,
        'available' => false
    ]
];

$rows = [];
foreach ($products as $product) {
    // Crear celda con HTML
    $nameCell = Html::tag('strong')->content($product['name']);
    $priceCell = Html::tag('span', ['class' => 'text-success'])
        ->content('$' . number_format($product['price']));
    
    $statusIcon = $product['available'] 
        ? Html::tag('i', ['class' => 'fas fa-check text-success'])
        : Html::tag('i', ['class' => 'fas fa-times text-danger']);
    
    $rows[] = [$nameCell, $priceCell, $statusIcon];
}

$table = new Table([
    'header' => ['Producto', 'Precio', 'Disponible'],
    'rows' => $rows
]);

echo $table->render();
```

**Características:**
- Celdas con objetos TagInterface
- HTML complejo en celdas
- Iconos y estilos por celda

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `header` | array | [] | Array de encabezados. Cada elemento puede ser un string o un array asociativo con `content` (escapado) o `htmlContent` (HTML crudo) + atributos HTML para el `<th>` |
| `rows` | array | [] | Array bidimensional de datos para las filas |
| `striped` | bool\|string | false | Filas alternadas (`true`) o columnas (`'columns'`) |
| `hover` | bool | false | Efecto hover en filas |
| `bordered` | bool | false | Bordes en todas las celdas |
| `borderless` | bool | false | Sin bordes |
| `small` | bool | false | Padding reducido |
| `variant` | string | null | Tema de color de la tabla |
| `caption` | string | null | Texto de caption |
| `captionTop` | bool | false | Caption en la parte superior |
| `attributes` | array | [] | Atributos HTML adicionales |

### Valores para `variant`

- `null` - Sin variante (default)
- `primary` - Azul
- `secondary` - Gris
- `success` - Verde
- `danger` - Rojo
- `warning` - Amarillo
- `info` - Celeste
- `light` - Claro
- `dark` - Oscuro

### Valores para `striped`

- `false` - Sin striped (default)
- `true` - Filas alternadas (`table-striped`)
- `'columns'` - Columnas alternadas (`table-striped-columns`)

---

## Estructura HTML Generada

### Tabla Básica (headers como strings)

```html
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="align-middle">Encabezado 1</th>
            <th scope="col" class="align-middle">Encabezado 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="align-middle">Dato 1</td>
            <td class="align-middle">Dato 2</td>
        </tr>
    </tbody>
</table>
```

### Tabla con Headers con Atributos

```html
<!-- header => [['content' => 'ID', 'class' => 'text-center', 'style' => 'width:50px'], 'Nombre'] -->
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="align-middle text-center" style="width:50px">ID</th>
            <th scope="col" class="align-middle">Nombre</th>
        </tr>
    </thead>
    ...
</table>
```

### Con Caption

```html
<table class="table">
    <caption>Título de la tabla</caption>
    <thead>...</thead>
    <tbody>...</tbody>
</table>
```

### Con Caption Top

```html
<table class="table caption-top">
    <caption>Título arriba</caption>
    <thead>...</thead>
    <tbody>...</tbody>
</table>
```

---

## Clases de Bootstrap Aplicadas

### Clases Base
- `table` - Siempre aplicada

### Clases Condicionales
- `table-striped` - Si `striped = true`
- `table-striped-columns` - Si `striped = 'columns'`
- `table-hover` - Si `hover = true`
- `table-bordered` - Si `bordered = true`
- `table-borderless` - Si `borderless = true`
- `table-sm` - Si `small = true`
- `table-{variant}` - Si `variant` está definido
- `caption-top` - Si `captionTop = true`

---

## Notas de Implementación

### Formato de Headers

Los headers soportan múltiples formatos:

```php
// 1. Vector simple de strings
'header' => ['ID', 'Nombre', 'Email']

// 2. Arrays con content (texto escapado)
'header' => [
    ['content' => 'ID', 'class' => 'text-center', 'style' => 'width: 50px'],
    ['content' => 'Nombre', 'class' => 'text-start'],
    ['content' => 'Email']
]

// 3. Arrays con htmlContent (HTML crudo sin escapar)
'header' => [
    ['htmlContent' => '<i class="fas fa-hashtag"></i> ID', 'class' => 'text-center'],
    ['htmlContent' => '<i class="fas fa-user"></i> Nombre'],
    ['htmlContent' => '<i class="fas fa-cog"></i> Acciones']
]

// 4. Mixto: strings, content y htmlContent combinados
'header' => [
    'ID',                                                          // string simple
    ['content' => 'Nombre'],                                       // content escapado
    ['htmlContent' => '<i class="fas fa-cog"></i> Acciones',       // HTML crudo
     'class' => 'text-end']
]
```

Cuando un header es un array:
- `content` (string) — Texto escapado del `<th>`.
- `htmlContent` (string) — HTML crudo sin escapar (prioridad sobre `content`). Usa `Html::raw()` internamente.
- Cualquier otra clave se aplica como atributo HTML del `<th>` (`class`, `style`, `colspan`, `rowspan`, `data-*`, etc.)
- `scope="col"` se incluye por defecto (se puede sobreescribir).
- La clase `align-middle` se fusiona automáticamente con las clases proporcionadas.

**Seguridad:** `htmlContent` NO escapa HTML. Usar SOLO con contenido confiable (hardcoded, generado por el sistema). NUNCA con entrada de usuario.

### Formato de Rows

Las filas deben ser arrays de arrays:

```php
// ✅ Correcto
'rows' => [
    ['Dato 1', 'Dato 2', 'Dato 3'],
    ['Dato 4', 'Dato 5', 'Dato 6']
]

// ❌ Incorrecto (array simple)
'rows' => ['Dato 1', 'Dato 2', 'Dato 3']
```

### Contenido de Celdas

Las celdas pueden contener:
1. **Strings** - Se escapan automáticamente
2. **Números** - Se convierten a string
3. **Objetos TagInterface** - Se renderizan directamente
4. **null** - Se renderiza como string vacío

### Alineación de Headers y Rows

No es necesario que el número de celdas coincida con el número de headers, pero se recomienda por consistencia:

```php
// ✅ Recomendado - Mismo número
'header' => ['Col1', 'Col2', 'Col3'],
'rows' => [
    ['A', 'B', 'C'],
    ['D', 'E', 'F']
]

// ⚠️ Funciona pero inconsistente
'header' => ['Col1', 'Col2'],
'rows' => [
    ['A', 'B', 'C']  // Celda extra sin header
]
```

---

## Tips y Buenas Prácticas

### 1. Usar Striped para Tablas Largas

```php
// ✅ Bueno - Mejora legibilidad
$table = new Table([
    'rows' => $manyRows,
    'striped' => true
]);
```

### 2. Combinar Hover con Acciones

```php
// ✅ Bueno - Indica interactividad
$table = new Table([
    'rows' => $rowsWithActions,
    'hover' => true
]);
```

### 3. Usar Caption para Accesibilidad

```php
// ✅ Bueno - Mejora accesibilidad
$table = new Table([
    'header' => $headers,
    'rows' => $rows,
    'caption' => 'Lista de usuarios del sistema'
]);
```

### 4. Small para Tablas Densas

```php
// ✅ Bueno - Ahorra espacio
$table = new Table([
    'rows' => $manyRowsAndColumns,
    'small' => true
]);
```

### 5. Responsive Wrapper

```php
// ✅ Bueno - Previene overflow en móviles
echo '<div class="table-responsive">';
echo $table->render();
echo '</div>';
```

---

## Ejemplos de Uso Real

### Dashboard de Ventas

```php
$salesTable = new Table([
    'header' => ['Vendedor', 'Ventas', 'Comisión', 'Meta'],
    'rows' => [
        ['Juan Pérez', '$45,000', '$2,250', '✓'],
        ['María García', '$52,000', '$2,600', '✓'],
        ['Carlos López', '$38,000', '$1,900', '✗']
    ],
    'striped' => true,
    'hover' => true,
    'small' => true,
    'caption' => 'Resumen de Ventas - Enero 2026'
]);
```

### Lista de Usuarios Admin

```php
$usersTable = new Table([
    'header' => ['ID', 'Usuario', 'Email', 'Rol', 'Último Acceso', 'Acciones'],
    'rows' => $userRows,  // Generadas dinámicamente con botones
    'striped' => true,
    'hover' => true,
    'bordered' => true,
    'attributes' => ['id' => 'users-table']
]);
```

### Reporte Financiero

```php
$financialTable = new Table([
    'header' => ['Concepto', 'Presupuestado', 'Real', 'Diferencia'],
    'rows' => $financialData,
    'bordered' => true,
    'variant' => 'light',
    'caption' => 'Comparativo Presupuesto vs Real - Q1 2026',
    'captionTop' => true
]);
```

---

## Referencias

- **Componente**: [`Table.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Content/Table.php)
- **Estándares**: [`COMPONENT_STANDARDS.md`](file:///c:/xampp/htdocs/system/Frontend/COMPONENT_STANDARDS.md)
- **Bootstrap Docs**: [Bootstrap 5.3 Tables](https://getbootstrap.com/docs/5.3/content/tables/)
