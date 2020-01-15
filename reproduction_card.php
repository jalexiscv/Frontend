<?php

require_once __DIR__ . '/../bootstrap.php';

use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Card;
use Higgs\Html\Html;

// Mocking necessary parts if bootstrap doesn't cover everything
// Assuming bootstrap logic sets up autoloader.

try {
    $code = '<strong>Unescaped Content</strong>';

    $card = new Card([
        'title' => 'Test Title',
        'htmlContent' => $code,
        'image' => '/test.jpg',
        'imagePosition' => 'top'
    ]);

    echo $card->render();
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
