<?php

declare(strict_types=1);

/**
 * Autoload manual compatible con PSR-4 para Higgs\Frontend
 * @see ARCHITECTURE.md
 */

// 1. Intentar cargar Composer si existe en el entorno global o local
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// 2. Fallback Manual / Dev Override for Higgs\Html
spl_autoload_register(function ($class) {
    if (str_starts_with($class, 'Higgs\\Html\\')) {
        $relative_class = substr($class, strlen('Higgs\\Html\\'));
        $file = __DIR__ . '/../Html/src/' . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// 2. Fallback Manual (Standalone)
spl_autoload_register(function ($class) {
    // PREFIJO DEL NAMESPACE
    $prefix = 'Higgs\\Frontend\\';

    // DIRECTORIO BASE (src/)
    $base_dir = __DIR__ . '/src/';

    // ¿La clase utiliza el prefijo?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // No, mover al siguiente autoloader registrado
        return;
    }

    // Obtener el nombre relativo de la clase
    $relative_class = substr($class, $len);

    // Reemplazar el prefijo del namespace con el directorio base,
    // reemplazar separadores de namespace con separadores de directorio
    // y añadir .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si el archivo existe, requerirlo
    if (file_exists($file)) {
        require $file;
    }
});
