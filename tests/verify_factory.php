<?php
require_once __DIR__ . '/autoload.php';

use Higgs\Frontend\Frontend;

echo "Testing Dynamic Factory...\n";

try {
    echo "1. Default instantiation (Bootstrap 5.3.3)...\n";
    $frontend = new Frontend();
    $builder = $frontend->get_Builder();
    echo "Class: " . get_class($builder) . "\n";

    if ($builder instanceof \Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap) {
        echo "PASS: Correct instance.\n";
    } else {
        echo "FAIL: Incorrect instance.\n";
        exit(1);
    }

    echo "\n2. Explicit instantiation (Bootstrap, 5.3.3)...\n";
    $frontend2 = new Frontend('bootstrap', '5.3.3');
    $builder2 = $frontend2->get_Builder();
    echo "Class: " . get_class($builder2) . "\n";

    if ($builder2 instanceof \Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap) {
        echo "PASS: Correct instance.\n";
    } else {
        echo "FAIL: Incorrect instance.\n";
        exit(1);
    }

    echo "\n3. Testing Unknown Framework (Should Fail)...\n";
    try {
        new Frontend('Tailwind', '1.0');
        echo "FAIL: Should have thrown exception.\n";
        exit(1);
    } catch (InvalidArgumentException $e) {
        echo "PASS: Caught expected exception: " . $e->getMessage() . "\n";
    }
} catch (Throwable $e) {
    echo "FATAL ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
