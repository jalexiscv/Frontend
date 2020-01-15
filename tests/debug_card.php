<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

// Manual fallback for Html library
if (!class_exists('Higgs\Html\Html')) {
    $htmlAutoload = __DIR__ . '/../../Html/autoload.php';
    if (file_exists($htmlAutoload)) {
        require_once $htmlAutoload;
    }
}

use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Card;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;

echo "Testing Autoload of Card...\n";

try {
    if (class_exists(Card::class)) {
        echo "Card class exists.\n";
    } else {
        echo "Card class NOT found.\n";
    }

    echo "Testing Instantiation via Facade...\n";
    $card = Bootstrap::card('Test Title', 'Test Content');
    echo "Card created via Facade.\n";
    echo $card->render() . "\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
