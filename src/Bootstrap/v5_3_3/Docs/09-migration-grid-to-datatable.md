# Guía de Migración: De Grid Legacy a DataTable

## Tabla de Contenidos
1. [Introducción](#introducción)
2. [Comparación de Enfoques](#comparación-de-enfoques)
3. [Migración Paso a Paso](#migración-paso-a-paso)
4. [Migración de Botones](#migración-de-botones)
5. [Ejemplos Completos](#ejemplos-completos)
6. [Mejores Prácticas](#mejores-prácticas)

---

## Introducción

Esta guía documenta el proceso de migración del sistema legacy `$bootstrap->get_Grid()` al nuevo componente `DataTable` de Bootstrap v5.3.3, incluyendo la actualización de botones desde `$bootstrap->get_Link()` a la clase `Button`.

### ¿Por qué migrar?

- **Mejor rendimiento**: DataTable optimiza el renderizado del lado del servidor
- **Más funcionalidades**: Búsqueda, paginación y ordenamiento integrados
- **Código más limpio**: Separación clara de datos y presentación
- **Type-safe**: Uso de clases con tipado estricto
- **Mantenibilidad**: Código más fácil de entender y mantener

---

## Comparación de Enfoques

### ❌ Código Legacy (Antes)

```php
// Imports legacy
// No hay imports específicos

// Preparar Grid
$bgrid = $bootstrap->get_Grid();
$bgrid->setHeaders(array(
    'id' => array('text' => 'ID'),
    'ip' => array('text' => 'IP'),
    'options' => array('text' => 'Opciones')
));

// Obtener datos
$rows = $mwhitelist->getSearch($conditions, 10, 0);

// Procesar cada fila
foreach($rows as $row) {
    // Botones legacy
    $btnView = $bootstrap->get_Link("btn-view", array(
        "size" => "sm",
        "icon" => ICON_VIEW,
        "title" => "Ver",
        "href" => "/whitelist/view/{$row['id']}",
        "class" => "btn-primary ml-1"
    ));

    $bgrid->addRow(array(
        'id' => $row['id'],
        'ip' => $row['ip'],
        'options' => $btnView
    ));
}

echo $bgrid->render();
```

### ✅ Código Moderno (Después)

```php
// Imports modernos
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

// Configuración de consulta normalizada
$conditions = array();
$limit = 10000;
$offset = 0;
$order = "id DESC";

// Obtener datos
$rows = $mwhitelist->getCachedSearch($conditions, $limit, $offset, $order);

// Preparar datos para DataTable
$tableData = [];
foreach ($rows["data"] as $row) {
    if (!empty($row["id"])) {
        // Links
        $hrefView = "/whitelist/view/{$row["id"]}";

        // Botón moderno (sin texto)
        $btnView = (new Button([
            "size" => "sm",
            "icon" => ICON_VIEW,
            "variant" => "primary",
            "attributes" => [
                "href" => $hrefView,
                "class" => "ml-1"
            ]
        ]))->render();

        // Agregar fila con configuración avanzada
        $tableData[] = [
            'id' => [
                "value" => $row['id'],
                "class" => "align-middle text-center text-nowrap",
                "style" => "width:100px;"
            ],
            'ip' => $row['ip'],
            'options' => [
                "value" => $btnView,
                "class" => "align-middle text-center text-nowrap",
                "style" => "width:100px;"
            ]
        ];
    }
}

// Configurar DataTable
$dataTable = new DataTable([
    'id' => 'whitelist-datatable',
    'columns' => [
        'id' => ["title" => 'ID', "class" => "text-center"],
        'ip' => ["title" => lang("App.IP"), "class" => "text-center"],
        'options' => ["title" => "Opciones", "class" => "align-middle text-center text-nowrap"]
    ],
    'data' => $tableData,
    'searchable' => true,
    'pagination' => true,
    'perPage' => 10,
    'perPageOptions' => [10, 20, 40, 80, 160],
    'tableAttributes' => [
        'class' => 'table-sm'
    ]
]);

// Renderizar dentro de una Card
$card = $bootstrap->get_Card2("card-grid", array(
    "header-title" => lang('Firewall_Whitelist.list-title'),
    "header-back" => $back,
    "header-add" => "/firewall/whitelist/create/" . lpk(),
    "alert" => array(
        "icon" => ICON_INFO,
        "type" => "info",
        "title" => lang('Firewall_Whitelist.list-title'),
        "message" => lang('Firewall_Whitelist.list-description')
    ),
    "content" => $dataTable->render()
));
echo($card);
```

---

## Migración Paso a Paso

### Paso 1: Agregar Imports

Reemplaza los imports legacy (si existen) con los nuevos:

```php
// ✅ Agregar al inicio del archivo (después de los comentarios de documentación)
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;
```

### Paso 2: Normalizar la Consulta de Datos

Separa los parámetros de consulta en variables con nombres descriptivos:

```php
// ❌ Antes (valores hardcodeados)
$rows = $model->getCachedSearch($conditions, 10000, 0, "id DESC");

// ✅ Después (variables normalizadas)
$conditions = array();
$limit = 10000;      // Número máximo de registros
$offset = 0;         // Punto de inicio
$order = "id DESC";  // Orden de resultados

$rows = $model->getCachedSearch($conditions, $limit, $offset, $order);
```

### Paso 3: Preparar el Array de Datos

Transforma los datos del modelo al formato esperado por DataTable:

```php
$tableData = [];
foreach ($rows["data"] as $row) {
    if (!empty($row["id"])) {
        // Preparar datos de la fila
        $tableData[] = [
            'columna1' => $row['columna1'],
            'columna2' => $row['columna2'],
            // ... más columnas
        ];
    }
}
```

#### Formato de Datos Avanzado

DataTable acepta dos formatos para cada celda:

**Formato Simple:**
```php
'columna' => $valor
```

**Formato Avanzado (con estilos y clases):**
```php
'columna' => [
    "value" => $valor,
    "class" => "align-middle text-center text-nowrap",
    "style" => "width:100px; color: red;"
]
```

### Paso 4: Configurar las Columnas

Define las columnas con sus títulos y estilos:

```php
'columns' => [
    'id' => [
        "title" => 'ID',
        "class" => "text-center"
    ],
    'nombre' => [
        "title" => lang("App.Name"),
        "class" => "text-left"
    ],
    'opciones' => [
        "title" => "Opciones",
        "class" => "align-middle text-center text-nowrap"
    ]
]
```

### Paso 5: Instanciar DataTable

Crea la instancia con todas las opciones:

```php
$dataTable = new DataTable([
    'id' => 'mi-datatable',              // ID único (obligatorio para múltiples tablas)
    'columns' => $columnas,               // Definición de columnas
    'data' => $tableData,                 // Datos preparados
    'searchable' => true,                 // Mostrar buscador
    'pagination' => true,                 // Mostrar paginación
    'perPage' => 10,                      // Registros por página
    'perPageOptions' => [10, 20, 40, 80], // Opciones de paginación
    'tableAttributes' => [
        'class' => 'table-sm table-hover'  // Clases adicionales para la tabla
    ]
]);
```

### Paso 6: Renderizar

```php
// Opción 1: Dentro de una Card
$card = $bootstrap->get_Card2("card-grid", array(
    "header-title" => "Mi Listado",
    "content" => $dataTable->render()
));
echo($card);

// Opción 2: Directamente
echo $dataTable->render();
```

---

## Migración de Botones

### De `get_Link()` a `Button`

#### ❌ Código Legacy

```php
$btnView = $bootstrap->get_Link("btn-view", array(
    "size" => "sm",
    "icon" => ICON_VIEW,
    "title" => "Ver",
    "href" => $hrefView,
    "class" => "btn-primary ml-1"
));
```

#### ✅ Código Moderno

```php
$btnView = (new Button([
    "size" => "sm",
    "icon" => ICON_VIEW,
    "content" => "Ver",  // Cambió de 'title' a 'content'
    "variant" => "primary",  // Cambió de 'class' (btn-primary)
    "attributes" => [
        "href" => $hrefView,
        "class" => "ml-1"  // Clases adicionales
    ]
]))->render();
```

### Tabla de Mapeo de Propiedades

| Legacy (`get_Link`) | Moderno (`Button`) | Notas |
|---------------------|-------------------|-------|
| `title` | `content` | Texto del botón |
| `class: "btn-primary"` | `variant: "primary"` | Color del botón |
| `class: "btn-warning"` | `variant: "warning"` | Color advertencia |
| `class: "btn-danger"` | `variant: "danger"` | Color peligro |
| `class: "btn-success"` | `variant: "success"` | Color éxito |
| `class: "btn-info"` | `variant: "info"` | Color información |
| `class: "btn-secondary"` | `variant: "secondary"` | Color secundario |
| `href` | `attributes['href']` | URL del enlace |
| `class` (adicionales) | `attributes['class']` | Clases CSS extras |

### Botones Sin Texto (Solo Iconos)

Para crear botones que solo muestren íconos, simplemente **omite** la propiedad `content`:

```php
// ✅ Botón solo con ícono
$btnView = (new Button([
    "size" => "sm",
    "icon" => ICON_VIEW,
    // NO incluir 'content'
    "variant" => "primary",
    "attributes" => [
        "href" => $hrefView,
        "class" => "ml-1",
        "title" => lang("App.View")  // Tooltip para accesibilidad
    ]
]))->render();
```

**Importante para Accesibilidad:**
- Siempre incluye `title` en los atributos cuando uses botones sin texto
- Esto asegura que los usuarios con lectores de pantalla entiendan la función del botón

### Grupo de Botones

Combina múltiples botones en un grupo:

```php
// Crear botones individuales
$btnView = (new Button([
    "size" => "sm",
    "icon" => ICON_VIEW,
    "variant" => "primary",
    "attributes" => ["href" => $hrefView, "class" => "ml-1"]
]))->render();

$btnEdit = (new Button([
    "size" => "sm",
    "icon" => ICON_EDIT,
    "variant" => "warning",
    "attributes" => ["href" => $hrefEdit, "class" => "ml-1"]
]))->render();

$btnDelete = (new Button([
    "size" => "sm",
    "icon" => ICON_DELETE,
    "variant" => "danger",
    "attributes" => ["href" => $hrefDelete, "class" => "ml-1"]
]))->render();

// Agrupar botones
$options = $bootstrap->get_BtnGroup("btn-group", array(
    "content" => $btnView . $btnEdit . $btnDelete
));
```

### Variantes de Botones

```php
// Botón outline (solo borde)
$btn = (new Button([
    "content" => "Outline",
    "variant" => "primary",
    "outline" => true  // ✅ Activa el modo outline
]))->render();

// Botón deshabilitado
$btn = (new Button([
    "content" => "Deshabilitado",
    "variant" => "primary",
    "disabled" => true  // ✅ Deshabilita el botón
]))->render();

// Botón con carga
$btn = (new Button([
    "content" => "Guardar",
    "variant" => "success",
    "loading" => true,  // ✅ Muestra spinner
    "loadingText" => "Guardando..."
]))->render();

// Botón grande
$btn = (new Button([
    "content" => "Grande",
    "variant" => "primary",
    "size" => "lg"  // Opciones: 'sm', 'lg'
]))->render();
```

---

## Ejemplos Completos

### Ejemplo 1: Tabla Simple con Botones

```php
<?php

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

// Modelo
$mUsers = model('App\Modules\Users\Models\Users');

// Configuración de consulta
$conditions = array();
$limit = 10000;
$offset = 0;
$order = "id DESC";

// Obtener datos
$rows = $mUsers->getCachedSearch($conditions, $limit, $offset, $order);

// Preparar datos
$tableData = [];
foreach ($rows["data"] as $row) {
    if (!empty($row["id"])) {
        // URLs
        $hrefView = "/users/view/{$row["id"]}";
        $hrefEdit = "/users/edit/{$row["id"]}";
        $hrefDelete = "/users/delete/{$row["id"]}";

        // Botones (sin texto)
        $btnView = (new Button([
            "size" => "sm",
            "icon" => ICON_VIEW,
            "variant" => "primary",
            "attributes" => [
                "href" => $hrefView,
                "title" => lang("App.View")
            ]
        ]))->render();

        $btnEdit = (new Button([
            "size" => "sm",
            "icon" => ICON_EDIT,
            "variant" => "warning",
            "attributes" => [
                "href" => $hrefEdit,
                "title" => lang("App.Edit")
            ]
        ]))->render();

        $btnDelete = (new Button([
            "size" => "sm",
            "icon" => ICON_DELETE,
            "variant" => "danger",
            "attributes" => [
                "href" => $hrefDelete,
                "title" => lang("App.Delete")
            ]
        ]))->render();

        $options = $bootstrap->get_BtnGroup("btn-group", array(
            "content" => $btnView . $btnEdit . $btnDelete
        ));

        // Agregar fila
        $tableData[] = [
            'id' => [
                "value" => $row['id'],
                "class" => "align-middle text-center"
            ],
            'name' => $row['name'],
            'email' => $row['email'],
            'options' => [
                "value" => $options,
                "class" => "align-middle text-center text-nowrap"
            ]
        ];
    }
}

// Configurar DataTable
$dataTable = new DataTable([
    'id' => 'users-datatable',
    'columns' => [
        'id' => ["title" => 'ID', "class" => "text-center"],
        'name' => ["title" => lang("Users.Name")],
        'email' => ["title" => lang("Users.Email")],
        'options' => ["title" => lang("App.Options"), "class" => "text-center"]
    ],
    'data' => $tableData,
    'searchable' => true,
    'pagination' => true,
    'perPage' => 10,
    'perPageOptions' => [10, 20, 50, 100]
]);

// Renderizar
$card = $bootstrap->get_Card2("card-grid", array(
    "header-title" => lang('Users.list-title'),
    "header-back" => "/home",
    "header-add" => "/users/create",
    "content" => $dataTable->render()
));
echo($card);
?>
```

### Ejemplo 2: Tabla con Datos Formateados

```php
<?php

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

// Obtener datos
$rows = $mProducts->getCachedSearch([], 10000, 0, "id DESC");

// Preparar datos con formato avanzado
$tableData = [];
foreach ($rows["data"] as $row) {
    // Badge de estado
    $statusClass = $row['active'] ? 'bg-success' : 'bg-danger';
    $statusText = $row['active'] ? 'Activo' : 'Inactivo';
    $status = "<span class='badge {$statusClass}'>{$statusText}</span>";

    // Precio formateado
    $price = "$" . number_format($row['price'], 2);

    // Botón
    $btnEdit = (new Button([
        "size" => "sm",
        "icon" => ICON_EDIT,
        "variant" => "warning",
        "attributes" => ["href" => "/products/edit/{$row["id"]}"]
    ]))->render();

    // Agregar fila con estilos personalizados
    $tableData[] = [
        'id' => [
            "value" => $row['id'],
            "class" => "text-center fw-bold",
            "style" => "width: 80px;"
        ],
        'name' => [
            "value" => $row['name'],
            "class" => "text-primary"
        ],
        'price' => [
            "value" => $price,
            "class" => "text-end",
            "style" => "width: 120px;"
        ],
        'status' => [
            "value" => $status,
            "class" => "text-center",
            "style" => "width: 100px;"
        ],
        'options' => [
            "value" => $btnEdit,
            "class" => "text-center",
            "style" => "width: 80px;"
        ]
    ];
}

// Configurar DataTable
$dataTable = new DataTable([
    'id' => 'products-datatable',
    'columns' => [
        'id' => ["title" => '#', "class" => "text-center"],
        'name' => ["title" => 'Producto'],
        'price' => ["title" => 'Precio', "class" => "text-end"],
        'status' => ["title" => 'Estado', "class" => "text-center"],
        'options' => ["title" => 'Acciones', "class" => "text-center"]
    ],
    'data' => $tableData,
    'searchable' => true,
    'pagination' => true,
    'perPage' => 20,
    'perPageOptions' => [10, 20, 50, 100, 200],
    'tableAttributes' => [
        'class' => 'table-sm table-striped table-hover'
    ]
]);

echo $dataTable->render();
?>
```

### Ejemplo 3: Paginación del Lado del Servidor (Server-Side Pagination)

Para tablas con **muchos registros** (más de 10,000), es más eficiente usar paginación del lado del servidor:

```php
<?php

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

// Modelo
$mlivetraffic = model('App\Modules\Firewall\Models\Firewall_Livetraffic');

// Parámetros de paginación del lado del servidor
$currentPage = max(1, (int)($request->getVar("page") ?? 1));
$perPage = (int)($request->getVar("per_page") ?? 10);
$offset = ($currentPage - 1) * $perPage;
$search = !empty($request->getVar("search")) ? $request->getVar("search") : "";

// Condiciones de búsqueda
$conditions = array();
if (!empty($search)) {
    $conditions['ip LIKE'] = "%{$search}%";
}
$order = "traffic DESC";
$limit = $perPage;

// ✅ Obtener SOLO los registros de la página actual (no todos)
$rows = $mlivetraffic->getCachedSearch($conditions, $limit, $offset, $order);
$total = $mlivetraffic->getCountAllResults($conditions);

// Preparar datos
$tableData = [];
$count = $offset; // Contador empieza desde el offset actual
foreach ($rows["data"] as $row) {
    if (!empty($row["traffic"])) {
        $count++;

        // URLs
        $hrefView = "/firewall/livetraffic/view/{$row["traffic"]}";
        $hrefDelete = "/firewall/livetraffic/delete/{$row["traffic"]}";

        // Botones (sin texto)
        $btnView = (new Button([
            "size" => "sm",
            "icon" => ICON_VIEW,
            "variant" => "primary",
            "attributes" => [
                "href" => $hrefView,
                "title" => lang("App.View")
            ]
        ]))->render();

        $btnDelete = (new Button([
            "size" => "sm",
            "icon" => ICON_DELETE,
            "variant" => "danger",
            "attributes" => [
                "href" => $hrefDelete,
                "title" => lang("App.Delete")
            ]
        ]))->render();

        $options = $bootstrap->get_BtnGroup("btn-group", array(
            "content" => $btnView . $btnDelete
        ));

        // Agregar fila
        $tableData[] = [
            'count' => [
                "value" => $count,
                "class" => "text-center align-middle",
                "style" => "width: 80px;"
            ],
            'ip' => [
                "value" => $row['ip'],
                "class" => "text-left align-middle"
            ],
            'date' => [
                "value" => $row['date'],
                "class" => "text-left align-middle",
                "style" => "width: 120px;"
            ],
            'options' => [
                "value" => $options,
                "class" => "text-center align-middle text-nowrap",
                "style" => "width: 100px;"
            ]
        ];
    }
}

// ✅ Configurar DataTable con Server-Side Pagination
$dataTable = new DataTable([
    'id' => 'livetraffic-datatable',
    'columns' => [
        'count' => ["title" => "#", "class" => "text-center align-middle"],
        'ip' => ["title" => "IP", "class" => "text-center align-middle"],
        'date' => ["title" => lang("App.Date"), "class" => "text-center align-middle"],
        'options' => ["title" => lang("App.Options"), "class" => "text-center align-middle"]
    ],
    'data' => $tableData,
    'searchable' => true,
    'pagination' => true,
    'perPage' => $perPage,
    'perPageOptions' => [10, 20, 40, 80, 160, 320, 640],
    'tableAttributes' => [
        'class' => 'table-sm'
    ],
    // ✅ CLAVE: Habilitar Server-Side Pagination
    'serverSide' => true,           // Activa paginación del servidor
    'totalRecords' => $total,       // Total de registros en BD
    'currentPage' => $currentPage   // Página actual
]);

// Renderizar
$card = $bootstrap->get_Card2("card-grid", array(
    "header-title" => lang('Firewall_Livetraffic.list-title'),
    "header-back" => "/firewall",
    "content" => $dataTable->render()
));
echo($card);
?>
```

**Diferencias clave con paginación del cliente:**
- ✅ `serverSide: true` - Activa el modo servidor
- ✅ `totalRecords: $total` - Total de registros en la BD
- ✅ `currentPage: $currentPage` - Página actual desde `$_GET['page']`
- ✅ Solo se consultan los registros de la página actual
- ✅ El contador empieza desde `$offset`, no desde 0
- ✅ La búsqueda se hace en el servidor con `LIKE`

### Ejemplo 4: Múltiples Tablas en la Misma Vista

```php
<?php

use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;

// TABLA 1: Usuarios Activos
$dataTable1 = new DataTable([
    'id' => 'active-users-datatable',  // ✅ ID único
    'columns' => ['id' => 'ID', 'name' => 'Nombre'],
    'data' => $activeUsersData,
    'perPage' => 5
]);

// TABLA 2: Usuarios Inactivos
$dataTable2 = new DataTable([
    'id' => 'inactive-users-datatable',  // ✅ ID único diferente
    'columns' => ['id' => 'ID', 'name' => 'Nombre'],
    'data' => $inactiveUsersData,
    'perPage' => 5
]);

echo "<h3>Usuarios Activos</h3>";
echo $dataTable1->render();

echo "<h3>Usuarios Inactivos</h3>";
echo $dataTable2->render();
?>
```

---

## Mejores Prácticas

### 1. Elegir el Tipo de Paginación Correcto

**Paginación del Cliente (Client-Side):**
- ✅ Usar cuando tienes **menos de 1,000 registros**
- ✅ No requiere configuración adicional (`serverSide: false` por defecto)
- ✅ Búsqueda y ordenamiento instantáneos
- ✅ Menos peticiones al servidor
- ❌ Puede ser lento con muchos datos

**Paginación del Servidor (Server-Side):**
- ✅ Usar cuando tienes **más de 1,000 registros**
- ✅ Rendimiento óptimo con grandes volúmenes
- ✅ Menor uso de memoria
- ✅ Búsquedas más complejas en BD
- ❌ Requiere recarga de página por búsqueda/ordenamiento

```php
// Ejemplo de decisión
$total = $model->getCountAllResults([]);

if ($total > 1000) {
    // ✅ Usar Server-Side Pagination
    $dataTable = new DataTable([
        'serverSide' => true,
        'totalRecords' => $total,
        'currentPage' => $currentPage,
        'data' => $pageData // Solo datos de la página actual
    ]);
} else {
    // ✅ Usar Client-Side Pagination
    $dataTable = new DataTable([
        'data' => $allData // Todos los datos
    ]);
}
```

### 2. Normalización de Consultas

Siempre usa variables descriptivas para los parámetros de consulta:

```php
// ✅ BIEN
$conditions = ['status' => 'active'];
$limit = 10000;
$offset = 0;
$order = "created_at DESC";
$rows = $model->getCachedSearch($conditions, $limit, $offset, $order);

// ❌ MAL
$rows = $model->getCachedSearch(['status' => 'active'], 10000, 0, "created_at DESC");
```

### 2. Validación de Datos

Siempre valida que los datos existan antes de procesarlos:

```php
// ✅ BIEN
foreach ($rows["data"] as $row) {
    if (!empty($row["id"])) {
        // Procesar fila
    }
}

// ❌ MAL
foreach ($rows["data"] as $row) {
    // Sin validación - puede causar errores
}
```

### 3. Reutilización de URLs

Define las URLs base una sola vez:

```php
// ✅ BIEN
$component = '/firewall/whitelist';
foreach ($rows["data"] as $row) {
    $hrefView = "$component/view/{$row["id"]}";
    $hrefEdit = "$component/edit/{$row["id"]}";
}

// ❌ MAL
foreach ($rows["data"] as $row) {
    $hrefView = "/firewall/whitelist/view/{$row["id"]}";
    $hrefEdit = "/firewall/whitelist/edit/{$row["id"]}";
}
```

### 4. Botones Sin Texto con Tooltips

Siempre incluye `title` para accesibilidad:

```php
// ✅ BIEN
$btn = (new Button([
    "icon" => ICON_VIEW,
    "variant" => "primary",
    "attributes" => [
        "href" => $href,
        "title" => lang("App.View")  // ✅ Tooltip descriptivo
    ]
]))->render();

// ❌ MAL
$btn = (new Button([
    "icon" => ICON_VIEW,
    "variant" => "primary",
    "attributes" => ["href" => $href]
    // ❌ Sin título - mala accesibilidad
]))->render();
```

### 5. Uso de Formato Avanzado de Celdas

Usa el formato avanzado solo cuando necesites estilos personalizados:

```php
// ✅ BIEN (formato simple para datos básicos)
$tableData[] = [
    'name' => $row['name'],
    'email' => $row['email']
];

// ✅ BIEN (formato avanzado cuando necesites estilos)
$tableData[] = [
    'id' => [
        "value" => $row['id'],
        "class" => "text-center fw-bold",
        "style" => "width: 80px;"
    ]
];

// ❌ MAL (formato avanzado innecesario)
$tableData[] = [
    'name' => [
        "value" => $row['name']
        // Sin class ni style - usa formato simple
    ]
];
```

### 6. IDs Únicos para DataTables

Siempre usa IDs descriptivos y únicos:

```php
// ✅ BIEN
$dataTable = new DataTable([
    'id' => 'users-active-datatable',  // Descriptivo y único
    // ...
]);

// ❌ MAL
$dataTable = new DataTable([
    'id' => 'table1',  // Poco descriptivo
    // ...
]);
```

### 7. Configuración de Paginación

Ajusta las opciones de paginación según el volumen de datos:

```php
// Para tablas pequeñas (< 100 registros)
'perPage' => 10,
'perPageOptions' => [10, 20, 50]

// Para tablas medianas (100-1000 registros)
'perPage' => 20,
'perPageOptions' => [10, 20, 50, 100]

// Para tablas grandes (> 1000 registros)
'perPage' => 50,
'perPageOptions' => [20, 50, 100, 200, 500]
```

### 8. Optimización con Caché

Usa `getCachedSearch` para consultas frecuentes:

```php
// ✅ BIEN (con caché para listas)
$rows = $model->getCachedSearch($conditions, $limit, $offset, $order);

// ⚠️ PRECAUCIÓN (sin caché - solo para datos en tiempo real)
$rows = $model->getSearch($conditions, $limit, $offset, $order);
```

### 9. Estructura del Código

Mantén una estructura clara y consistente:

```php
// [1] Imports
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;
use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Button;

// [2] Models
$model = model('...');

// [3] Vars (configuración)
$back = "...";
$component = "...";

// [4] Build (consulta de datos)
$conditions = array();
$limit = 10000;
$offset = 0;
$order = "id DESC";
$rows = $model->getCachedSearch($conditions, $limit, $offset, $order);

// [5] Prepare data (preparación de datos)
$tableData = [];
foreach ($rows["data"] as $row) {
    // ...
}

// [6] Configure DataTable (configuración del componente)
$dataTable = new DataTable([...]);

// [7] Render (renderizado)
echo $dataTable->render();
```

---

## Checklist de Migración

Use esta lista para verificar que tu migración está completa:

- [ ] ✅ Imports agregados (`DataTable` y `Button`)
- [ ] ✅ Consulta normalizada con `$limit`, `$offset`, `$order`
- [ ] ✅ Array `$tableData` preparado correctamente
- [ ] ✅ Botones migrados de `get_Link()` a `Button`
- [ ] ✅ Botones sin texto incluyen `title` en atributos
- [ ] ✅ Columnas configuradas con títulos y clases
- [ ] ✅ DataTable instanciado con ID único
- [ ] ✅ Opciones de paginación configuradas
- [ ] ✅ Tabla renderizada correctamente
- [ ] ✅ Código legacy (`$bgrid->`) eliminado
- [ ] ✅ Validación de datos existentes (`!empty($row["id"])`)
- [ ] ✅ Probado en navegador

---

## Soporte y Recursos

- **Documentación DataTable**: `08-extras.md`
- **Documentación Button**: `05-interface.md`
- **Ejemplos**: Busca archivos migrados en `app/Modules/*/Views/*/List/grid.php`

---

## Conclusión

La migración de Grid Legacy a DataTable moderniza tu código, mejora el rendimiento y proporciona una mejor experiencia de usuario. Sigue esta guía paso a paso y consulta los ejemplos para asegurar una migración exitosa.

**¿Preguntas?** Consulta la documentación adicional o revisa los archivos de ejemplo en el proyecto.
