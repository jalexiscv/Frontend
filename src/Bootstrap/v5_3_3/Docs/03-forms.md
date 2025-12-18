# Componentes de Formulario Bootstrap 5

## FormControl

Controles de formulario personalizados.

### Input Básico
```php
// Input de texto básico
$input = BS5::input('text', 'username')
    ->placeholder('Ingrese su usuario')
    ->value('valor inicial')
    ->render();

// Input con etiqueta
$input = BS5::input('text', 'username')
    ->label('Nombre de Usuario')
    ->placeholder('Ingrese su usuario')
    ->render();
```

### Tipos de Input
```php
// Email
$email = BS5::input('email', 'email')
    ->label('Correo Electrónico')
    ->required()
    ->render();

// Password
$password = BS5::input('password', 'password')
    ->label('Contraseña')
    ->required()
    ->render();

// Number
$number = BS5::input('number', 'age')
    ->label('Edad')
    ->min(18)
    ->max(100)
    ->render();

// Date
$date = BS5::input('date', 'birthdate')
    ->label('Fecha de Nacimiento')
    ->render();

// Textarea
$textarea = BS5::textarea('description')
    ->label('Descripción')
    ->rows(3)
    ->render();
```

### Select
```php
// Select básico
$select = BS5::select('country', [
    'es' => 'España',
    'mx' => 'México',
    'ar' => 'Argentina'
])
->label('País')
->render();

// Select múltiple
$select = BS5::select('languages', [
    'php' => 'PHP',
    'js' => 'JavaScript',
    'py' => 'Python'
])
->label('Lenguajes')
->multiple()
->render();
```

### Validación
```php
// Input con estado válido
$input = BS5::input('text', 'username')
    ->isValid()
    ->feedbackValid('¡Nombre de usuario disponible!')
    ->render();

// Input con estado inválido
$input = BS5::input('email', 'email')
    ->isInvalid()
    ->feedbackInvalid('Por favor ingrese un email válido')
    ->render();
```

### Tamaños
```php
// Input pequeño
$input = BS5::input('text', 'small')
    ->small()
    ->render();

// Input grande
$input = BS5::input('text', 'large')
    ->large()
    ->render();
```

### Readonly y Disabled
```php
// Input de solo lectura
$input = BS5::input('text', 'readonly')
    ->value('Texto de solo lectura')
    ->readonly()
    ->render();

// Input deshabilitado
$input = BS5::input('text', 'disabled')
    ->value('Input deshabilitado')
    ->disabled()
    ->render();
```

## Input Group

Extiende los controles de formulario agregando texto, botones o grupos de botones.

### Input Group Básico
```php
// Input group con texto
$inputGroup = BS5::inputGroup()
    ->prepend('@')
    ->input('text', 'username')
    ->render();

// Input group con texto al final
$inputGroup = BS5::inputGroup()
    ->input('text', 'amount')
    ->append('.00')
    ->render();
```

### Input Group con Botones
```php
// Input group con botón
$inputGroup = BS5::inputGroup()
    ->input('text', 'search')
    ->append(
        BS5::button('Buscar')
            ->variant('primary')
            ->render()
    )
    ->render();

// Input group con múltiples botones
$inputGroup = BS5::inputGroup()
    ->prepend(
        BS5::button('Anterior')
            ->variant('outline-secondary')
            ->render()
    )
    ->input('text', 'page')
    ->append(
        BS5::button('Siguiente')
            ->variant('outline-secondary')
            ->render()
    )
    ->render();
```

### Input Group con Checkbox y Radio
```php
// Input group con checkbox
$inputGroup = BS5::inputGroup()
    ->prepend(
        BS5::check('terms')
            ->render()
    )
    ->input('text', 'terms')
    ->render();

// Input group con radio
$inputGroup = BS5::inputGroup()
    ->prepend(
        BS5::radio('option')
            ->name('options')
            ->render()
    )
    ->input('text', 'option')
    ->render();
```

### Input Group con Dropdown
```php
// Input group con dropdown
$inputGroup = BS5::inputGroup()
    ->prepend(
        BS5::dropdown('Opciones')
            ->items([
                'opcion1' => 'Opción 1',
                'opcion2' => 'Opción 2',
                'opcion3' => 'Opción 3'
            ])
            ->render()
    )
    ->input('text', 'selection')
    ->render();
```

### Input Group con Múltiples Inputs
```php
// Input group con múltiples inputs
$inputGroup = BS5::inputGroup()
    ->input('text', 'firstname', ['placeholder' => 'Nombre'])
    ->input('text', 'lastname', ['placeholder' => 'Apellido'])
    ->render();

// Input group con rango de fechas
$inputGroup = BS5::inputGroup()
    ->input('date', 'start_date')
    ->append('hasta')
    ->input('date', 'end_date')
    ->render();
```

### Input Group con Tamaños
```php
// Input group pequeño
$inputGroup = BS5::inputGroup()
    ->small()
    ->prepend('$')
    ->input('text', 'amount_sm')
    ->append('.00')
    ->render();

// Input group grande
$inputGroup = BS5::inputGroup()
    ->large()
    ->prepend('$')
    ->input('text', 'amount_lg')
    ->append('.00')
    ->render();
```

## Check y Radio

Componentes para selección múltiple y única.

### Checkbox
```php
// Checkbox básico
$check = BS5::check('terms')
    ->label('Acepto los términos')
    ->render();

// Checkbox inline
$checks = [
    BS5::check('option1')
        ->label('Opción 1')
        ->inline()
        ->render(),
    BS5::check('option2')
        ->label('Opción 2')
        ->inline()
        ->render()
];
```

### Radio
```php
// Radio básico
$radio = BS5::radio('gender')
    ->value('m')
    ->label('Masculino')
    ->render();

// Radio inline
$radios = [
    BS5::radio('size')
        ->value('s')
        ->label('Pequeño')
        ->inline()
        ->render(),
    BS5::radio('size')
        ->value('m')
        ->label('Mediano')
        ->inline()
        ->render(),
    BS5::radio('size')
        ->value('l')
        ->label('Grande')
        ->inline()
        ->render()
];
```

### Switch
```php
// Switch básico
$switch = BS5::check('notifications')
    ->label('Activar notificaciones')
    ->switch()
    ->render();

// Switch inline
$switches = [
    BS5::check('email_notif')
        ->label('Email')
        ->switch()
        ->inline()
        ->render(),
    BS5::check('sms_notif')
        ->label('SMS')
        ->switch()
        ->inline()
        ->render()
];
```

## Form Layout

Diferentes layouts para formularios.

### Formulario Básico
```php
$form = BS5::form()
    ->action('/submit')
    ->method('POST')
    ->content([
        BS5::input('text', 'name')
            ->label('Nombre')
            ->required()
            ->render(),
        BS5::input('email', 'email')
            ->label('Email')
            ->required()
            ->render(),
        BS5::button('Enviar')
            ->type('submit')
            ->variant('primary')
            ->render()
    ])
    ->render();
```

### Formulario en Línea
```php
$form = BS5::form()
    ->inline()
    ->action('/search')
    ->method('GET')
    ->content([
        BS5::input('text', 'query')
            ->placeholder('Buscar...')
            ->render(),
        BS5::button('Buscar')
            ->type('submit')
            ->variant('primary')
            ->render()
    ])
    ->render();
```

### Formulario Horizontal
```php
$form = BS5::form()
    ->horizontal()
    ->action('/register')
    ->method('POST')
    ->content([
        BS5::input('text', 'username')
            ->label('Usuario')
            ->labelCol('col-sm-2')
            ->inputCol('col-sm-10')
            ->render(),
        BS5::input('email', 'email')
            ->label('Email')
            ->labelCol('col-sm-2')
            ->inputCol('col-sm-10')
            ->render(),
        BS5::input('password', 'password')
            ->label('Contraseña')
            ->labelCol('col-sm-2')
            ->inputCol('col-sm-10')
            ->render(),
        BS5::div('col-sm-10 offset-sm-2')
            ->content(
                BS5::button('Registrar')
                    ->type('submit')
                    ->variant('primary')
                    ->render()
            )
            ->render()
    ])
    ->render();
```

### Formulario con Validación
```php
$form = BS5::form()
    ->needsValidation()
    ->action('/register')
    ->method('POST')
    ->content([
        BS5::input('text', 'username')
            ->label('Usuario')
            ->required()
            ->minLength(3)
            ->maxLength(20)
            ->feedbackInvalid('El usuario debe tener entre 3 y 20 caracteres')
            ->render(),
        BS5::input('email', 'email')
            ->label('Email')
            ->required()
            ->feedbackInvalid('Por favor ingrese un email válido')
            ->render(),
        BS5::input('password', 'password')
            ->label('Contraseña')
            ->required()
            ->minLength(8)
            ->feedbackInvalid('La contraseña debe tener al menos 8 caracteres')
            ->render(),
        BS5::check('terms')
            ->label('Acepto los términos')
            ->required()
            ->feedbackInvalid('Debe aceptar los términos')
            ->render(),
        BS5::button('Registrar')
            ->type('submit')
            ->variant('primary')
            ->render()
    ])
    ->render();
```
