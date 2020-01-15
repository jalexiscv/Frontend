# Higgs - FrontEnd Framework (FEF)

<div align="center">

**Una solución empresarial para la generación de interfaces de usuario en PHP**

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.0-777BB4?style=flat-square&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)
[![Version](https://img.shields.io/badge/Version-2.0.0-blue?style=flat-square)](CHANGELOG.md)

</div>

---

## 🎯 Génesis y Motivación

### El Problema que Nadie Estaba Resolviendo

Después de más de **25 años desarrollando aplicaciones PHP empresariales**, observé un patrón recurrente que se repetía proyecto tras proyecto: **el caos en el desarrollo frontend**.

Cada nuevo proyecto comenzaba con las mismas preguntas:
- ¿Escribimos HTML directo mezclado con PHP?
- ¿Usamos un template engine como Blade o Twig?
- ¿Cómo garantizamos consistencia visual entre módulos?
- ¿Quién es responsable de la accesibilidad?
- ¿Cómo evitamos vulnerabilidades XSS por descuido?

La respuesta tradicional era: **"depende del desarrollador"**. Y ahí radicaba el problema.

### La Deuda Técnica Invisible

En aplicaciones empresariales, la inconsistencia en la capa de presentación genera:

- **Deuda de mantenimiento**: Cada desarrollador escribe HTML de forma diferente
- **Vulnerabilidades de seguridad**: Olvidar escapar una variable puede comprometer toda la aplicación
- **Problemas de accesibilidad**: Los atributos ARIA se implementan de forma inconsistente o se olvidan
- **Duplicación de código**: Los mismos patrones de UI se reescriben una y otra vez
- **Dificultad de actualización**: Cambiar de Bootstrap 4 a 5 requiere reescribir miles de líneas

### La Revelación

> **"¿Y si pudiéramos tratar los componentes de UI como objetos de primera clase en PHP?"**

Esta pregunta dio origen al **Higgs - FrontEnd Framework (FEF)**. No se trata simplemente de generar HTML desde PHP (eso es trivial), sino de crear un **sistema de diseño codificado** que garantice:

1. **Consistencia arquitectónica** en cada componente
2. **Seguridad por diseño**, no por disciplina
3. **Accesibilidad automática**, no como tarea pendiente
4. **Abstracción del framework visual** para sobrevivir a sus ciclos de vida
5. **Experiencia de desarrollo fluida** que acelera la productividad

---

## 💡 El Problema que Resolvemos

### El Dilema del Desarrollo Frontend en PHP

El ecosistema PHP moderno ofrece múltiples enfoques para generar interfaces, pero todos tienen limitaciones fundamentales:

#### ❌ HTML Directo en PHP
```php
echo '<div class="alert alert-danger" role="alert">Error</div>';
```
**Problemas**: 
- Sin escapado automático
- Propenso a errores tipográficos
- Sin validación de atributos
- Difícil de refactorizar

#### ❌ Template Engines (Blade, Twig)
```twig
<div class="alert alert-{{ type }}" role="alert">{{ message }}</div>
```
**Problemas**:
- Aún requiere conocimiento profundo del framework CSS
- No garantiza accesibilidad
- Cambiar de framework visual requiere reescribir templates
- No valida configuraciones incorrectas

#### ❌ Frontend Frameworks (React, Vue) con Server-Side Rendering
**Problemas**:
- Complejidad arquitectónica extrema
- Dependencia de Node.js
- Overhead de sincronización cliente-servidor
- Curva de aprendizaje pronunciada

### ✅ La Solución: Higgs - FrontEnd Framework (FEF)

Nosotros proponemos un **enfoque orientado a objetos** para componentes de UI:

```php
// Simple, seguro, consistente
echo $bootstrap->alert('Operación exitosa', 'success');

// Genera HTML válido, accesible y escapado
// <div class="alert alert-success" role="alert">Operación exitosa</div>
```

**Beneficios**:
- ✅ **Escapado automático** de contenido y atributos
- ✅ **Validación de parámetros** en tiempo de desarrollo
- ✅ **Accesibilidad integrada** (roles ARIA automáticos)
- ✅ **Abstracción del framework** (migra de Bootstrap 5→6 sin cambiar tu código)
- ✅ **Autocompletado IDE** con tipado estricto
- ✅ **Mantenibilidad** a largo plazo

---

## 🏗️ Filosofía de Diseño

Higgs - FrontEnd Framework (FEF) se construye sobre cinco pilares fundamentales:

### 1. 🎯 **Código como Contrato**

Cada componente es un **contrato explícito** entre el desarrollador y el framework visual. Si compilas, funciona. Si el IDE autocompleta, es válido.

```php
// El IDE te sugiere solo variantes válidas: 'primary', 'success', 'danger'...
$bootstrap->button('Guardar', 'success');  // ✅ Válido
$bootstrap->button('Guardar', 'verde');    // ❌ Falla en desarrollo, no en producción
```

### 2. 🔒 **Seguridad por Defecto**

> **"La seguridad no debería ser una opción, sino el comportamiento predeterminado"**

Todo contenido y atributo se escapa automáticamente. No puedes olvidarlo porque no es tu responsabilidad.

```php
$userInput = "<script>alert('XSS')</script>";
echo $bootstrap->alert($userInput); 
// Genera: &lt;script&gt;alert('XSS')&lt;/script&gt; (seguro)
```

### 3. ♿ **Accesibilidad sin Esfuerzo**

Los atributos ARIA, roles y mejores prácticas de accesibilidad se implementan automáticamente:

```php
echo $bootstrap->modal('Título', 'Contenido');
// Genera automáticamente: role="dialog", aria-labelledby, aria-hidden, etc.
```

### 4. 🔄 **Abstracción del Framework Visual**

Los frameworks CSS evolucionan, se deprecan, cambian. Tu código de negocio **no debería cambiar** cuando migras de Bootstrap 5 a 6.

```php
// Este código funciona con Bootstrap 5.3.3 hoy
$bootstrap = $frontend->get_Builder();
echo $bootstrap->button('Acción');

// Y funcionará mañana con Bootstrap 6.0.0 sin modificaciones
// Solo cambia la configuración del factory
```

### 5. 🚀 **Experiencia de Desarrollo Premium**

Desarrollar debe ser placentero. Nuestro API fluida, autocompletado inteligente y mensajes de error claros lo garantizan:

```php
echo $bootstrap->card(
    'Título',
    'Contenido',
    'Footer',
    'imagen.jpg'
); // Una línea, componente completo
```

---

## 🌐 Arquitectura Multi-Framework

### Visión Estratégica

Higgs - FrontEnd Framework (FEF) **no es una librería de Bootstrap**. Es un **sistema de abstracción de UI** que _actualmente_ soporta Bootstrap 5.3.3, pero está arquitectado para evolucionar con el ecosistema.

#### Diseño Escalable

```text
src/
├── Frontend.php          # Factory agnóstico (orquestador)
├── Builder.php           # Interfaz común para todos los frameworks
└── Bootstrap/
    ├── v5_3_3/          # ✅ Implementación actual (estable)
    ├── v6_0_0/          # 🔜 Próxima versión (Q2 2025)
    └── v6_1_0/          # 📅 Planificado (Q4 2025)
└── Tailwind/            # 🎯 Roadmap (2026)
    └── v3/
└── Material/            # 💡 Considerado
    └── v3/
```

### Estrategia de Migración Sin Dolor

Imagina este escenario real: Bootstrap lanza la versión 6.0 con cambios incompatibles. Con Higgs - FrontEnd Framework (FEF):

```php
// Tu código de aplicación (NO CAMBIA)
$btn = $bootstrap->button('Guardar', 'primary');

// Solo cambia la configuración (UN ARCHIVO)
// Antes: new Frontend('bootstrap', '5.3.3');
// Después: new Frontend('bootstrap', '6.0.0');
```

Todos tus componentes se actualizan automáticamente. **Cero deuda técnica.**

### Garantía de Compatibilidad

Nos comprometemos a:
- ✅ Mantener compatibilidad hacia atrás en la API pública
- ✅ Períodos de deprecación de mínimo 12 meses
- ✅ Guías de migración detalladas
- ✅ Coexistencia de múltiples versiones (transiciones graduales)

---

## 📖 Introducción Técnica

Higgs - FrontEnd Framework (FEF) es una **solución empresarial de código abierto** para la generación programática de interfaces de usuario en aplicaciones PHP modernas.

### Para Quién es Este Proyecto

Este framework está diseñado para:

- **Arquitectos de Software** que buscan estandarizar la capa de presentación en equipos grandes
- **Desarrolladores Backend** que necesitan generar UI sin ser expertos en frameworks CSS
- **Equipos Empresariales** que requieren mantenibilidad a largo plazo (5-10 años)
- **Proyectos Legacy** que necesitan modernizarse sin reescribir todo desde cero
- **Desarrolladores del Ecosistema Higgs** que desean integración nativa

### Qué NO es Este Proyecto

- ❌ Un framework CSS (usamos Bootstrap, Tailwind, etc.)
- ❌ Un template engine (generamos HTML, no renderizamos templates)
- ❌ Un framework frontend completo (no reemplaza React/Vue)
- ❌ Una solución para SPAs interactivas

### Propuesta de Valor

| Aspecto | Sin Higgs - FrontEnd Framework (FEF) | Con Higgs - FrontEnd Framework (FEF) |
|---------|----------------------|----------------------|
| **Tiempo de desarrollo** | 100% | **60-70%** ⚡ |
| **Bugs de XSS** | Alto riesgo | **Cero** (escapado automático) 🔒 |
| **Consistencia visual** | Variable | **100%** (sistema de diseño) 🎨 |
| **Accesibilidad** | Inconsistente | **Automática** (ARIA integrado) ♿ |
| **Mantenibilidad** | Deuda técnica creciente | **Sostenible** (refactoring seguro) 🔧 |
| **Curva de aprendizaje** | Alta (framework CSS) | **Baja** (API intuitiva) 📚 |

---

## 📋 Requisitos y Dependencias

### Requisitos del Sistema

- **PHP**: >= 8.0
- **Extensiones PHP**: Ninguna adicional requerida

### Dependencia Crítica: Librería Html

> [!IMPORTANT]
> **Higgs - FrontEnd Framework (FEF) depende completamente de la librería [Higgs Html](https://github.com/jalexiscv/Html)** para generar el HTML de los componentes.

La librería **Html** es el motor de renderizado que:
- Genera los elementos HTML con escapado automático
- Maneja atributos y clases de forma segura
- Proporciona la interfaz `TagInterface` que todos los componentes usan
- Garantiza la salida HTML válida y accesible

**Sin la librería Html, Higgs - FrontEnd Framework (FEF) NO funcionará**.

### Arquitectura de Dependencias

```text
Tu Aplicación
    ↓
    ↓ usa
    ↓
Higgs - FrontEnd Framework (FEF) (esta librería)
    ↓
    ↓ depende de
    ↓
Html (https://github.com/jalexiscv/Html)
    ↓
    ↓ genera
    ↓
HTML Final
```

---

## 📦 Instalación

> [!WARNING]
> Antes de instalar Higgs - FrontEnd Framework (FEF), **debes tener instalada la librería Html**. Las instrucciones a continuación incluyen ambas librerías.

Higgs - FrontEnd Framework (FEF) soporta dos métodos de instalación para máxima flexibilidad:

### Método 1: Vía Composer (Recomendado para Proyectos Modernos)

#### Paso 1: Instalar la librería Html

```bash
composer require higgs/html
```

#### Paso 2: Instalar Higgs - FrontEnd Framework (FEF)

```bash
composer require higgs/frontend
```

> **📝 Nota**: En futuras versiones, la dependencia de Html se declarará automáticamente en `composer.json` y se instalará como dependencia transitiva.

#### Uso:

```php
<?php
require_once 'vendor/autoload.php';

$frontend = new \Higgs\Frontend\Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();
```

**Cuándo usar**: Proyectos nuevos, aplicaciones con gestión de dependencias establecida.

### Método 2: Instalación Manual (Legacy/Standalone)

#### Paso 1: Clonar la librería Html

```bash
cd /ruta/a/tu/proyecto
git clone https://github.com/jalexiscv/Html.git Html
```

#### Paso 2: Clonar Higgs - FrontEnd Framework (FEF)

```bash
git clone https://github.com/jalexiscv/Frontend.git Frontend
```

#### Estructura esperada:

```text
tu-proyecto/
├── Html/              ← Librería Html
│   ├── src/
│   └── autoload.php
├── Frontend/          ← Higgs - FrontEnd Framework (FEF)
│   ├── src/
│   └── autoload.php
└── tu-aplicacion.php
```

#### Uso:

```php
<?php
// El autoload de Frontend cargará automáticamente Html si está en ../Html/
require_once 'Frontend/autoload.php';

$frontend = new \Higgs\Frontend\Frontend('bootstrap', '5.3.3');
$bootstrap = $frontend->get_Builder();
```

**Cuándo usar**: Proyectos legacy, entornos sin Composer, integraciones simples.

> **💡 Tip**: El `autoload.php` de Higgs - FrontEnd Framework (FEF) tiene un fallback inteligente que busca la librería Html en `../Html/src/`. Si tu estructura es diferente, ajusta el autoload o usa rutas absolutas.

> **💡 Nota**: El autoloader manual implementa un fallback inteligente que detecta automáticamente si Composer está disponible o carga las clases manualmente usando PSR-4.

---

## 🎓 Uso Básico

### Inicialización

```php
// 1. Obtener la instancia del Factory
$frontend = new \Higgs\Frontend\Frontend();

// 2. Obtener el Builder específico (Bootstrap 5.3.3 por defecto)
$bootstrap = $frontend->get_Builder();
```

### Sintaxis Básica

Todos los componentes siguen un patrón consistente y predecible:

```php
$componente = $bootstrap->metodo(
    $contenido,        // string: Contenido principal del componente
    $configuracion,    // mixed: Opciones específicas (tipo, tamaño, etc.)
    $atributos         // array: Atributos HTML adicionales ['id' => 'valor']
);
```

### Ejemplo Completo: Formulario de Login

```php
<?php
require_once 'vendor/autoload.php';

$frontend = new \Higgs\Frontend\Frontend();
$bootstrap = $frontend->get_Builder();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    echo $bootstrap->container(
        $bootstrap->row(
            $bootstrap->col(
                $bootstrap->card(
                    'Iniciar Sesión',
                    $bootstrap->formControl('email', [
                        'label' => 'Correo Electrónico',
                        'placeholder' => 'usuario@ejemplo.com',
                        'required' => true
                    ]) .
                    $bootstrap->formControl('password', [
                        'label' => 'Contraseña',
                        'required' => true
                    ]) .
                    $bootstrap->button('Ingresar', 'primary', [
                        'type' => 'submit',
                        'class' => 'w-100 mt-3'
                    ])
                ),
                'col-md-6 offset-md-3'
            )
        )
    );
    ?>
</body>
</html>
```

**Resultado**: Formulario de login completamente funcional, responsive, accesible y seguro en menos de 30 líneas.

---

## 🧩 Componentes Disponibles

Higgs - FrontEnd Framework (FEF) organiza los componentes en **5 categorías funcionales**:

### 📐 Layout (Estructura)

Componentes para crear la estructura base de tu aplicación:

| Componente | Método | Descripción |
|------------|--------|-------------|
| **Container** | `container($contenido, $fluid)` | Contenedor principal responsive |
| **Row** | `row($contenido, $atributos)` | Fila del sistema de grid |
| **Column** | `col($contenido, $clases, $atributos)` | Columna responsive |
| **Grid** | `grid($filas, $atributos)` | Sistema de grid completo |

```php
// Layout responsive de 2 columnas
echo $bootstrap->container(
    $bootstrap->row(
        $bootstrap->col('Columna 1', 'col-md-6') .
        $bootstrap->col('Columna 2', 'col-md-6')
    )
);
```

### 📝 Formularios (Form)

Componentes para captura de datos con validación integrada:

| Componente | Método | Descripción |
|------------|--------|-------------|
| **Input** | `formControl($tipo, $opciones)` | Campo de entrada (text, email, password, etc.) |
| **Select** | `select($nombre, $opciones, $config)` | Lista desplegable |
| **Checkbox** | `check($label, $nombre, $value, $opciones)` | Casilla de verificación |
| **Radio** | `radio($nombre, $opciones)` | Botón de opción |
| **Textarea** | `textarea($nombre, $opciones)` | Área de texto multilínea |
| **File** | `file($nombre, $opciones)` | Carga de archivos |
| **Input Group** | `inputGroup($input, $addon, $posicion)` | Input con complementos |
| **Range** | `range($nombre, $opciones)` | Control deslizante |
| **Switch** | `switch($label, $nombre, $opciones)` | Interruptor on/off |

```php
// Select con validación
echo $bootstrap->select('pais', [
    'MX' => 'México',
    'CO' => 'Colombia',
    'ES' => 'España'
], [
    'label' => 'Seleccione su país',
    'required' => true,
    'class' => 'form-select-lg'
]);

// Checkbox con estado por defecto
echo $bootstrap->check('Acepto términos y condiciones', 'terminos', true);
```

### 🧭 Navegación (Navigation)

Componentes para navegación y jerarquía:

| Componente | Método | Descripción |
|------------|--------|-------------|
| **Navbar** | `navbar($brand, $items, $opciones)` | Barra de navegación principal |
| **Breadcrumb** | `breadcrumb($items, $atributos)` | Migas de pan |
| **Nav** | `nav($items, $tipo, $atributos)` | Navegación genérica |
| **Tabs** | `tabs($items, $atributos)` | Pestañas de navegación |

```php
// Navbar responsive con dropdown
echo $bootstrap->navbar(
    'Mi Aplicación',
    [
        ['texto' => 'Inicio', 'url' => '/', 'activo' => true],
        ['texto' => 'Productos', 'url' => '/productos'],
        ['texto' => 'Contacto', 'url' => '/contacto']
    ],
    ['fixed' => 'top', 'theme' => 'dark']
);

// Breadcrumb
echo $bootstrap->breadcrumb([
    ['texto' => 'Inicio', 'url' => '/'],
    ['texto' => 'Productos', 'url' => '/productos'],
    ['texto' => 'Detalles'] // Sin URL = página actual
]);
```

### 📦 Contenido (Content)

Componentes para presentar información:

| Componente | Método | Descripción |
|------------|--------|-------------|
| **Card** | `card($titulo, $contenido, $footer, $imagen)` | Tarjeta de contenido |
| **Horizontal Card** | `horizontalCard($imagen, $titulo, $contenido)` | Tarjeta horizontal |
| **Figure** | `figure($imagen, $caption, $atributos)` | Imagen con leyenda |
| **List Group** | `listGroup($items, $atributos)` | Lista de elementos |

```php
// Tarjeta simple (sintaxis compacta)
echo $bootstrap->card(
    'Producto Destacado',
    '<p>Descripción del producto con todas sus características.</p>',
    '$99.99 - <a href="/comprar">Comprar ahora</a>',
    '/img/producto.jpg'
);

// Tarjeta con content como array de configuración (control completo del body)
echo $bootstrap->card([
    'header' => [
        'title' => 'Acceso Denegado',
        'class' => 'bg-danger text-white'
    ],
    'content' => [
        'htmlContent' => '<i class="fas fa-ban"></i><p class="mt-2">No tienes permiso para acceder</p>',
        'class' => 'text-center py-4',
        'attributes' => ['data-role' => 'error']
    ],
    'footer' => [
        'content' => '<a href="/" class="btn btn-primary">Volver al inicio</a>',
        'class' => 'd-flex justify-content-end'
    ],
    'attributes' => ['class' => 'border-danger shadow-sm']
]);

// List Group interactivo
echo $bootstrap->listGroup([
    ['texto' => 'Dashboard', 'url' => '/admin', 'activo' => true],
    ['texto' => 'Usuarios', 'url' => '/admin/usuarios'],
    ['texto' => 'Reportes', 'url' => '/admin/reportes']
]);
```

### 🎨 Interfaz (Interface)

Componentes de interacción y feedback:

| Componente | Método | Descripción |
|------------|--------|-------------|
| **Alert** | `alert($mensaje, $tipo, $descartable)` | Mensaje de alerta |
| **Modal** | `modal($titulo, $contenido, $footer, $opciones)` | Ventana modal |
| **Button** | `button($texto, $variante, $atributos)` | Botón de acción |
| **Button Group** | `buttonGroup($botones, $atributos)` | Grupo de botones |
| **Badge** | `badge($texto, $variante, $atributos)` | Insignia/etiqueta |
| **Spinner** | `spinner($tipo, $atributos)` | Indicador de carga |
| **Toast** | `toast($titulo, $mensaje, $opciones)` | Notificación temporal |
| **Tooltip** | `tooltip($elemento, $texto)` | Texto emergente |
| **Popover** | `popover($elemento, $titulo, $contenido)` | Ventana emergente |
| **Collapse** | `collapse($id, $contenido, $atributos)` | Contenido colapsable |
| **Accordion** | `accordion($items, $atributos)` | Acordeón de contenido |
| **Progress** | `progress($porcentaje, $opciones)` | Barra de progreso |
| **Pagination** | `pagination($paginas, $actual, $opciones)` | Paginación |
| **Dropdown** | `dropdown($texto, $items, $opciones)` | Menú desplegable |

```php
// Alert descartable
echo $bootstrap->alert(
    '¡Operación completada exitosamente!',
    'success',
    true
);

// Modal con confirmación
echo $bootstrap->modal(
    '¿Confirmar eliminación?',
    '<p>Esta acción no se puede deshacer.</p>',
    $bootstrap->buttonGroup([
        $bootstrap->button('Cancelar', 'secondary', ['data-bs-dismiss' => 'modal']),
        $bootstrap->button('Eliminar', 'danger')
    ]),
    ['id' => 'confirmModal', 'centered' => true]
);

// Badge dinámico
echo $bootstrap->badge('Nuevo', 'danger');

// Progress bar animada
echo $bootstrap->progress(75, [
    'striped' => true,
    'animated' => true,
    'variant' => 'success'
]);
```

### 📚 Documentación Detallada de Componentes

Cada componente cuenta con documentación individualizada con ejemplos completos, casos de uso y mejores prácticas:

#### 📱 [→ Ver Documentación Completa de Bootstrap 5.3.3](src/Bootstrap/v5_3_3/Bootstrap.md)

**Componentes documentados por categoría:**

- **🎨 Interface (18 componentes)**: [Alert](src/Bootstrap/v5_3_3/Docs/components/interface/Alert.md) · [Accordion](src/Bootstrap/v5_3_3/Docs/components/interface/Accordion.md) · [Badge](src/Bootstrap/v5_3_3/Docs/components/interface/Badge.md) · [Button](src/Bootstrap/v5_3_3/Docs/components/interface/Button.md) · [ButtonGroup](src/Bootstrap/v5_3_3/Docs/components/interface/ButtonGroup.md) · [Card](src/Bootstrap/v5_3_3/Docs/components/interface/Card.md) · [CardGroup](src/Bootstrap/v5_3_3/Docs/components/interface/CardGroup.md) · [Carousel](src/Bootstrap/v5_3_3/Docs/components/interface/Carousel.md) · [Collapse](src/Bootstrap/v5_3_3/Docs/components/interface/Collapse.md) · [Dropdown](src/Bootstrap/v5_3_3/Docs/components/interface/Dropdown.md) · [ListGroup](src/Bootstrap/v5_3_3/Docs/components/interface/ListGroup.md) · [Modal](src/Bootstrap/v5_3_3/Docs/components/interface/Modal.md) · [Offcanvas](src/Bootstrap/v5_3_3/Docs/components/interface/Offcanvas.md) · [Popover](src/Bootstrap/v5_3_3/Docs/components/interface/Popover.md) · [Progress](src/Bootstrap/v5_3_3/Docs/components/interface/Progress.md) · [Spinner](src/Bootstrap/v5_3_3/Docs/components/interface/Spinner.md) · [Toast](src/Bootstrap/v5_3_3/Docs/components/interface/Toast.md) · [Tooltip](src/Bootstrap/v5_3_3/Docs/components/interface/Tooltip.md)

- **📝 Form (9 componentes)**: [Check](src/Bootstrap/v5_3_3/Docs/components/form/Check.md) · [File](src/Bootstrap/v5_3_3/Docs/components/form/File.md) · [Form](src/Bootstrap/v5_3_3/Docs/components/form/Form.md) · [FormControl](src/Bootstrap/v5_3_3/Docs/components/form/FormControl.md) · [Input](src/Bootstrap/v5_3_3/Docs/components/form/Input.md) · [InputGroup](src/Bootstrap/v5_3_3/Docs/components/form/InputGroup.md) · [Radio](src/Bootstrap/v5_3_3/Docs/components/form/Radio.md) · [Select](src/Bootstrap/v5_3_3/Docs/components/form/Select.md) · [Textarea](src/Bootstrap/v5_3_3/Docs/components/form/Textarea.md)

- **🧭 Navigation (4 componentes)**: [Breadcrumb](src/Bootstrap/v5_3_3/Docs/components/navigation/Breadcrumb.md) · [Nav](src/Bootstrap/v5_3_3/Docs/components/navigation/Nav.md) · [Navbar](src/Bootstrap/v5_3_3/Docs/components/navigation/Navbar.md) · [Pagination](src/Bootstrap/v5_3_3/Docs/components/navigation/Pagination.md)

- **📐 Layout (4 componentes)**: [Col](src/Bootstrap/v5_3_3/Docs/components/layout/Col.md) · [Container](src/Bootstrap/v5_3_3/Docs/components/layout/Container.md) · [Grid](src/Bootstrap/v5_3_3/Docs/components/layout/Grid.md) · [Row](src/Bootstrap/v5_3_3/Docs/components/layout/Row.md)

- **📄 Content (4 componentes)**: [Fig ure](src/Bootstrap/v5_3_3/Docs/components/content/Figure.md) · [Image](src/Bootstrap/v5_3_3/Docs/components/content/Image.md) · [Table](src/Bootstrap/v5_3_3/Docs/components/content/Table.md) · [Typography](src/Bootstrap/v5_3_3/Docs/components/content/Typography.md)

**Cada documentación incluye:**
- ✅ Descripción detallada del componente
- ✅ Tabla completa de opciones de configuración con tipos y defaults
- ✅ Ejemplos básicos para inicio rápido
- ✅ Ejemplos avanzados con casos complejos
- ✅ Casos de uso empresariales reales
- ✅ Enlaces a componentes relacionados para navegación fácil
- ✅ Referencias a documentación oficial de Bootstrap

---

## 💼 Casos de Uso Empresariales

### 1. Sistema Administrativo Multi-Tenant

**Contexto**: Aplicación SaaS con múltiples clientes, cada uno con su propia configuración visual.

**Solución**:
```php
// Configuración dinámica por tenant
$theme = $tenant->getTheme(); // 'bootstrap', 'material', etc.
$version = $tenant->getVersion(); // '5.3.3', '6.0.0', etc.

$frontend = new Frontend($theme, $version);
$builder = $frontend->get_Builder();

// El resto del código es idéntico para todos los tenants
echo $builder->dashboard($widgets);
```

**Beneficio**: Un solo código base, múltiples temas visuales sin duplicación.

### 2. Migración de Aplicación Legacy

**Contexto**: Sistema PHP de 10 años con HTML directo mezclado con lógica.

**Estrategia de Migración Gradual**:
```php
// Paso 1: Reemplazar componentes críticos (formularios)
// Antes:
echo '<form class="form-horizontal">...</form>';

// Después:
echo $bootstrap->form($fields);

// Paso 2: Migrar módulo por módulo
// Paso 3: Actualizar a Bootstrap 6 cambiando UNA línea de configuración
```

**Beneficio Medible**: 
- 40% menos código
- 0 vulnerabilidades XSS introducidas
- 100% accesibilidad en nuevos módulos

### 3. Prototipado Rápido de Dashboards

**Contexto**: Startup necesita validar 5 diseños de dashboard en 1 semana.

```php
foreach ($dashboardVariants as $variant) {
    echo $bootstrap->container(
        $bootstrap->row([
            $bootstrap->col($variant->getMetrics(), 'col-md-3'),
            $bootstrap->col($variant->getChart(), 'col-md-9')
        ])
    );
}
```

**Beneficio**: Prototipado 3x más rápido que escribiendo HTML directo.

### 4. Aplicación Multi-Idioma con Accesibilidad

**Contexto**: Plataforma gubernamental que requiere WCAG 2.1 AA compliance.

```php
// Los atributos ARIA se generan automáticamente en el idioma configurado
setlocale(LC_ALL, 'es_ES');
echo $bootstrap->modal(
    __('Confirmación'),
    __('¿Está seguro?')
); 
// Genera: aria-label="Confirmación", role="dialog", etc.
```

**Beneficio**: Cumplimiento automático de estándares de accesibilidad.

---

## 📊 Comparación con Alternativas

| Aspecto | HTML Directo | Template Engine | Frontend Frameworks | **Higgs - FrontEnd Framework (FEF)** |
|---------|-------------|-----------------|---------------------|---------------------|
| **Curva de aprendizaje** | Baja | Media | Alta | **Baja** ✅ |
| **Escapado automático** | ❌ Manual | ⚠️ Parcial | ✅ Sí | **✅ Total** |
| **Validación en desarrollo** | ❌ No | ❌ No | ✅ TypeScript | **✅ PHP Strict** |
| **Accesibilidad** | ❌ Manual | ❌ Manual | ⚠️ Variable | **✅ Automática** |
| **Abstracción framework CSS** | ❌ No | ❌ No | ❌ No | **✅ Total** |
| **Refactoring seguro** | ❌ Arriesgado | ⚠️ Medio | ✅ Sí | **✅ Garantizado** |
| **Overhead de rendimiento** | Ninguno | Bajo | Alto (SSR) | **Mínimo** |
| **Autocompletado IDE** | ❌ No | ⚠️ Limitado | ✅ Excelente | **✅ Completo** |
| **Ecosistema PHP** | ✅ Nativo | ✅ Nativo | ❌ Híbrido | **✅ 100% PHP** |

### ¿Por Qué No Solo Usar [Alternativa X]?

#### vs. HTML Directo
**HTML directo** es flexible pero peligroso. Cada desarrollador implementa de forma diferente, no hay garantías de seguridad ni accesibilidad.

#### vs. Blade/Twig
**Template engines** resuelven la separación de vistas, pero no abstraen el framework CSS. Migrar de Bootstrap a Tailwind requiere reescribir todos los templates.

#### vs. React/Vue SSR
**Frontend frameworks** son excelentes para aplicaciones interactivas (SPAs), pero agregan complejidad innecesaria para aplicaciones tradicionales PHP. Higgs - FrontEnd Framework (FEF) te da el 80% de los beneficios con el 20% de la complejidad.

---

## ⚡ Ventajas Competitivas

### 1. **Seguridad Sin Pensar**
No puedes olvidarte de escapar contenido porque no es tu responsabilidad. El framework lo hace automáticamente.

### 2. **Migraciones Sin Dolor**
Cuando Bootstrap 6 salga con cambios incompatibles, tu código no cambia. Solo actualizas la configuración del factory.

### 3. **Equipos Heterogéneos**
Desarrolladores backend pueden generar UI profesional sin ser expertos en CSS ni frameworks frontend.

### 4. **Tipado Estricto**
Errores en desarrollo, no en producción. El IDE te avisa si pasas un parámetro inválido.

### 5. **Ecosistema Integrado**
Diseñado específicamente para el ecosistema Higgs con integración nativa.

### 6. **Open Source con Expertise**
Código abierto respaldado por 25+ años de experiencia en desarrollo empresarial PHP.

---

## 🗺️ Roadmap

### ✅ Completado (v1.0.x)
- [x] Implementación completa de Bootstrap 5.3.3
- [x] 39+ componentes documentados
- [x] Sistema de autoloading híbrido
- [x] Documentación completa
- [x] Arquitectura multi-framework

### 🚀 Q1 2025 (v1.1.x)
- [ ] Suite de tests completa con PHPUnit
- [ ] Análisis estático con PHPStan (nivel 8)
- [ ] Integración continua (CI/CD)
- [ ] Documentación interactiva con ejemplos en vivo

### 🎯 Q2 2025 (v1.2.x)
- [ ] Soporte para Bootstrap 6.0.0
- [ ] Coexistencia de múltiples versiones
- [ ] Guía de migración automatizada
- [ ] Generador de componentes personalizados

### 💡 Q3-Q4 2025 (v2.0.x)
- [ ] Implementación de Tailwind CSS 3.x
- [ ] Implementación de Material Design 3
- [ ] Plugin para Laravel
- [ ] Plugin para Symfony

### 🔮 2026 y más allá
- [ ] Generador visual de interfaces (GUI Builder)
- [ ] Marketplace de componentes comunitarios
- [ ] Soporte para Web Components estándar
- [ ] API de tematización avanzada

---

## 🎨 Ejemplos Avanzados

### Dashboard Empresarial Completo

```php
<?php
$frontend = new \Higgs\Frontend\Frontend();
$bootstrap = $frontend->get_Builder();

// Métricas principales
$metricas = $bootstrap->row([
    $bootstrap->col(
        $bootstrap->card('Usuarios', '1,234', null, null, ['class' => 'text-center']),
        'col-md-3'
    ),
    $bootstrap->col(
        $bootstrap->card('Ventas', '$45,678', null, null, ['class' => 'text-center']),
        'col-md-3'
    ),
    $bootstrap->col(
        $bootstrap->card('Conversión', '3.2%', null, null, ['class' => 'text-center']),
        'col-md-3'
    ),
    $bootstrap->col(
        $bootstrap->card('Satisfacción', '4.8/5', null, null, ['class' => 'text-center']),
        'col-md-3'
    )
]);

// Tabla de datos con paginación
$tabla = $bootstrap->card(
    'Últimas Transacciones',
    '<table class="table">...</table>' .
    $bootstrap->pagination(10, 3)
);

// Layout final
echo $bootstrap->container(
    $metricas .
    $bootstrap->row(
        $bootstrap->col($tabla, 'col-12')
    )
);
?>
```

### Sistema de Notificaciones

```php
// Toast de notificación
echo $bootstrap->toast(
    'Nuevo Mensaje',
    'Tienes 3 mensajes sin leer',
    [
        'autohide' => true,
        'delay' => 5000,
        'position' => 'top-end'
    ]
);

// Modal de confirmación
echo $bootstrap->modal(
    'Confirmar Acción',
    $bootstrap->alert('Esta acción es irreversible', 'warning') .
    '<p>¿Está seguro de continuar?</p>',
    $bootstrap->buttonGroup([
        $bootstrap->button('Cancelar', 'secondary', ['data-bs-dismiss' => 'modal']),
        $bootstrap->button('Confirmar', 'danger', ['id' => 'btnConfirm'])
    ]),
    ['id' => 'confirmModal', 'centered' => true, 'backdrop' => 'static']
);
```

### Formulario Multi-Paso

```php
// Paso 1: Información Personal
$paso1 = $bootstrap->card(
    'Paso 1: Información Personal',
    $bootstrap->formControl('text', ['label' => 'Nombre completo', 'required' => true]) .
    $bootstrap->formControl('email', ['label' => 'Correo', 'required' => true]) .
    $bootstrap->button('Siguiente →', 'primary')
);

// Paso 2: Dirección
$paso2 = $bootstrap->card(
    'Paso 2: Dirección',
    $bootstrap->formControl('text', ['label' => 'Calle', 'required' => true]) .
    $bootstrap->select('pais', $paises, ['label' => 'País']) .
    $bootstrap->buttonGroup([
        $bootstrap->button('← Anterior', 'secondary'),
        $bootstrap->button('Siguiente →', 'primary')
    ])
);

// Tabs para navegación
echo $bootstrap->tabs([
    ['texto' => 'Personal', 'contenido' => $paso1, 'activo' => true],
    ['texto' => 'Dirección', 'contenido' => $paso2],
    ['texto' => 'Confirmación', 'contenido' => $paso3]
]);
```

---

## 🔧 Notas Técnicas Importantes

### 1. Encadenamiento de Componentes

Todos los métodos retornan strings de HTML, permitiendo concatenación natural:

```php
$contenido = $bootstrap->alert('Mensaje 1') . 
             $bootstrap->alert('Mensaje 2') .
             $bootstrap->button('Acción');
```

### 2. Atributos HTML Personalizados

El último argumento siempre acepta atributos HTML adicionales:

```php
$bootstrap->button('Clic', 'primary', [
    'id' => 'btnAction',
    'class' => 'mi-clase-custom', // Se fusiona con clases Bootstrap
    'data-bs-toggle' => 'modal',
    'data-target' => '#miModal',
    'onclick' => 'miFuncion()'
]);
```

### 3. Validación Automática

El framework valida parámetros en desarrollo:

- **Variantes**: `primary`, `secondary`, `success`, `danger`, `warning`, `info`, `light`, `dark`
- **Tamaños**: `sm`, `md` (default), `lg`, `xl`
- **Posiciones**: `top`, `bottom`, `left`, `right`, `start`, `end`
- **Breakpoints**: `sm`, `md`, `lg`, `xl`, `xxl`

```php
// ❌ Esto genera una excepción en desarrollo
$bootstrap->button('Texto', 'violeta'); // Variante inválida

// ✅ Esto funciona
$bootstrap->button('Texto', 'primary'); // Variante válida
```

### 4. Accesibilidad Integrada

Cada componente implementa automáticamente:

- **Roles ARIA** apropiados (`role="alert"`, `role="dialog"`, etc.)
- **Labels ARIA** (`aria-label`, `aria-labelledby`)
- **Estados ARIA** (`aria-hidden`, `aria-expanded`, etc.)
- **Navegación por teclado** (atributos `tabindex` cuando necesario)
- **Textos para lectores de pantalla** (elementos `.visually-hidden`)

```php
// Este código:
echo $bootstrap->modal('Título', 'Contenido');

// Genera automáticamente:
// role="dialog"
// aria-labelledby="modalLabel"
// aria-hidden="true"
// tabindex="-1"
```

### 5. Escapado de Contenido

**Importantísimo**: Todo contenido se escapa automáticamente excepto cuando se detecta HTML válido:

```php
$userInput = "<script>alert('XSS')</script>";
echo $bootstrap->alert($userInput); 
// ✅ Seguro: &lt;script&gt;alert('XSS')&lt;/script&gt;

$htmlSeguro = "<strong>Texto importante</strong>";
echo $bootstrap->alert($htmlSeguro);
// ✅ Seguro: <strong>Texto importante</strong> (HTML permitido)
```

---

## 🤝 Contribución

Este proyecto es **Open Source** y vive gracias a la comunidad. ¡Tus contribuciones son bienvenidas!

### Cómo Contribuir

1. **Fork** del repositorio
2. **Crea tu rama** de característica
   ```bash
   git checkout -b feature/nueva-funcionalidad
   ```
3. **Asegúrate de ejecutar los tests**
   ```bash
   composer test
   ```
4. **Haz commit de tus cambios**
   ```bash
   git commit -m 'Add: Nueva funcionalidad increíble'
   ```
5. **Push a tu rama**
   ```bash
   git push origin feature/nueva-funcionalidad
   ```
6. **Abre un Pull Request**

### Directrices de Contribución

- ✅ Sigue los estándares PSR-12
- ✅ Mantén el tipado estricto (`declare(strict_types=1)`)
- ✅ Documenta todas las funciones públicas
- ✅ Agrega tests para nuevas funcionalidades
- ✅ Actualiza la documentación relevante

### Áreas que Necesitan Ayuda

- 📝 Mejoras en documentación
- 🧪 Tests unitarios y de integración
- 🎨 Nuevos componentes de Bootstrap
- 🔧 Implementación de nuevos frameworks (Tailwind, Material)
- 🌍 Traducciones de documentación
- 🐛 Reportes de bugs

---

## 🤝 Soporte y Comunidad

### ¿Necesitas Ayuda?

- 📖 **Documentación**: Lee el [README completo](README.md) y [ARCHITECTURE.md](ARCHITECTURE.md)
- 🐛 **Reportar bugs**: Abre un [issue en GitHub](https://github.com/jalexiscv/Html/issues)
- 💡 **Solicitar funcionalidades**: Usa las [GitHub Discussions](https://github.com/jalexiscv/Html/discussions)
- 📧 **Contacto directo**: jalexiscv@gmail.com

### Comunidad

- **Discusiones**: Únete a las conversaciones en GitHub Discussions
- **Contribuciones**: Revisa los [issues etiquetados como "good first issue"](https://github.com/jalexiscv/Html/labels/good%20first%20issue)

---

## 📜 Licencia

Distribuido bajo la Licencia **MIT**. Ver [LICENSE](LICENSE) para más información.

> La licencia MIT te permite usar, copiar, modificar, fusionar, publicar, distribuir, sublicenciar y/o vender copias del software sin restricciones, siempre que se incluya el aviso de copyright.

---

## 👨‍💻 Autor

**Jose Alexis Correa Valencia**  
*Full Stack Developer & Software Architect*

Con más de 25 años de experiencia en desarrollo de software empresarial, especializado en arquitecturas escalables y soluciones PHP modernas.

- **GitHub**: [@jalexiscv](https://github.com/jalexiscv)
- **LinkedIn**: [Jose Alexis Correa Valencia](https://www.linkedin.com/in/jalexiscv/)
- **Email**: jalexiscv@gmail.com
- **Ubicación**: Colombia 🇨🇴

---

## ❤️ Donaciones

Si Higgs - FrontEnd Framework (FEF) te ha ayudado a ti o a tu negocio, considera apoyar su desarrollo y mantenimiento continuo.

| Método | Detalles |
|--------|----------|
| **PayPal** | [jalexiscv@gmail.com](https://www.paypal.com/paypalme/anssible) |
| **Nequi (Colombia)** | `3117977281` |

### Beneficios de tu Soporte

Tu donación ayuda a:
- ⚡ Acelerar el desarrollo de nuevas funcionalidades
- 📚 Crear más documentación y ejemplos
- 🧪 Mejorar la cobertura de tests
- 🎨 Implementar soporte para más frameworks
- 🌍 Mantener el proyecto activo y actualizado

*¡Gracias por tu apoyo!* 🙏

---

<div align="center">

**Desarrollado con ❤️ para la comunidad PHP**

[⬆ Volver arriba](#frontend-framework)

</div>