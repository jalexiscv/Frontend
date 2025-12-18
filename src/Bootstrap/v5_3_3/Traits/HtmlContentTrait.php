<?php

declare(strict_types=1);

namespace Higgs\Frontend\Bootstrap\v5_3_3\Traits;

use Higgs\Html\Html;

/**
 * Trait HtmlContentTrait
 * 
 * Proporciona funcionalidad centralizada para manejar contenido HTML sin escapar
 * en todos los componentes Bootstrap de forma consistente y segura.
 * 
 * ## ¿POR QUÉ EXISTE ESTE TRAIT?
 * 
 * Este trait fue creado para resolver la necesidad de incluir HTML sin escapar
 * (como íconos Font Awesome) en los componentes Bootstrap, manteniendo la
 * seguridad por defecto y evitando duplicación de código.
 * 
 * **Problema original:**
 * ```php
 * // Esto escapaba el HTML (mostraba literalmente "<i>...</i>")
 * $btn = $bootstrap->button(['content' => '<i class="fas fa-user"></i> Usuario']);
 * ```
 * 
 * **Soluciones consideradas:**
 * 1. ❌ Detección automática de HTML - INSEGURO (no distingue HTML malicioso)
 * 2. ❌ Código duplicado en cada componente - NO MANTENIBLE
 * 3. ✅ Trait reutilizable con parámetro explícito - SEGURO Y ESCALABLE
 * 
 * **Ventajas del trait:**
 * - ✅ Código DRY (Don't Repeat Yourself) - Una sola implementación
 * - ✅ Consistencia entre componentes
 * - ✅ Fácil mantenimiento y actualización
 * - ✅ Seguridad por diseño (requiere intención explícita)
 * 
 * ## SEGURIDAD
 * 
 * El parámetro 'htmlContent' requiere que el desarrollador declare EXPLÍCITAMENTE
 * que el HTML es confiable, evitando vulnerabilidades XSS por conversiones automáticas.
 * 
 * **NUNCA usar htmlContent con entrada de usuario:**
 * ```php
 * // ⚠️ PELIGROSO - Vulnerabilidad XSS
 * $userInput = $_POST['html'];
 * $unsafe = $bootstrap->button(['htmlContent' => $userInput]); // ❌ NO HACER
 * 
 * // ✅ SEGURO - HTML hardcoded
 * $safe = $bootstrap->button(['htmlContent' => '<i class="fas fa-save"></i> Guardar']);
 * ```
 * 
 * ## EJEMPLOS DE USO
 * 
 * ### Ejemplo 1: Botón con ícono
 * ```php
 * $editBtn = $bootstrap->button([
 *     'htmlContent' => '<i class="fa-sharp fa-light fa-pen-to-square"></i> Editar',
 *     'variant' => 'warning',
 *     'size' => 'sm'
 * ]);
 * ```
 * 
 * ### Ejemplo 2: Badge con ícono de notificación
 * ```php
 * $notificationBadge = $bootstrap->badge([
 *     'htmlContent' => '<i class="fas fa-bell"></i> 5',
 *     'variant' => 'danger'
 * ]);
 * ```
 * 
 * ### Ejemplo 3: Alert con HTML formateado
 * ```php
 * $alert = $bootstrap->alert([
 *     'htmlContent' => '<strong>¡Atención!</strong> Este es un <em>mensaje importante</em>.',
 *     'type' => 'warning',
 *     'dismissible' => true
 * ]);
 * ```
 * 
 * ### Ejemplo 4: Container con estructura HTML compleja
 * ```php
 * $container = $bootstrap->container([
 *     'htmlContent' => '
 *         <div class="row">
 *             <div class="col-md-6">Columna 1</div>
 *             <div class="col-md-6">Columna 2</div>
 *         </div>
 *     '
 * ]);
 * ```
 * 
 * ### Ejemplo 5: Card con contenido HTML
 * ```php
 * $card = $bootstrap->card([
 *     'headerTitle' => 'Producto #1234',
 *     'htmlContent' => '<p>Descripción con <strong>formato</strong> HTML.</p>',
 *     'footer' => 'Última actualización: hoy'
 * ]);
 * ```
 * 
 * ## COMPARACIÓN: content vs htmlContent
 * 
 * | Parámetro | HTML Escapado | Cuándo usar |
 * |-----------|---------------|-------------|
 * | `content` | ✅ Sí | Contenido de usuario, texto dinámico |
 * | `htmlContent` | ❌ No | HTML confiable (hardcoded), íconos |
 * 
 * ```php
 * // content - HTML escapado (SEGURO por defecto)
 * $btn1 = $bootstrap->button(['content' => '<script>alert("XSS")</script>']);
 * // Resultado: &lt;script&gt;alert("XSS")&lt;/script&gt;
 * 
 * // htmlContent - HTML sin escapar (usar SOLO con HTML confiable)
 * $btn2 = $bootstrap->button(['htmlContent' => '<i class="fas fa-user"></i> Usuario']);
 * // Resultado: <i class="fas fa-user"></i> Usuario
 * ```
 * 
 * ## IMPLEMENTACIÓN EN COMPONENTES
 * 
 * Para usar este trait en un componente:
 * 
 * ```php
 * use Higgs\Frontend\Bootstrap\v5_3_3\Traits\HtmlContentTrait;
 * 
 * class MiComponente extends AbstractComponent
 * {
 *     use HtmlContentTrait;
 *     
 *     private mixed $content = null;
 *     
 *     public function __construct(array $options = [])
 *     {
 *         // Procesar contenido usando el trait
 *         $this->content = $this->processContent($options);
 *         
 *         // ... resto del constructor
 *     }
 * }
 * ```
 * 
 * ## COMPONENTES QUE USAN ESTE TRAIT
 * 
 * Actualmente implementado en 14 componentes:
 * - Interface: Button, Alert, Badge, Tooltip, Popover, Toast, Collapse
 * - Layout: Container, Col, Row, Grid
 * - Content: Typography
 * - Form: Form
 * - Navigation: Navbar
 */
trait HtmlContentTrait
{
    /**
     * Procesa el contenido del componente, manejando htmlContent y content.
     * 
     * Si se proporciona 'htmlContent', se convierte automáticamente a Html::raw()
     * para evitar el escape. Si se proporciona 'content', se usa tal cual (escapado).
     * 
     * Prioridad: htmlContent > content > null
     * 
     * @param array $options Las opciones del componente
     * @return mixed El contenido procesado (Html::raw() o string o null)
     */
    protected function processContent(array $options): mixed
    {
        if (isset($options['htmlContent'])) {
            // Convertir htmlContent a Html::raw() automáticamente
            return Html::raw($options['htmlContent']);
        }

        // Usar content normal (será escapado por AbstractTag)
        return $options['content'] ?? null;
    }
}
