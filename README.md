# Frontend Framework Documentation

## Índice
1. [Introducción](#introducción)
2. [Instalación](#instalación)
3. [Uso Básico](#uso-básico)
4. [Componentes](#componentes)
5. [Ejemplos](#ejemplos)

## Introducción

Frontend Framework es una solución robusta y empresarial para la generación de interfaces de usuario en el ecosistema Higgs. Más que un simple wrapper de HTML, actúa como una capa de abstracción inteligente que estandariza la creación de componentes UI, asegurando consistencia visual, accesibilidad (ARIA) automática y adherencia estricta a los estándares de código.

Diseñada para desarrolladores que buscan:
*   **Velocidad**: Prototipado y desarrollo rápido mediante una API fluida e intuitiva.
*   **Seguridad**: Escapado automático de atributos y contenido para prevenir XSS.
*   **Mantenibilidad**: Código limpio, fuertemente tipado (PHP 8.0+) y desacoplado del framework visual subyacente.

## Arquitectura Multi-Framework

Esta librería ha sido diseñada con una arquitectura escalable y agnóstica para soportar múltiples frameworks visuales y versiones simultáneas, garantizando la longevidad de sus aplicaciones.

### Estructura Escalable
La organización del código permite la convivencia aislada de diferentes implementaciones sin conflictos:

```text
src/
├── Bootstrap/
│   ├── v5_3_3/    # Implementación estable actual
│   └── v6_0_0/    # (Futuro) Soporte para nuevas versiones sin romper compatibilidad
├── Tailwind/      # (Futuro) Posible implementación de otros frameworks
│   └── v3/
└── Frontend.php   # Factory principal de orquestación
```

### Patrón Factory Inteligente
La clase `Higgs\Frontend\Frontend` actúa como una fábrica centralizada. Su arquitectura interna está preparada para instanciar dinámicamente el `Builder` correcto según las necesidades del proyecto:

```php
// Uso estándar actual
$bootstrap = new \Higgs\Frontend\Frontend('bootstrap', '5.3.3');

// Capacidad futura (Soportada por diseño)
// $tailwind = new \Higgs\Frontend\Frontend('tailwind', '3.0');
```

Esto asegura que su inversión en desarrollo esté protegida contra cambios tecnológicos, permitiendo adoptar nuevos frameworks visuales en el futuro solo cambiando la configuración, manteniendo la misma API lógica en su código PHP.

## Instalación

El framework viene incluido en el sistema Higgs. No requiere instalación adicional.

## Uso Básico

### Inicialización

```php
// Obtener la instancia del Frontend
$frontend = new \Higgs\Frontend\Frontend();

// Obtener el builder de Bootstrap
$bootstrap = $frontend->get_Builder();
```

### Sintaxis Básica

Todos los métodos siguen un patrón similar:
- Primer argumento: contenido principal
- Argumentos opcionales: configuración específica del componente
- Último argumento: array de atributos HTML adicionales

## Componentes

### Alertas

```php
// Alerta básica
$bootstrap->alert('Este es un mensaje importante');

// Alerta con tipo
$bootstrap->alert('Operación exitosa', 'success');

// Alerta descartable
$bootstrap->alert('Puedes cerrar este mensaje', 'info', true);

// Alerta con atributos personalizados
$bootstrap->alert('Mensaje personalizado', 'warning', false, ['id' => 'mi-alerta']);
```

### Tarjetas

```php
// Tarjeta básica
$bootstrap->card('Título', 'Contenido');

// Tarjeta completa
$bootstrap->card(
    'Título de la Tarjeta',
    'Contenido de la tarjeta',
    'Pie de la tarjeta',
    'ruta/imagen.jpg'
);

// Tarjeta horizontal
$bootstrap->horizontalCard(
    'ruta/imagen.jpg',
    'Título',
    'Contenido'
);
```

### Botones

```php
// Botón básico
$bootstrap->button('Clic Aquí');

// Botón con variante
$bootstrap->button('Guardar', 'success');

// Botón con atributos
$bootstrap->button('Enviar', 'primary', ['type' => 'submit']);

// Grupo de botones
$bootstrap->buttonGroup([
    $bootstrap->button('Izquierda'),
    $bootstrap->button('Centro'),
    $bootstrap->button('Derecha')
]);
```

### Sistema de Grid

```php
// Contenedor
$bootstrap->container(
    $bootstrap->row(
        $bootstrap->col('Columna 1', 'col-md-6') .
        $bootstrap->col('Columna 2', 'col-md-6')
    )
);

// Contenedor fluido
$bootstrap->container('Contenido', true);
```

### Navegación

```php
// Barra de navegación básica
$bootstrap->navbar(
    'Mi Sitio',
    [
        ['texto' => 'Inicio', 'url' => '/'],
        ['texto' => 'Acerca', 'url' => '/acerca'],
        ['texto' => 'Contacto', 'url' => '/contacto']
    ]
);

// Migas de pan
$bootstrap->breadcrumb([
    ['texto' => 'Inicio', 'url' => '/'],
    ['texto' => 'Categoría', 'url' => '/categoria'],
    ['texto' => 'Página Actual']
]);
```

### Formularios

```php
// Campo de texto
$bootstrap->formControl('texto', [
    'label' => 'Nombre',
    'placeholder' => 'Ingrese su nombre'
]);

// Grupo de entrada
$bootstrap->inputGroup(
    $bootstrap->formControl('texto'),
    '@',
    'after'
);

// Checkbox
// Checkbox
$bootstrap->check('Acepto los términos', 'terminos', true);

// Select
$bootstrap->select('pais', [
    'MX' => 'México',
    'CO' => 'Colombia',
    'ES' => 'España'
], ['label' => 'Seleccione su país']);

// Radio
$bootstrap->radio('genero', ['label' => 'Masculino', 'value' => 'm']);
$bootstrap->radio('genero', ['label' => 'Femenino', 'value' => 'f']);

// Textarea
$bootstrap->textarea('mensaje', ['rows' => 3, 'placeholder' => 'Escribe tu mensaje...']);

// File Input
$bootstrap->file('documento', ['accept' => '.pdf']);
```

### Elementos de Interfaz

```php
// Collapse
echo $bootstrap->button('Mostrar/Ocultar', 'primary', [
    'data-bs-toggle' => 'collapse',
    'data-bs-target' => '#miCollapse'
]);

echo $bootstrap->collapse('miCollapse', 'Contenido colapsable...');

// Figure (Imagen con leyenda)
echo $bootstrap->figure('imagen.jpg', 'Descripción de la imagen');
```

## Ejemplos

### Página de Login

```php
echo $bootstrap->container(
    $bootstrap->row(
        $bootstrap->col(
            $bootstrap->card(
                'Iniciar Sesión',
                $bootstrap->formControl('email', [
                    'label' => 'Correo Electrónico',
                    'required' => true
                ]) .
                $bootstrap->formControl('password', [
                    'label' => 'Contraseña',
                    'required' => true
                ]) .
                $bootstrap->button('Ingresar', 'primary', ['type' => 'submit']),
                null,
                null,
                ['class' => 'mt-5']
            ),
            'col-md-6 offset-md-3'
        )
    )
);
```

### Panel de Administración

```php
echo $bootstrap->container(
    $bootstrap->row(
        // Barra lateral
        $bootstrap->col(
            $bootstrap->listGroup([
                ['texto' => 'Dashboard', 'url' => '/admin'],
                ['texto' => 'Usuarios', 'url' => '/admin/usuarios'],
                ['texto' => 'Configuración', 'url' => '/admin/config']
            ]),
            'col-md-3'
        ) .
        // Contenido principal
        $bootstrap->col(
            $bootstrap->card(
                'Dashboard',
                $bootstrap->alert('¡Bienvenido al panel de administración!', 'info')
            ),
            'col-md-9'
        )
    )
);
```

### Modal de Factura Expirada

```php
// Crear el modal con mensaje de factura expirada
$modal = $bootstrap->modal(
    // Título del modal
    'Estado de Factura',
    // Contenido del modal
    $bootstrap->alert(
        'Esta factura ya ha expirado. Se está a la espera de su pago.',
        'warning',
        false
    ),
    // Pie del modal con botones
    $bootstrap->buttonGroup([
        $bootstrap->button('Cerrar', 'secondary', ['data-bs-dismiss' => 'modal']),
        $bootstrap->button('Ir a Pagar', 'primary')
    ]),
    // Opciones adicionales
    [
        'id' => 'facturaExpiradaModal',
        'centered' => true,
        'size' => 'md'
    ]
);

// Botón para abrir el modal
echo $bootstrap->button(
    'Ver Estado de Factura', 
    'danger',
    [
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#facturaExpiradaModal'
    ]
);

// Renderizar el modal
echo $modal;
```

El código anterior generará:
1. Un botón "Ver Estado de Factura" que al hacer clic abrirá el modal
2. Una ventana modal centrada con:
   - Título "Estado de Factura"
   - Mensaje de alerta en formato warning
   - Dos botones: uno para cerrar y otro para proceder al pago

## Notas Importantes

1. **Encadenamiento**: Todos los métodos retornan objetos que implementan `TagInterface`, permitiendo concatenarlos con el operador `.`.

2. **Atributos HTML**: Puedes pasar atributos HTML adicionales como último argumento en forma de array:
```php
['class' => 'mi-clase', 'id' => 'mi-id', 'data-bs-toggle' => 'tooltip']
```

3. **Validación**: El framework valida automáticamente:
   - Variantes de color (primary, secondary, success, etc.)
   - Tamaños (sm, lg, xl)
   - Posiciones (top, bottom, left, right)
   - Breakpoints (sm, md, lg, xl, xxl)

4. **Accesibilidad**: El framework agrega automáticamente:
   - Roles ARIA apropiados
   - Atributos aria-label cuando son necesarios
   - Atributos de navegación por teclado


   ---
   
   ## 🤝 Contribución
   
   Este proyecto es Open Source y vive gracias a la comunidad.
   1. Haz Fork del repositorio.
   2. Crea tu rama (`git checkout -b feature/AmazingFeature`).
   3. Asegúrate de ejecutar los tests (`composer test`).
   4. Haz Commit (`git commit -m 'Add: New global helper'`).
   5. Abre un Pull Request.
   
   ---
   
   ## 📜 Licencia
   
   Distribuido bajo la Licencia **MIT**. Ver [LICENSE](LICENSE) para más información.
   
   ---
   *Desarrollado con ❤️ para la comunidad PHP por José Alexis Correa Valencia.*
   
   ---
   
   ## 🤝 Soporte y Contribuciones
   
   ¡Damos la bienvenida a las contribuciones para mejorar Higgs Html!
   
   Si encuentras algún problema, por favor abre un issue en GitHub.
   
   ---
   
   ## 👨‍💻 Autor
   
   **Jose Alexis Correa Valencia**
   *Full Stack Developer & Software Architect*
   
   *   **GitHub**: [@jalexiscv](https://github.com/jalexiscv)
   *   **Email**: jalexiscv@gmail.com
   *   **Ubicación**: Colombia
   
   ---
   
   ## ❤️ Donaciones
   
   Si esta librería te ha ayudado a ti o a tu negocio, por favor considera hacer una pequeña donación para apoyar su desarrollo continuo y mantenimiento.
   
   | Método | Detalles |
   | :--- | :--- |
   | **PayPal** | [jalexiscv@gmail.com](https://www.paypal.com/paypalme/anssible) |
   | **Nequi (Colombia)** | `3117977281` |
   
   *¡Gracias por tu apoyo!*