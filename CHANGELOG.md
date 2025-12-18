# Changelog

Todos los cambios notables en este proyecto serán documentados en este archivo.

El formato se basa en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto adhiere a [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
