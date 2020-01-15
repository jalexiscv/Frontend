# Ejemplos: Componente DataTable

Componente DataTable de Bootstrap 5.3.3 para mostrar una tabla interactiva de datos que permite búsqueda dinámica (filtros locales en texto real) y paginación en el lado del cliente de forma rápida usando JavaScript puro empaquetado y respetando las clases HTML de Bootstrap v5.3.3.

---

## Ejemplo 1: DataTable Básico con Datos Manuales

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;

$datatable = new DataTable([
    'columns' => [
        'id' => '#',
        'name' => 'Nombre completo',
        'role' => 'Cargo',
        'status' => 'Estado'
    ],
    'data' => [
        ['id' => 1, 'name' => 'John Doe', 'role' => 'Desarrollador', 'status' => 'Activo'],
        ['id' => 2, 'name' => 'Jane Smith', 'role' => 'Diseñadora', 'status' => 'Inactivo'],
        ['id' => 3, 'name' => 'Mike Johnson', 'role' => 'Product Owner', 'status' => 'Activo'],
        // ... más datos
    ],
    'perPage' => 10
]);

echo $dtable->render();
```

**Características:**
- Se proporciona la configuración de las columnas que asocian el índice (key del Array de datos) con el texto que va en el encabezado `th`.
- Recibe un Multi-array con datos e inicializará el JavaScript empaquetado generando la estructuración en HTML y ofreciendo la barra para buscar y lista desplegable para las páginas.
- Por defecto muestra paginación y la barra de búsquedas activas.

---

## Ejemplo 2: DataTable Desactivando Búsquedas y Modificando Paginación

```php
$datatable = new DataTable([
    'columns' => [
        'uuid' => 'UUID',
        'log' => 'Mensaje de log',
    ],
    'data' => $logsDeSistema,
    'searchable' => false, // Ocultar input de búsqueda global
    'perPage' => 25, // Por defecto mostrar lotes de a 25.
    'perPageOptions' => [25, 50, 100, 500] // Custom options de paginación
]);

echo $dtable->render();
```

**Características:**
- `perPageOptions` modifica las opciones del combo box "Mostrar X registros".
- `searchable => false` desactiva completamente el código HTML de búsquedas. 
- Ideal para presentar reportes puros que solo necesitan navegación numerada.

---

## Ejemplo 3: DataTable sin ningún control (Tabla Estática con Paginación desactivada)

```php
$datatable = new DataTable([
    'columns' => [
        'mes' => 'Mes',
        'ventas' => 'Ventas Totales ($)'
    ],
    'data' => [
        ['mes' => 'Enero', 'ventas' => '5000'],
        ['mes' => 'Febrero', 'ventas' => '4500'],
    ],
    'searchable' => false,
    'pagination' => false,
    'tableAttributes' => [
        'class' => 'table-bordered table-sm'
    ]
]);

echo $dtable->render();
```

**Características:**
- Todo el bloque de "Controles Top" y "Paginación Inferior" se omiten gráficamente.
- Las `tableAttributes` incrustan las clases directamente a la tabla renderizada, p. ej., `table-bordered`.

---

## Estructura HTML Generada General

El componente encapsula la lógica para proveer las vistas.

```html
<div class="datatable-container w-100" id="datatable_65ccf2b1c2">
    <!-- Controles Superiores -->
    <div class="row mb-3 align-items-center">
        <!-- Selector Per Page -->
        ...
        <!-- Input Search -->
        <div class="col-auto">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-transparent">🔍</span>
                <input type="search" id="datatable_65ccf2b1c2_search" class="form-control" placeholder="Buscar...">
            </div>
        </div>
    </div>
    
    <!-- Contenedor De La Tabla -->
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0" id="datatable_65ccf2b1c2_table">
            <thead>...</thead>
            <tbody id="datatable_65ccf2b1c2_tbody">
                <!-- Javascript renderizará los tr > td dinámicamente aquí -->
            </tbody>
        </table>
    </div>
    
    <!-- Paginación y Texto Informativo -->
    <div class="row mt-3 align-items-center">
        <div class="col-sm-12 col-md-5">
             <div id="datatable_65ccf2b1c2_info" class="small text-muted">Mostrando 1 a 10 de 50 registros</div>
        </div>
        <div class="col-sm-12 col-md-7">
             <nav aria-label="Paginación de tabla">
                  <ul id="datatable_65ccf2b1c2_pagination" class="pagination pagination-sm mb-0">...</ul>
             </nav>
        </div>
    </div>
    
    <script>... VanillaJS DataTable Script ...</script>
</div>
```

---

## Opciones Disponibles Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `id` | string | Auto-generado | Identificador único del contenedor DOM. El Script se vincula a él automáticamente. |
| `columns` | array | `[]` | Array Asociativo de Key a Nombres legibles `['user_id' => 'ID de Usuario']`. |
| `data` | array | `[]` | Matriz de datos. (Pudiendo ser un array de arrays asociativos JSON). |
| `searchable` | boolean | `true` | Determina si muestra el Input de búsqueda. |
| `pagination` | boolean | `true` | Determina si muestra el bloque de Paginación. |
| `perPage` | int | `10` | Registros por página. |
| `perPageOptions`| array | `[10, 25, 50, 100]` | Tamaños permitidos para cambiar cuántas rows mostrar agrupadas. |
| `attributes` | array | `[]` | Atributos HTML del wrapper contenedor (`div`). |
| `tableAttributes` | array | `[]` | Atributos aplicables a la etiqueta `<table class="table ...">`. |

---

## Tips y Buenas Prácticas

1. **Datos Optimizados:** Por defecto el script inyectará en `json_encode` la información. Dicha información debe ser preprocesada en el servidor (escapar HTML si corresponde o permitir HTML si se busca renderizar texto negrita manual `<strong>...</strong>` ya que inserta las celdillas usando `innerHTML`).
2. **Tablas Enormes:** Puesto a que `DataTable` usa Local JS con `json_encode`, si se insertan tablas de sobre 50,000 mil filas, puede suponer un impacto al DOM/V8 Engine inicial por inyección pesada, recomendar a esos casos Servidor Side Rendering, pero para tablas operativas ordinarias de menos de 10k filas, la respuesta es inmediata.
