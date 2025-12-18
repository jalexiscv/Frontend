# Estándar Arquitectónico: Componentes de Bootstrap

## 🎯 Propósito

Este documento define el estándar arquitectónico OBLIGATORIO para todos los componentes de Bootstrap en Frontend Framework. Todo componente DEBE seguir estas reglas para mantener consistencia y calidad.

---

## 📐 Patrón de Diseño Obligatorio

### Principios Fundamentales

1. **Constructor con Array de Opciones**: Todos los componentes reciben UN SOLO parámetro: array de opciones
2. **Clase Facade (Bootstrap) como Bypass**: Los métodos estáticos solo instancian y retornan
3. **Separación de Responsabilidades**: Lógica en componente, facade solo para conveniencia
4. **Inmutabilidad de Opciones**: Las opciones se establecen en constructor, no después (salvo métodos fluidos opcionales)

---

## 🔧 Interfaz Obligatoria

### ComponentInterface

Todos los componentes DEBEN implementar esta interfaz:

```php
<?php

namespace Higgs\Frontend\Contracts;

use Higgs\Html\Tag\TagInterface;

/**
 * Interfaz que TODOS los componentes de Bootstrap deben implementar
 */
interface ComponentInterface
{
    /**
     * Constructor que DEBE recibir array de opciones
     * 
     * @param array $options Array asociativo de opciones de configuración
     */
    public function __construct(array $options = []);
    
    /**
     * Renderiza el componente y retorna TagInterface
     * 
     * @return TagInterface
     */
    public function render(): TagInterface;
}
```

---

## 📝 Estructura de Componente

### Template Obligatorio

```php
<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\[Categoria];

use Higgs\Html\Html;
use Higgs\Html\Tag\TagInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\AbstractComponent;
use Higgs\Frontend\Contracts\ComponentInterface;

/**
 * Componente [NombreComponente] de Bootstrap 5.3.3
 * 
 * Opciones disponibles:
 * - 'opcion1': tipo - Descripción
 * - 'opcion2': tipo - Descripción
 * - 'attributes': array - Atributos HTML adicionales
 * 
 * @example
 * new NombreComponente(['opcion1' => 'valor', 'opcion2' => 'valor']);
 */
class NombreComponente extends AbstractComponent implements ComponentInterface
{
    // === PROPIEDADES ===
    private mixed $propiedad1 = null;
    private mixed $propiedad2 = null;
    private array $attributes = [];
    
    /**
     * Constructor
     * 
     * @param array $options Array de opciones de configuración
     */
    public function __construct(array $options = [])
    {
        // Mapear opciones a propiedades
        if (isset($options['opcion1'])) {
            $this->propiedad1 = $options['opcion1'];
        }
        
        if (isset($options['opcion2'])) {
            $this->propiedad2 = $options['opcion2'];
        }
        
        if (isset($options['attributes']) && is_array($options['attributes'])) {
            $this->attributes = $options['attributes'];
        }
        
        // Validaciones (si son necesarias)
        $this->validate();
    }
    
    /**
     * Valida las opciones del componente
     * 
     * @throws \InvalidArgumentException
     */
    private function validate(): void
    {
        // Validar opciones requeridas
        // Validar valores permitidos
        // etc.
    }
    
    /**
     * Renderiza el componente
     * 
     * @return TagInterface
     */
    public function render(): TagInterface
    {
        // Lógica de renderizado
        return $this->createComponent('div', $this->attributes);
    }
}
```

---

## 🎨 Método Facade en Bootstrap

### Template Obligatorio para Bootstrap.php

```php
/**
 * Crea un [nombre del componente]
 * 
 * Actúa como bypass/proxy a la clase [NombreComponente].
 * 
 * @param array $options Array de opciones (ver [NombreComponente]::__construct)
 * @return TagInterface
 * 
 * @example
 * Bootstrap::nombreComponente(['opcion1' => 'valor', 'opcion2' => 'valor']);
 */
public static function nombreComponente(array $options = []): TagInterface
{
    return (new NombreComponente($options))->render();
}
```

### ❌ NUNCA Hacer Esto

```php
// MAL - Transformación de parámetros
public static function nombreComponente(
    string $param1,
    string $param2 = 'default',
    array $attributes = []
): TagInterface {
    $options = [
        'opcion1' => $param1,
        'opcion2' => $param2,
        'attributes' => $attributes
    ];
    return (new NombreComponente($options))->render();
}
```

---

## 📋 Documentación de Opciones

### En PHPDoc del Constructor

SIEMPRE documentar todas las opciones disponibles:

```php
/**
 * Constructor
 * 
 * Opciones disponibles:
 * - 'content': string - Contenido del componente (requerido)
 * - 'type': string - Tipo/variante ('primary', 'secondary', etc.) [default: 'primary']
 * - 'dismissible': bool - Si es dismissible [default: false]
 * - 'icon': string - Ícono opcional
 * - 'attributes': array - Atributos HTML adicionales
 * - 'class': string - Clases CSS adicionales (se mergean con las por defecto)
 * 
 * @param array $options Array de opciones de configuración
 * 
 * @example
 * new Alert(['content' => 'Mensaje', 'type' => 'danger', 'dismissible' => true]);
 */
```

---

## ✅ Checklist de Cumplimiento

Antes de considerar un componente "completo", verificar:

- [ ] Implementa `ComponentInterface`
- [ ] Constructor solo recibe `array $options = []`
- [ ] Todas las opciones documentadas en PHPDoc
- [ ] Método `render()` retorna `TagInterface`
- [ ] Método en `Bootstrap` es bypass simple (1 línea)
- [ ] Validación de opciones (si es necesaria)
- [ ] Valores por defecto claramente definidos
- [ ] Ejemplos de uso en PHPDoc
- [ ] Extiende `AbstractComponent`
- [ ] Usa métodos de `AbstractComponent` cuando sea posible

---

## 🎯 Ejemplos Completos

### Alert Component

```php
namespace Higgs\Frontend\Bootstrap\v5_3_3\Interface;

use Higgs\Frontend\Contracts\ComponentInterface;

class Alert extends AbstractComponent implements ComponentInterface
{
    private ?string $content = null;
    private string $type = 'primary';
    private bool $dismissible = false;
    private array $attributes = [];
    
    public function __construct(array $options = [])
    {
        $this->content = $options['content'] ?? null;
        $this->type = $options['type'] ?? 'primary';
        $this->dismissible = $options['dismissible'] ?? false;
        $this->attributes = $options['attributes'] ?? [];
        
        // Validar tipo
        $validTypes = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        if (!in_array($this->type, $validTypes)) {
            throw new \InvalidArgumentException("Invalid alert type: {$this->type}");
        }
    }
    
    public function render(): TagInterface
    {
        $this->attributes['class'] = $this->mergeClasses(
            "alert alert-{$this->type}",
            $this->attributes['class'] ?? null
        );
        
        $alert = $this->createComponent('div', $this->attributes);
        $alert->content($this->content);
        
        return $alert;
    }
}
```

### En Bootstrap.php

```php
public static function alert(array $options = []): TagInterface
{
    return (new Alert($options))->render();
}
```

---

## 🚫 Anti-Patrones (Evitar)

### ❌ Múltiples Parámetros Posicionales
```php
// MAL
public function __construct(string $content, string $type = 'primary', bool $dismissible = false)
```

### ❌ Setters Obligatorios Después de Constructor
```php
// MAL
$alert = new Alert();
$alert->setContent('Mensaje');  // No usar setters obligatorios
$alert->setType('danger');
```

### ❌ Lógica de Transformación en Bootstrap
```php
// MAL - La facade NO debe tener lógica
public static function alert(string $content, string $type = 'primary'): TagInterface
{
    $options = ['content' => $content, 'type' => $type];  // ❌ Transformación
    return (new Alert($options))->render();
}
```

---

## 📚 Métodos Fluidos (Opcionales)

Los métodos fluidos son OPCIONALES, pero si se implementan:

```php
/**
 * Establece el contenido (método fluido opcional)
 */
public function content(string $content): self
{
    $this->content = $content;
    return $this;
}

// Uso
$alert = new Alert(['type' => 'danger']);
$alert->content('Mensaje')->render();
```

**Regla**: Los métodos fluidos son COMPLEMENTARIOS, no REEMPLAZAN el constructor con opciones.

---

## 🔍 Validación y Tipos

### Uso de Validaciones

```php
private function validate(): void
{
    // Opciones requeridas
    if ($this->content === null) {
        throw new \InvalidArgumentException('Content is required');
    }
    
    // Valores permitidos
    if (!in_array($this->type, self::VALID_TYPES)) {
        throw new \InvalidArgumentException("Invalid type: {$this->type}");
    }
    
    // Rangos de valores
    if ($this->size < 1 || $this->size > 12) {
        throw new \OutOfRangeException("Size must be between 1 and 12");
    }
}
```

---

## 📖 Documentación Requerida

Para cada componente, crear/actualizar:

1. **PHPDoc completo** del constructor con todas las opciones
2. **Ejemplos** en PHPDoc usando `@example`
3. **Archivo de documentación** en `/docs/components/[ComponentName].md` (opcional pero recomendado)

---

## 🎓 Resumen

**Regla de Oro**: 
> Un componente, un constructor con array de opciones. Bootstrap solo bypass.

**Beneficios**:
- ✅ Consistencia en toda la librería
- ✅ Fácil de mantener y extender
- ✅ Todas las opciones accesibles
- ✅ Menos código, menos bugs
- ✅ Mejor experiencia de desarrollo

---

**Versión**: 1.0  
**Última actualización**: 2025-12-18  
**Aplicable desde**: v2.0.0
