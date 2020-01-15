# Bootstrap 5.3.3 - Documentación de Componentes

Guía completa de uso de componentes Bootstrap 5.3.3 con PHP.

## Índice de Componentes

### 📱 Interface (18 componentes)

Componentes interactivos y de interfaz de usuario:

| Componente | Descripción | Documentación |
|------------|-------------|---------------|
| **Accordion** | Paneles colapsables | [Ver docs](Docs/components/interface/Accordion.md) |
| **Alert** | Mensajes de retroalimentación | [Ver docs](Docs/components/interface/Alert.md) |
| **Badge** | Etiquetas y contadores | [Ver docs](Docs/components/interface/Badge.md) |
| **Button** | Botones de acción | [Ver docs](Docs/components/interface/Button.md) |
| **ButtonGroup** | Agrupación de botones | [Ver docs](Docs/components/interface/ButtonGroup.md) |
| **Card** | Contenedores flexibles | [Ver docs](Docs/components/interface/Card.md) |
| **CardGroup** | Grupos de tarjetas | [Ver docs](Docs/components/interface/CardGroup.md) |
| **Carousel** | Carrusel de imágenes | [Ver docs](Docs/components/interface/Carousel.md) |
| **Collapse** | Elementos colapsables | [Ver docs](Docs/components/interface/Collapse.md) |
| **Dropdown** | Menús desplegables | [Ver docs](Docs/components/interface/Dropdown.md) |
| **ListGroup** | Listas de grupos | [Ver docs](Docs/components/interface/ListGroup.md) |
| **Modal** | Diálogos modales | [Ver docs](Docs/components/interface/Modal.md) |
| **Offcanvas** | Paneles laterales | [Ver docs](Docs/components/interface/Offcanvas.md) |
| **Popover** | Información ampliada | [Ver docs](Docs/components/interface/Popover.md) |
| **Progress** | Barras de progreso | [Ver docs](Docs/components/interface/Progress.md) |
| **Spinner** | Indicadores de carga | [Ver docs](Docs/components/interface/Spinner.md) |
| **Toast** | Notificaciones push | [Ver docs](Docs/components/interface/Toast.md) |
| **Tooltip** | Información contextual | [Ver docs](Docs/components/interface/Tooltip.md) |

### 📝 Form (9 componentes)

Componentes para formularios:

| Componente | Descripción | Documentación |
|------------|-------------|---------------|
| **Check** | Checkboxes y switches | [Ver docs](Docs/components/form/Check.md) |
| **File** | Inputs de archivos | [Ver docs](Docs/components/form/File.md) |
| **Form** | Contenedor de formulario | [Ver docs](Docs/components/form/Form.md) |
| **FormControl** | Controles de formulario | [Ver docs](Docs/components/form/FormControl.md) |
| **Input** | Campos de texto | [Ver docs](Docs/components/form/Input.md) |
| **InputGroup** | Grupos de inputs | [Ver docs](Docs/components/form/InputGroup.md) |
| **Radio** | Botones de radio | [Ver docs](Docs/components/form/Radio.md) |
| **Select** | Listas desplegables | [Ver docs](Docs/components/form/Select.md) |
| **Textarea** | Áreas de texto | [Ver docs](Docs/components/form/Textarea.md) |

### 🧭 Navigation (4 componentes)

Componentes de navegación:

| Componente | Descripción | Documentación |
|------------|-------------|---------------|
| **Breadcrumb** | Migajas de pan | [Ver docs](Docs/components/navigation/Breadcrumb.md) |
| **Nav** | Navegación base | [Ver docs](Docs/components/navigation/Nav.md) |
| **Navbar** | Barras de navegación | [Ver docs](Docs/components/navigation/Navbar.md) |
| **Pagination** | Paginación | [Ver docs](Docs/components/navigation/Pagination.md) |

### 📐 Layout  (4 componentes)

Componentes de diseño y estructura:

| Componente | Descripción | Documentación |
|------------|-------------|---------------|
| **Col** | Columnas del grid | [Ver docs](Docs/components/layout/Col.md) |
| **Container** | Contenedores responsive | [Ver docs](Docs/components/layout/Container.md) |
| **Grid** | Sistema de grid | [Ver docs](Docs/components/layout/Grid.md) |
| **Row** | Filas del grid | [Ver docs](Docs/components/layout/Row.md) |

### 📄 Content (4 componentes)

Componentes de contenido:

| Componente | Descripción | Documentación |
|------------|-------------|---------------|
| **Figure** | Figuras con captions | [Ver docs](Docs/components/content/Figure.md) |
| **Image** | Imágenes responsive | [Ver docs](Docs/components/content/Image.md) |
| **Table** | Tablas de datos | [Ver docs](Docs/components/content/Table.md) |
| **Typography** | Tipografía y estilos de texto | [Ver docs](Docs/components/content/Typography.md) |

## Inicio Rápido

### Uso Básico

```php
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap as BS5;

// Crear un botón
$button = BS5::button([
    'content' => 'Click me',
    'variant' => 'primary'
])->render();

// Crear una alertá
$alert = BS5::alert([
    'content' => '¡Operación exitosa!',
    'type' => 'success',
    'dismissible' => true
])->render();

// Crear una card
$card = BS5::card([
    'title' => 'Título',
    'content' => 'Contenido de la tarjeta',
    'footer' => 'Pie de la tarjeta'
])->render();
```

## Arquitectura

Todos los componentes:
- Implementan la interfaz `ComponentInterface`
- Extienden `AbstractComponent`
- Aceptan un array de opciones en el constructor
- Usan el patrón de método fluido para configuración adicional
- Retornan objetos `TagInterface` al renderizar

## Enlaces Útiles

- **Código fuente de componentes**: [`src/Bootstrap/v5_3_3/`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/)
- **Clase principal Bootstrap**: [`Bootstrap.php`](file:///c:/xampp/htdocs/system/Frontend/src/Bootstrap/v5_3_3/Bootstrap.php)
- **Documentación oficial de Bootstrap**: [Bootstrap 5.3](https://getbootstrap.com/docs/5.3/)

## Contribuir

Para agregar nuevos componentes o mejorar la documentación, consulta la estructura existente y sigue los estándares establecidos en los componentes actuales.

---

**Última actualización**: Diciembre 2025  
**Versión de Bootstrap**: 5.3.3
