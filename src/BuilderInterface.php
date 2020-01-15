<?php

declare(strict_types=1);


namespace Higgs\Frontend;

interface BuilderInterface
{
    /**
     * Obtiene la versión del builder
     * @return string Versión del builder
     */
    public function get_Version(): string;

    /**
     * Método mágico para manejar llamadas a métodos no definidos
     * @param string $name Nombre del método llamado
     * @param array $arguments Argumentos del método
     * @return mixed
     */
    public function __call(string $name, array $arguments);
}
