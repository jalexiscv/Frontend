# Ejemplos: Componente Indicator

Componente Indicator de Bootstrap 5.3.3 para mostrar indicadores numéricos (KPIs, métricas, estadísticas) en formato card.

---

## Ejemplo 1: Indicador Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Extras\Indicator;

$indicator = new Indicator([
    'value' => '5',
    'label' => 'Total'
]);

echo $indicator->render();
```

**Características:**
- Card neutral sin color específico
- Número grande en `<h2>`
- Etiqueta descriptiva debajo
- Modo por defecto: `'basic'`

**HTML generado:**
```html
<div class="card text-center">
    <div class="card-body">
        <h2>5</h2>
        <p class="mb-0">Total</p>
    </div>
</div>
```

---

## Ejemplo 2: Indicador con Variante de Color

```php
$indicator = new Indicator([
    'value' => '125',
    'label' => 'Usuarios Activos',
    'variant' => 'primary'
]);

echo $indicator->render();
```

**Características:**
- Borde azul (`border-primary`)
- Texto del valor en azul (`text-primary`)
- Resalta visualmente el indicador

**HTML generado:**
```html
<div class="card text-center border-primary">
    <div class="card-body">
        <h2 class="text-primary">125</h2>
        <p class="mb-0">Usuarios Activos</p>
    </div>
</div>
```

---

## Ejemplo 3: Indicador de Éxito

```php
$indicator = new Indicator([
    'value' => '98%',
    'label' => 'Satisfacción',
    'variant' => 'success'
]);

echo $indicator->render();
```

**Características:**
- Color verde (`success`)
- Ideal para métricas positivas
- Puede incluir símbolos en el valor (%, $, etc.)

---

## Ejemplo 4: Indicador de Peligro/Error

```php
$indicator = new Indicator([
    'value' => '12',
    'label' => 'Errores Críticos',
    'variant' => 'danger'
]);

echo $indicator->render();
```

**Características:**
- Color rojo (`danger`)
- Ideal para alertas o métricas negativas

---

## Ejemplo 5: Indicador de Advertencia

```php
$indicator = new Indicator([
    'value' => '8',
    'label' => 'Pendientes',
    'variant' => 'warning'
]);

echo $indicator->render();
```

**Características:**
- Color amarillo (`warning`)
- Ideal para items que requieren atención

---

## Ejemplo 6: Indicador Informativo

```php
$indicator = new Indicator([
    'value' => '24/7',
    'label' => 'Disponibilidad',
    'variant' => 'info'
]);

echo $indicator->render();
```

**Características:**
- Color celeste (`info`)
- Ideal para información general

---

## Ejemplo 7: Dashboard con Múltiples Indicadores

```php
$indicators = [
    ['value' => '1,245', 'label' => 'Visitantes', 'variant' => 'primary'],
    ['value' => '$12,500', 'label' => 'Ventas', 'variant' => 'success'],
    ['value' => '8', 'label' => 'Pendientes', 'variant' => 'warning'],
    ['value' => '2', 'label' => 'Errores', 'variant' => 'danger']
];

echo '<div class="row">';
foreach ($indicators as $data) {
    echo '<div class="col-md-3 mb-3">';
    $indicator = new Indicator($data);
    echo $indicator->render();
    echo '</div>';
}
echo '</div>';
```

**Características:**
- Grid de 4 columnas
- Diferentes variantes de color
- Ideal para dashboards

---

## Ejemplo 8: Indicador con Atributos Personalizados

```php
$indicator = new Indicator([
    'value' => '99.9%',
    'label' => 'Uptime',
    'variant' => 'success',
    'attributes' => [
        'class' => 'shadow-sm',
        'id' => 'uptime-indicator',
        'data-metric' => 'uptime'
    ]
]);

echo $indicator->render();
```

**Características:**
- Clases CSS adicionales (`shadow-sm`)
- ID personalizado
- Data attributes para JavaScript
- Ideal para integración con frameworks JS

---

## Ejemplo 9: Indicadores con Valores Formateados

```php
// Valor numérico formateado
$sales = new Indicator([
    'value' => '$' . number_format(12345.67, 2),
    'label' => 'Ventas del Mes',
    'variant' => 'success'
]);

// Porcentaje
$conversion = new Indicator([
    'value' => number_format(3.45, 2) . '%',
    'label' => 'Tasa de Conversión',
    'variant' => 'info'
]);

// Número con separadores de miles
$users = new Indicator([
    'value' => number_format(125678),
    'label' => 'Usuarios Totales',
    'variant' => 'primary'
]);

echo $sales->render();
echo $conversion->render();
echo $users->render();
```

**Características:**
- Formatos monetarios
- Formatos de porcentaje
- Separadores de miles
- Usa `number_format()` de PHP

---

## Ejemplo 10: Indicadores desde Base de Datos

```php
// Simulación de datos desde base de datos
$metrics = [
    ['metric' => 'total_users', 'value' => 1245, 'label' => 'Total Usuarios'],
    ['metric' => 'active_users', 'value' => 987, 'label' => 'Usuarios Activos'],
    ['metric' => 'new_users', 'value' => 45, 'label' => 'Nuevos Hoy']
];

foreach ($metrics as $metric) {
    // Determinar variante según el tipo de métrica
    $variant = match($metric['metric']) {
        'total_users' => 'primary',
        'active_users' => 'success',
        'new_users' => 'info',
        default => null
    };
    
    $indicator = new Indicator([
        'value' => (string)$metric['value'],
        'label' => $metric['label'],
        'variant' => $variant
    ]);
    
    echo $indicator->render();
}
```

**Características:**
- Datos reales desde base de datos
- Lógica condicional para variantes
- Conversión de int a string automática

---

## Ejemplo 11: Usando la Facade Bootstrap

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;

// Forma corta usando la facade
echo Bootstrap::indicator([
    'value' => '42',
    'label' => 'La Respuesta',
    'variant' => 'info'
]);
```

**Características:**
- Método estático conveniente
- Mismas opciones que el constructor
- Sintaxis más concisa

---

## Ejemplo 12: Dashboard Completo

```php
echo '<div class="container my-4">';
echo '<h1 class="mb-4">Dashboard Ejecutivo</h1>';

echo '<div class="row g-3">';

// Row 1: Métricas principales
$mainMetrics = [
    ['value' => '$125,450', 'label' => 'Ingresos Mensuales', 'variant' => 'success'],
    ['value' => '1,245', 'label' => 'Clientes Activos', 'variant' => 'primary'],
    ['value' => '98.5%', 'label' => 'Satisfacción', 'variant' => 'info'],
    ['value' => '15', 'label' => 'Tickets Abiertos', 'variant' => 'warning']
];

foreach ($mainMetrics as $metric) {
    echo '<div class="col-lg-3 col-md-6">';
    echo Bootstrap::indicator($metric);
    echo '</div>';
}

echo '</div>'; // row

echo '<div class="row g-3 mt-3">';

// Row 2: Métricas secundarias
$secondaryMetrics = [
    ['value' => '45', 'label' => 'Nuevos Hoy', 'variant' => 'success'],
    ['value' => '2', 'label' => 'Errores Críticos', 'variant' => 'danger']
];

foreach ($secondaryMetrics as $metric) {
    echo '<div class="col-lg-6 col-md-6">';
    echo Bootstrap::indicator($metric);
    echo '</div>';
}

echo '</div>'; // row
echo '</div>'; // container
```

**Resultado**: Dashboard completo con 6 indicadores organizados en grid responsivo.

---

## Opciones Disponibles

### Opciones Principales

| Opción | Tipo | Default | Descripción |
|--------|------|---------|-------------|
| `mode` | string | `'basic'` | Modo de visualización |
| `value` | string\|int | **required** | Valor a mostrar |
| `label` | string | **required** | Etiqueta descriptiva |
| `variant` | string\|null | `null` | Variante de color Bootstrap |
| `attributes` | array | `[]` | Atributos HTML adicionales |

### Modos Disponibles

Actualmente solo está implementado:
- **`basic`**: Card centrada con número grande y etiqueta

### Variantes de Color

| Variante | Color | Uso Recomendado |
|----------|-------|-----------------|
| `null` | Neutral/Gris | Indicadores genéricos |
| `primary` | Azul | Métricas principales |
| `secondary` | Gris | Métricas secundarias |
| `success` | Verde | Métricas positivas/éxito |
| `danger` | Rojo | Errores/alertas críticas |
| `warning` | Amarillo | Advertencias/pendientes |
| `info` | Celeste | Información general |
| `light` | Blanco | Fondos claros |
| `dark` | Negro | Fondos oscuros |

---

## Estructura HTML Generada

### Sin Variante
```html
<div class="card text-center">
    <div class="card-body">
        <h2>{value}</h2>
        <p class="mb-0">{label}</p>
    </div>
</div>
```

### Con Variante
```html
<div class="card text-center border-{variant}">
    <div class="card-body">
        <h2 class="text-{variant}">{value}</h2>
        <p class="mb-0">{label}</p>
    </div>
</div>
```

---

## Tips y Buenas Prácticas

### 1. Usar Variantes Apropiadas

```php
// ✅ Bueno - Variante apropiada
$success = new Indicator(['value' => '100%', 'label' => 'Completado', 'variant' => 'success']);
$error = new Indicator(['value' => '5', 'label' => 'Errores', 'variant' => 'danger']);

// ❌ Malo - Variante inapropiada
$error = new Indicator(['value' => '5', 'label' => 'Errores', 'variant' => 'success']);
```

### 2. Formatear Valores Correctamente

```php
// ✅ Bueno - Valores legibles
$formatted = new Indicator([
    'value' => '$' . number_format(12345.67, 2),
    'label' => 'Ventas'
]);

// ❌ Malo - Valor sin formato
$unformatted = new Indicator([
    'value' => '12345.67',
    'label' => 'Ventas'
]);
```

### 3. Labels Descriptivos

```php
// ✅ Bueno - Label claro
$indicator = new Indicator(['value' => '125', 'label' => 'Usuarios Activos Hoy']);

// ❌ Malo - Label ambiguo
$indicator = new Indicator(['value' => '125', 'label' => 'Usuarios']);
```

### 4. Grid Responsivo

```php  
// ✅ Bueno - Responsivo
echo '<div class="col-lg-3 col-md-6 col-sm-12">';
echo $indicator->render();
echo '</div>';

// ❌ Malo - Tamaño fijo
echo '<div class="col-3">';
echo $indicator->render();
echo '</div>';
```

---

## Validación de Opciones

El componente valida automáticamente:

1. ✅ **value es requerido**: Lanza `InvalidArgumentException` si falta
2. ✅ **label es requerido**: Lanza `InvalidArgumentException` si falta
3. ✅ **mode válido**: Solo acepta `'basic'` actualmente
4. ✅ **variant válida**: Si se especifica, debe ser una de las 8 variantes Bootstrap

**Ejemplo de error:**
```php
// ❌ Esto lanzará InvalidArgumentException
$indicator = new Indicator([
    'value' => '5'
    // Falta 'label' requerido
]);

// ❌ Esto lanzará InvalidArgumentException
$indicator = new Indicator([
    'value' => '5',
    'label' => 'Total',
    'variant' => 'custom' // Variante inválida
]);
```

---

## Casos de Uso Reales

### Dashboard Administrativo
```php
$metrics = [
    'total_users' => ['value' => '1,245', 'variant' => 'primary'],
    'active_sessions' => ['value' => '87', 'variant' => 'success'],
    'pending_tasks' => ['value' => '12', 'variant' => 'warning'],
    'critical_errors' => ['value' => '0', 'variant' => 'success']
];
```

### Panel de Ventas
```php
$sales = [
    'daily' => ['value' => '$2,450', 'label' => 'Ventas Hoy', 'variant' => 'success'],
    'monthly' => ['value' => '$45,600', 'label' => 'Ventas del Mes', 'variant' => 'primary'],
    'goal' => ['value' => '89%', 'label' => 'Meta Alcanzada', 'variant' => 'info']
];
```

### Monitor de Sistema
```php
$system = [
    'cpu' => ['value' => '45%', 'label' => 'CPU Usage', 'variant' => 'success'],
    'memory' => ['value' => '78%', 'label' => 'Memory Usage', 'variant' => 'warning'],
    'disk' => ['value' => '92%', 'label' => 'Disk Usage', 'variant' => 'danger']
];
```

---

## Referencias

- **Componente**: [`Indicator.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Extras/Indicator.php)
- **Facade**: [`Bootstrap.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Bootstrap.php)
- **Estándares**: [`COMPONENT_STANDARDS.md`](file:///c:/xampp/htdocs/system/Frontend/COMPONENT_STANDARDS.md)
- **Bootstrap Docs**: [Bootstrap 5.3 Cards](https://getbootstrap.com/docs/5.3/components/card/)
