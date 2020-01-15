<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

use Higgs\Frontend\Frontend;

try {
    echo "Testing Autoloading...\n";

    // 1. Test Frontend instantiation
    $frontend = new Frontend();
    echo "Frontend class loaded successfully.\n";

    // 2. Test Builder
    $builder = $frontend->get_Builder();
    echo "Builder loaded: " . get_class($builder) . "\n";
    echo "Builder Version: " . $builder->get_Version() . "\n";

    echo "\nVerification PASSED.\n";
    exit(0);
} catch (\Throwable $e) {
    echo "\nVerification FAILED: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
