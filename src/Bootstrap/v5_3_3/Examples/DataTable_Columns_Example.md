# DataTable: Documentación y Ejemplo de Definición de Estilos en Columnas

El componente `DataTable` permite especificar el título y los estilos CSS aplicados a cada columna de la tabla de forma flexible, soportando configuraciones simples y compuestas directamente en la propiedad `columns`.

## Formato de Definición (`columns`)

La propiedad `columns` es un arreglo asociativo donde la *llave* representa el índice o campo de los datos (la columna física) y el *valor* representa cómo se va a renderizar el encabezado y el cuerpo de esa columna.

Existen 2 maneras principales de definir este *valor*:
1.  **Plano (Cadena de texto):** Soporte legado/rápido donde solo se define el título de la columna.
2.  **Estructurado (Array asociativo):** Se define explícitamente el `title` e inclusive un atributo `class` que en inyectará el componente a la columna y datos de manera integral.

### Ejemplo de Uso

A continuación, un ejemplo que combina ambos métodos de forma ilustrativa:

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\DataTable;

$dataTable = new DataTable([
    'id' => 'usuarios_table',
    'searchable' => true,
    'pagination' => true,
    'perPage' => 10,
    
    // Configuración Híbrida de Columnas
    'columns' => [
        // 1. Formato Plano (solo título)
        'id' => '#ID', 
        
        // 2. Formato Estructurado (título + clases de Bootstrap)
        'usuario' => [
            'title' => 'Nombre de Usuario',
            'class' => 'fw-bold text-primary min-w-150px' // Se inyectan directamente al <th> y <td>
        ],
        
        'email' => [
            'title' => 'Correo Electrónico',
            'class' => 'text-muted fst-italic'
        ],
        
        'estado' => [
            'title' => 'Estado de Cuenta',
            'class' => 'text-center align-middle bg-light'
        ]
    ],
    
    // Conjunto de Datos
    'data' => [
        ['id' => 1, 'usuario' => 'johndoe', 'email' => 'john@example.com', 'estado' => 'Activo'],
        ['id' => 2, 'usuario' => 'janedoe', 'email' => 'jane@example.com', 'estado' => 'Inactivo'],
        ['id' => 3, 'usuario' => 'admin', 'email' => 'admin@example.com', 'estado' => 'Activo']
    ]
]);

// Para renderizar el componente de la tabla, basta con:
// echo (string)$dataTable->render();
```

### Retrocompatibilidad (Backwards Compatibility)

Previamente, todo el formateo estático de CSS se ingresaba vía la propiedad `columnStyles`. Este comportamiento funciona correctamente y opera como un *"Merge"* al array `class` de `columns`.

Es decir, si lo haces de la vieja forma:

```php
'columns' => [
    'email' => 'Correo Electrónico'
],
'columnStyles' => [
    'email' => 'text-center'
]
```

La tabla seguirá funcionando sin problemas. No obstante, si provees `class` dentro de la declaración estructurada en `columns` *y también* un estilo individual vía `columnStyles`, **ambos se concatenaran**, consolidando todas las clases. La mejor práctica recomendada desde ahora es definir los estilos directamente dentro del array asociativo `columns`.

## Formato Estructurado para el Contenido (`data`)

De la misma manera que se pueden definir estilos para los encabezados de las columnas, el componente `DataTable` permite aplicar estilos y clases CSS de forma granular a **celdas individuales de contenido** (los `<td>`).

Para esto, en el array `data`, en lugar de pasar un valor plano (ej. `'Activo'`), puedes enviar un **array asociativo** con la siguiente estructura:
- `value`: El contenido a renderizar en la celda.
- `class` (Opcional): Clases CSS a inyectar en la etiqueta `<td>`.
- `style` (Opcional): Estilos en línea a inyectar en la etiqueta `<td>`.

### Ejemplo de Contenido Estructurado

```php
'data' => [
    [
        'id' => 1,
        'usuario' => 'johndoe',
        'email' => 'john@example.com',
        // Estilo condicional solo para esta celda
        'estado' => [
            'value' => 'Activo',
            'class' => 'text-success fw-bold',
            'style' => 'background-color: #e8f5e9;' // Estilo CSS en línea opcional
        ]
    ],
    [
        'id' => 2,
        'usuario' => 'janedoe',
        'email' => 'jane@example.com',
        'estado' => [
            'value' => 'Inactivo',
            'class' => 'text-danger fw-bold text-decoration-line-through'
        ]
    ]
]
```

Esta estructura es totalmente compatible con la búsqueda y el ordenamiento de la tabla; el componente extraerá automáticamente la llave `value` para realizar estas operaciones sin romper la interactividad.
