# Changelog

Todos los cambios notables en este proyecto serán documentados en este archivo.

El formato se basa en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto adhiere a [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.6] - 2025-12-18

### Fixed
- **Card Constructor**: Agregado constructor faltante en la clase `Card` que causaba que las tarjetas se generaran vacías
  - El método `Bootstrap::card()` ahora funciona correctamente inicializando la tarjeta con los parámetros proporcionados
  - Corregido bug donde `new Card($title, $content, $footer, $imageUrl, $attributes)` ignoraba todos los parámetros
  - La tarjeta ahora se renderiza correctamente con título, contenido, footer e imagen

## [1.0.5] - 2025-12-18

### Documentation
- **Requisitos y Dependencias**: Nueva sección documentando la dependencia crítica con la librería [Higgs Html](https://github.com/jalexiscv/Html)
- **Instalación Mejorada**: Instrucciones actualizadas para incluir la instalación de ambas librerías (Html y Frontend)
- **Arquitectura de Dependencias**: Diagrama explicativo de cómo Frontend Framework depende de Html
- **Advertencias Importantes**: Agregadas alertas sobre la necesidad de instalar Html primero

### Added
- **composer.json**: Declarada dependencia explícita con `higgs/html: ^1.0` en la sección `require`

### Changed
- Método de instalación vía Composer ahora incluye dos pasos (Html + Frontend)
- Método de instalación manual ahora incluye estructura de directorios esperada
- Mejorada claridad sobre el papel de la librería Html como motor de renderizado

## [1.0.4] - 2025-12-18

### Documentation
- **README Expandido**: Reescritura completa del `README.md` para capturar la verdadera esencia del proyecto
- **Génesis y Motivación**: Nueva sección explicando el origen del proyecto y problemas que resuelve
- **Filosofía de Diseño**: Documentación detallada de los 5 pilares arquitectónicos del framework
- **Casos de Uso Empresariales**: Ejemplos reales de implementación en proyectos empresariales
- **Comparación con Alternativas**: Análisis detallado vs HTML directo, template engines y frontend frameworks
- **Roadmap Detallado**: Visión a largo plazo del proyecto con hitos trimestrales
- **Ejemplos Avanzados**: Casos de uso complejos (dashboards, formularios multi-paso, notificaciones)
- **Propuesta de Valor**: Sección expandida con beneficios cuantificables y métricas de impacto
- **Arquitectura Multi-Framework**: Visión estratégica de escalabilidad y migración sin dolor

### Changed
- Mejorada la estructura del `README.md` con navegación más clara
- Expandida la sección de componentes con tablas descriptivas
- Agregados badges informativos al encabezado del documento

## [1.0.3] - 2025-12-14

### Fixed
- **Bootstrap Facade**: Resolved verification errors in `Navbar` component.
- **AttributeFactory**: Fixed critical initialization issues.

## [1.0.2] - 2025-12-14

### Documentation
- Agregada sección "Arquitectura Multi-Framework" en `README.md` detallando la escalabilidad del diseño.
- Ampliada la introducción para destacar características empresariales.

## [1.0.1] - 2025-12-14

### Fixed
- Corregido error de carga de clases `Card` y `CardGroup`.
- Corregidos tipos de retorno y parámetros en `Bootstrap.php`.
- Añadida documentación faltante para Formularios y nuevos componentes en `README.md`.
- Solucionado crash crítico en `AttributeFactory` mediante parche de autoloading (`Frontend/autoload.php`).
- Corregida recursión infinita en componente `Navbar`.

## [1.0.0] - 2025-12-14

### Added
- Estructura de directorios estándar (`src/`, `tests/`, `examples/`).
- Archivo `autoload.php` para carga híbrida.
- Archivo `composer.json` para gestión de dependencias y autoloading PSR-4.

### Changed
- Movido el código fuente de la raíz a `src/`.
