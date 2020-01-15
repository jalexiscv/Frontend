<?php

declare(strict_types=1);


namespace Higgs\Frontend\Bootstrap;

use Higgs\Frontend\Builder;
use Higgs\Frontend\BuilderInterface;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;
use Higgs\Html\Tag\TagInterface;

class Builder_5_3_3 extends Builder implements BuilderInterface
{
    public function get_Version(): string
    {
        return "5.3.3";
    }

    /**
     * Implementa mágicamente todos los métodos estáticos de Bootstrap
     * @param string $name Nombre del método llamado
     * @param array $arguments Argumentos del método
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        if (method_exists(Bootstrap::class, $name)) {
            return Bootstrap::$name(...$arguments);
        }
        throw new \BadMethodCallException("El método $name no existe en Bootstrap");
    }
}
