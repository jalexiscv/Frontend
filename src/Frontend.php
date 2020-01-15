<?php

declare(strict_types=1);

namespace Higgs\Frontend;

use Higgs\Frontend\BuilderInterface;

/**
 * Class Frontend.
 *   La existencia de esta clase implica:
 *   1). La modificación el archivo system/Common.php: Este archivo contiene funciones de ayuda globales. Se agrego una
 *       función helper para la clase Html: if (!function_exists('html')){function html(){return new \Higgs\Html\Html();}}
 *   2). La modificación de system/bootstrap.php: para la clase se cargue automáticamente al iniciar el sistema, se agrego
 *       esta línea al final del archivo: require_once SYSTEM_PATH . 'Html/Html.php';
 *
 */
class Frontend
{

    /**
     * @var string
     */
    protected $framework;

    /**
     * @var string
     */
    protected $version;


    /**
     * Frontend constructor.
     * @param $framework
     * @param $version
     */

    protected $builder;

    public function __construct($frontend = 'bootstrap', $version = '5.3.3')
    {
        $frontend = ucfirst($frontend);
        $version = str_replace('.', '_', $version);
        $builderClass = "\\Higgs\\Frontend\\Bootstrap\\Builder_5_3_3";
        $this->builder = new $builderClass();
    }

    /**
     * Este metodo retorna el buider por defecto a
     */
    public function get_Builder()
    {
        return $this->builder;
    }
}
