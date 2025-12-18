<?php

declare(strict_types=1);

namespace Higgs\Frontend\Contracts;

use Higgs\Html\Tag\TagInterface;

/**
 * Interfaz que TODOS los componentes de Bootstrap deben implementar
 * 
 * Esta interfaz fuerza el patrón arquitectónico estándar donde:
 * 1. El constructor recibe un array de opciones
 * 2. El método render() retorna TagInterface
 * 
 * Todos los componentes (Alert, Button, Card, Modal, etc.) DEBEN implementar esta interfaz.
 * 
 * @package Higgs\Frontend\Contracts
 * @since 2.0.0
 * 
 * @example
 * class Alert extends AbstractComponent implements ComponentInterface
 * {
 *     public function __construct(array $options = []) { }
 *     public function render(): TagInterface { }
 * }
 */
interface ComponentInterface
{
    /**
     * Constructor que DEBE recibir array de opciones
     * 
     * El array de opciones es flexible y cada componente define qué opciones acepta.
     * Siempre debe tener un valor por defecto de array vacío para permitir instanciación sin parámetros.
     * 
     * @param array $options Array asociativo de opciones de configuración
     * 
     * @example
     * new Alert(['content' => 'Mensaje', 'type' => 'danger']);
     */
    public function __construct(array $options = []);

    /**
     * Renderiza el componente y retorna TagInterface
     * 
     * Este método construye y retorna el HTML del componente como objeto TagInterface.
     * Debe procesar todas las opciones del constructor y generar el HTML final.
     * 
     * @return TagInterface El elemento HTML renderizado
     * 
     * @example
     * $alert = new Alert(['content' => 'Error']);
     * echo $alert->render(); // Genera el HTML
     */
    public function render(): TagInterface;
}
