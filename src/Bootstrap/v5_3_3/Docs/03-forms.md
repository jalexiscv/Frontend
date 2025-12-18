# Componentes de Formulario Bootstrap 5

> **Nota de Migración v2.0.0**: Todos los componentes ahora aceptan un único `array $options` en su constructor. Los ejemplos en esta documentación reflejan la nueva arquitectura.

## Input

Controles de entrada de formulario.

### Input Básico
```php
// Input de texto básico
$input = BS5::input([
    'type' => 'text',
    'name' => 'username',
    'placeholder' => 'Ingrese su usuario',
    'value' => 'valor inicial'
])->render();

// Input con etiqueta
$input = BS5::input([
    'type' => 'text',
    'name' => 'username',
    'label' => 'Nombre de Usuario',
    'placeholder' => 'Ingrese su usuario'
])->render();
```

### Tipos de Input
```php
// Email
$email = BS5::input([
    'type' => 'email',
    'name' => 'email',
    'label' => 'Correo Electrónico',
    'attributes' => ['required' => 'required']
])->render();

// Password
$password = BS5::input([
    'type' => 'password',
    'name' => 'password',
    'label' => 'Contraseña',
    'attributes' => ['required' => 'required']
])->render();

// Number
$number = BS5::input([
    'type' => 'number',
    'name' => 'age',
    'label' => 'Edad',
    'attributes' => ['min' => '18', 'max' => '100']
])->render();

// Date
$date = BS5::input([
    'type' => 'date',
    'name' => 'birthdate',
    'label' => 'Fecha de Nacimiento'
])->render();
```

### Tamaños
```php
// Input pequeño
$input = BS5::input([
    'type' => 'text',
    'name' => 'small',
    'size' => 'sm'
])->render();

// Input grande
$input = BS5::input([
    'type' => 'text',
    'name' => 'large',
    'size' => 'lg'
])->render();
```

### Readonly y Disabled
```php
// Input de solo lectura
$input = BS5::input([
    'type' => 'text',
    'name' => 'readonly',
    'value' => 'Texto de solo lectura',
    'readonly' => true
])->render();

// Input deshabilitado
$input = BS5::input([
    'type' => 'text',
    'name' => 'disabled',
    'value' => 'Input deshabilitado',
    'disabled' => true
])->render();
```

### Floating Labels
```php
// Input con floating label
$input = BS5::input([
    'type' => 'text',
    'name' => 'username',
    'label' => 'Nombre de Usuario',
    'floating' => true,
    'placeholder' => 'Nombre de Usuario' // Requerido para floating
])->render();
```

## Textarea

Área de texto multilínea.

```php
// Textarea básico
$textarea = BS5::textarea([
    'name' => 'description',
    'label' => 'Descripción',
    'rows' => 3
])->render();

// Textarea con floating label
$textarea = BS5::textarea([
    'name' => 'comments',
    'label' => 'Comentarios',
    'floating' => true,
    'placeholder' => 'Comentarios',
    'rows' => 5
])->render();

// Textarea deshabilitado
$textarea = BS5::textarea([
    'name' => 'disabled',
    'value' => 'Contenido deshabilitado',
    'disabled' => true
])->render();
```

## Select

Menús desplegables de selección.

```php
// Select básico
$select = BS5::select([
    'name' => 'country',
    'label' => 'País',
    'options' => [
        'es' => 'España',
        'mx' => 'México',
        'ar' => 'Argentina'
    ]
])->render();

// Select múltiple
$select = BS5::select([
    'name' => 'languages[]',
    'label' => 'Lenguajes',
    'multiple' => true,
    'options' => [
        'php' => 'PHP',
        'js' => 'JavaScript',
        'py' => 'Python'
    ]
])->render();

// Select con opciones avanzadas
$select = BS5::select([
    'name' => 'status',
    'label' => 'Estado',
    'options' => [
        ['value' => 'active', 'label' => 'Activo', 'selected' => true],
        ['value' => 'inactive', 'label' => 'Inactivo'],
        ['value' => 'pending', 'label' => 'Pendiente', 'disabled' => true]
    ]
])->render();

// Select con tamaño
$select = BS5::select([
    'name' => 'size_test',
    'size' => 'lg',
    'options' => ['1' => 'Opción 1', '2' => 'Opción 2']
])->render();
```

## Checkbox

Casillas de verificación.

```php
// Checkbox básico
$check = BS5::check([
    'name' => 'terms',
    'label' => 'Acepto los términos',
    'value' => '1'
])->render();

// Checkbox marcado
$check = BS5::check([
    'name' => 'newsletter',
    'label' => 'Suscribirse al newsletter',
    'checked' => true
])->render();

// Checkbox inline
$checks = [
    BS5::check([
        'name' => 'option1',
        'label' => 'Opción 1',
        'inline' => true
    ])->render(),
    BS5::check([
        'name' => 'option2',
        'label' => 'Opción 2',
        'inline' => true
    ])->render(),
    BS5::check([
        'name' => 'option3',
        'label' => 'Opción 3',
        'inline' => true
    ])->render()
];
```

## Switch

Interruptores de activación/desactivación.

```php
// Switch básico
$switch = BS5::check([
    'name' => 'notifications',
    'label' => 'Activar notificaciones',
    'switch' => true
])->render();

// Switch inline
$switches = [
    BS5::check([
        'name' => 'email_notif',
        'label' => 'Email',
        'switch' => true,
        'inline' => true
    ])->render(),
    BS5::check([
        'name' => 'sms_notif',
        'label' => 'SMS',
        'switch' => true,
        'inline' => true
    ])->render()
];

// Switch marcado
$switch = BS5::check([
    'name' => 'auto_save',
    'label' => 'Guardar automáticamente',
    'switch' => true,
    'checked' => true
])->render();
```

## Radio

Botones de opción única.

```php
// Radio básico
$radio = BS5::radio([
    'name' => 'gender',
    'value' => 'm',
    'label' => 'Masculino'
])->render();

// Grupo de radios
$radios = [
    BS5::radio([
        'name' => 'size',
        'value' => 's',
        'label' => 'Pequeño'
    ])->render(),
    BS5::radio([
        'name' => 'size',
        'value' => 'm',
        'label' => 'Mediano',
        'checked' => true
    ])->render(),
    BS5::radio([
        'name' => 'size',
        'value' => 'l',
        'label' => 'Grande'
    ])->render()
];

// Radio inline
$radios = [
    BS5::radio([
        'name' => 'color',
        'value' => 'red',
        'label' => 'Rojo',
        'inline' => true
    ])->render(),
    BS5::radio([
        'name' => 'color',
        'value' => 'blue',
        'label' => 'Azul',
        'inline' => true
    ])->render(),
    BS5::radio([
        'name' => 'color',
        'value' => 'green',
        'label' => 'Verde',
        'inline' => true
    ])->render()
];
```

## File Input

Entrada de archivos.

```php
// File input básico
$file = BS5::file([
    'name' => 'document',
    'label' => 'Seleccionar archivo'
])->render();

// File input múltiple
$file = BS5::file([
    'name' => 'images[]',
    'label' => 'Seleccionar imágenes',
    'multiple' => true
])->render();

// File input con tamaño
$file = BS5::file([
    'name' => 'avatar',
    'label' => 'Foto de perfil',
    'size' => 'sm'
])->render();
```

## Input Group

Grupos de entrada con addons.

```php
// Input group con texto prepend
$inputGroup = BS5::inputGroup([
    'prepend' => '@',
    'content' => BS5::input([
        'type' => 'text',
        'name' => 'username',
        'placeholder' => 'Username'
    ])->render()
])->render();

// Input group con texto append
$inputGroup = BS5::inputGroup([
    'content' => BS5::input([
        'type' => 'text',
        'name' => 'amount',
        'placeholder' => '0'
    ])->render(),
    'append' => '.00'
])->render();

// Input group con prepend y append
$inputGroup = BS5::inputGroup([
    'prepend' => '$',
    'content' => BS5::input([
        'type' => 'text',
        'name' => 'price'
    ])->render(),
    'append' => '.00'
])->render();

// Input group con botón
$inputGroup = BS5::inputGroup([
    'content' => BS5::input([
        'type' => 'text',
        'name' => 'search',
        'placeholder' => 'Buscar...'
    ])->render(),
    'append' => BS5::button([
        'content' => 'Buscar',
        'variant' => 'primary'
    ])->render()
])->render();

// Input group con tamaño
$inputGroup = BS5::inputGroup([
    'size' => 'lg',
    'prepend' => '@',
    'content' => BS5::input([
        'type' => 'text',
        'name' => 'username'
    ])->render()
])->render();
```

## Form

Contenedor de formulario.

```php
// Formulario básico
$form = BS5::form([
    'action' => '/submit',
    'method' => 'POST',
    'content' => [
        BS5::input([
            'type' => 'text',
            'name' => 'name',
            'label' => 'Nombre',
            'attributes' => ['required' => 'required']
        ])->render(),
        
        BS5::input([
            'type' => 'email',
            'name' => 'email',
            'label' => 'Email',
            'attributes' => ['required' => 'required']
        ])->render(),
        
        BS5::button([
            'content' => 'Enviar',
            'type' => 'submit',
            'variant' => 'primary'
        ])->render()
    ]
])->render();

// Formulario inline (usando grid system)
$form = BS5::form([
    'action' => '/search',
    'method' => 'GET',
    'inline' => true,
    'content' => [
        BS5::input([
            'type' => 'text',
            'name' => 'query',
            'placeholder' => 'Buscar...'
        ])->render(),
        
        BS5::button([
            'content' => 'Buscar',
            'type' => 'submit',
            'variant' => 'primary'
        ])->render()
    ]
])->render();

// Formulario con enctype para archivos
$form = BS5::form([
    'action' => '/upload',
    'method' => 'POST',
    'enctype' => 'multipart/form-data',
    'content' => [
        BS5::file([
            'name' => 'document',
            'label' => 'Seleccionar archivo'
        ])->render(),
        
        BS5::button([
            'content' => 'Subir',
            'type' => 'submit',
            'variant' => 'primary'
        ])->render()
    ]
])->render();
```

## FormControl

Wrapper unificado que delega a Input.

```php
// FormControl (actúa como alias de Input)
$control = BS5::formControl([
    'type' => 'text',
    'name' => 'username',
    'label' => 'Usuario',
    'placeholder' => 'Ingrese su usuario'
])->render();
```

## Ejemplo Completo: Formulario de Registro

```php
$registroForm = BS5::form([
    'action' => '/register',
    'method' => 'POST',
    'content' => [
        // Nombre completo
        BS5::input([
            'type' => 'text',
            'name' => 'fullname',
            'label' => 'Nombre Completo',
            'placeholder' => 'Juan Pérez',
            'attributes' => ['required' => 'required', 'minlength' => '3']
        ])->render(),
        
        // Email
        BS5::input([
            'type' => 'email',
            'name' => 'email',
            'label' => 'Correo Electrónico',
            'placeholder' => 'correo@ejemplo.com',
            'attributes' => ['required' => 'required']
        ])->render(),
        
        // Password
        BS5::input([
            'type' => 'password',
            'name' => 'password',
            'label' => 'Contraseña',
            'attributes' => ['required' => 'required', 'minlength' => '8']
        ])->render(),
        
        // País
        BS5::select([
            'name' => 'country',
            'label' => 'País',
            'options' => [
                '' => 'Seleccione un país',
                'es' => 'España',
                'mx' => 'México',
                'ar' => 'Argentina',
                'co' => 'Colombia'
            ]
        ])->render(),
        
        // Género
        BS5::radio([
            'name' => 'gender',
            'value' => 'm',
            'label' => 'Masculino',
            'inline' => true
        ])->render(),
        BS5::radio([
            'name' => 'gender',
            'value' => 'f',
            'label' => 'Femenino',
            'inline' => true
        ])->render(),
        
        // Términos
        BS5::check([
            'name' => 'terms',
            'label' => 'Acepto los términos y condiciones',
            'attributes' => ['required' => 'required']
        ])->render(),
        
        // Newsletter
        BS5::check([
            'name' => 'newsletter',
            'label' => 'Deseo recibir el newsletter',
            'switch' => true
        ])->render(),
        
        // Botón submit
        BS5::button([
            'content' => 'Registrarse',
            'type' => 'submit',
            'variant' => 'primary',
            'attributes' => ['class' => 'w-100 mt-3']
        ])->render()
    ]
])->render();
```

## Opciones Disponibles

Para consultar todas las opciones disponibles de cada componente, revisa el PHPDoc en:
- `Form\Input.php`
- `Form\Select.php`
- `Form\Textarea.php`
- `Form\Check.php`
- `Form\Radio.php`
- `Form\File.php`
- `Form\InputGroup.php`
- `Form\Form.php`

O consulta `COMPONENT_STANDARDS.md` para entender el patrón arquitectónico completo.
