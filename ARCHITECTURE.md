# Arquitectura Estándar para Librerías PHP

Este documento define las directrices arquitectónicas, la estructura de directorios y los estándares de desarrollo para la creación y mantenimiento de librerías PHP modernas. El objetivo es proporcionar un marco de trabajo consistente, agnóstico al framework y flexible en su instalación.

## 1. Filosofía de Diseño

El diseño de la librería se basa en los siguientes principios fundamentales:

*   **Agnosticismo**: La librería no debe depender de ningún framework (Laravel, Symfony, etc.) a menos que sea un adaptador explícito.
*   **Portabilidad Híbrida**: Debe ser instalable y funcional tanto mediante **Composer** (estándar moderno) como mediante **instalación manual** (requerimiento legacy/simple), sin cambios en el código del consumidor.
*   **Claridad Semántica**: La estructura de carpetas y clases debe reflejar claramente su propósito.
*   **Estándares PSR**: Adhesión estricta a PSR-4 (Autoloading), PSR-12 (Estilo de código) y otras recomendaciones relevantes de PHP-FIG.

## 2. Estructura de Directorios

Se establece la siguiente estructura de directorios como estándar mandatorio:

```text
/
├── src/                    # Código fuente de la librería (Namespace Raíz)
│   ├── Component/          # Módulos o subcomponentes lógicos
│   ├── Traits/             # Comportamientos reutilizables
│   ├── Interfaces/         # (Opcional) Contratos globales si no están junto a su implementación
│   └── MainClass.php       # Punto de entrada principal o Facade (Opcional)
│
├── tests/                  # Pruebas unitarias y de integración
├── examples/               # Ejemplos de uso autocontenidos
├── vendor/                 # Dependencias gestionadas por Composer (Gitignored)
├── autoload.php            # Autoloader híbrido (Entry point manual)
├── composer.json           # Definición del paquete
├── LICENSE                 # Archivo de licencia
├── README.md               # Documentación y guía de inicio
└── CHANGELOG.md            # Registro histórico de cambios
```

## 3. Sistema de Autocarga (Autoloading)

Para cumplir con el principio de **Portabilidad Híbrida**, se utiliza un mecanismo de doble entrada.

### 3.1. Vía Composer (Estándar)
El archivo `composer.json` debe definir el mapeo PSR-4 apuntando al directorio `src/`.

```json
"autoload": {
    "psr-4": {
        "Vendor\\Paquete\\": "src/"
    }
}
```

### 3.2. Vía Manual (Legacy/Standalone)
Se debe incluir un archivo `autoload.php` en la raíz del proyecto. Este archivo actúa como un puente inteligente:

1.  **Detección Automática**: Intenta localizar cargar `vendor/autoload.php` primero.
2.  **Fallback PSR-4**: Si no encuentra el autoloader de Composer, registra un `spl_autoload_register` personalizado que emula el comportamiento de PSR-4, mapeando el namespace del proyecto directamente a la carpeta `src/`.

**Beneficio**: Esto permite al usuario final hacer `require 'path/to/lib/autoload.php'` y tener la librería lista para usar inmediatamente, sin necesidad de ejecutar `composer install` si la librería no tiene dependencias externas complejas.

## 4. Guía de Implementación para Nuevas Librerías

Al iniciar un nuevo proyecto bajo esta arquitectura, siga estos pasos:

### Paso 1: Inicialización
Cree la estructura de carpetas base (`src`, `tests`, `examples`).

### Paso 2: Definición del Namespace
Elija un namespace raíz claro siguiendo el formato `Vendor\Paquete` (ej. `MiEmpresa\Pdf`).

### Paso 3: Configuración del Autoloader Manual
Cree el archivo `autoload.php` en la raíz con el siguiente patrón lógico (ajuste `$prefix` según corresponda):

```php
<?php
declare(strict_types=1);

// 1. Intentar cargar Composer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    return;
}

// 2. Fallback Manual
spl_autoload_register(function ($class) {
    $prefix = 'Vendor\\Paquete\\'; // <-- CONFIGURAR AQUÍ
    $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
```

### Paso 4: Desarrollo del Núcleo (`src/`)
*   **Clases**: Deben tener una única responsabilidad.
*   **Interfaces**: Úselas para definir contratos públicos sólidos. Sufijo `Interface` (ej. `RenderableInterface`).
*   **Traits**: Para compartir código horizontalmente. Sufijo `Trait` recomendado si son genéricos (ej. `LoggableTrait`).

## 5. Normativas de Código

*   **Tipado**: Uso obligatorio de `declare(strict_types=1);` en todos los archivos PHP.
*   **Tipos de Datos**: Definir explícitamente tipos para argumentos y valores de retorno.
*   **Visibilidad**: Preferir `private` y `protected` sobre `public`. Usar `final` para clases que no están diseñadas para ser extendidas.
*   **Inmutabilidad**: Utilizar propiedades `readonly` donde el estado no deba cambiar tras la instanciación.

## 6. Testing y Calidad

*   **PHPUnit**: Framework estándar para pruebas. El archivo `phpunit.xml` debe estar configurado para ejecutarse desde la raíz.
*   **Análisis Estático**: Se recomienda el uso de herramientas como PHPStan para asegurar la calidad del tipado.
*   **Compatibilidad**: El código debe ser compatible con las versiones de PHP soportadas activamente (actualmente PHP 8.0+).

## 7. Créditos y Filosofía

Esta arquitectura y filosofía de desarrollo son fruto del conocimiento acumulado por **Jose Alexis Correa Valencia**, reflejando más de 25 años de experiencia en programación PHP. El diseño busca el equilibrio perfecto entre robustez, modernidad y flexibilidad.

A pesar del alto grado de especialización y rigor técnico que posee este código, mantenemos una postura abierta a la colaboración:

> "La excelencia técnica no debe ser una barrera, sino una invitación."

Estamos abiertos a **contribuciones de terceros**, sugerencias de mejora y pull requests, siempre que respeten los estándares de calidad y la filosofía arquitectónica aquí descrita. Creemos que la innovación continua surge de la comunidad y del intercambio de conocimientos.

### Contacto y Redes

Para discusiones sobre arquitectura, consultoría o colaboraciones:

*   **LinkedIn**: [Jose Alexis Correa Valencia](https://www.linkedin.com/in/jalexiscv/)
*   **Email**: jalexiscv@gmail.com
*   **GitHub**: [@jalexiscv](https://github.com/jalexiscv)

---
Este documento sirve como referencia canónica para asegurar que todas las librerías del ecosistema compartan una misma base estructural sólida, mantenible y accesible.
