<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
// Need to load the Html library manually if not using Composer properly or in this context
// Assuming the Html library is available via its own autoloader or similar. 
// Ideally we would use composer autoload if available. 
// For this test, we might need to mock or ensure Higgs\Html is loaded.
// Check if user environment has it. 
// Assuming C:\xampp\htdocs\system\Html is a sibling and autoloadable?
// Let's try to include it manually for the test if it's not loaded.
if (!class_exists('Higgs\Html\Html')) {
    $htmlAutoload = __DIR__ . '/../../Html/autoload.php';
    if (file_exists($htmlAutoload)) {
        require_once $htmlAutoload;
    }
}

use Higgs\Frontend\Frontend;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;

try {
    echo "Testing New Components...\n";
    $frontend = new Frontend();
    $bs = $frontend->get_Builder(); // This returns Builder_5_3_3 which redirects to Bootstrap facade

    // 1. Layout
    echo "Testing Col... ";
    $bs->col('Content');
    echo "OK\n";

    echo "Testing Row... ";
    $bs->row();
    echo "OK\n";

    // 2. Interface
    echo "Testing Collapse... ";
    $bs->collapse('id', 'content');
    echo "OK\n";

    // 3. Content
    echo "Testing Figure... ";
    $bs->figure('img.jpg', 'Caption');
    echo "OK\n";

    // 4. Forms
    echo "Testing Form... ";
    $bs->form();
    echo "OK\n";

    echo "Testing Input... ";
    $bs->input('text', 'myinput');
    echo "OK\n";

    echo "Testing Select... ";
    $bs->select('myselect', ['a' => 'A']);
    echo "OK\n";

    echo "Testing Radio... ";
    $bs->radio('myradio');
    echo "OK\n";

    echo "Testing File... ";
    $bs->file('myfile');
    echo "OK\n";

    echo "Testing Textarea... ";
    $bs->textarea('mytextarea');
    echo "OK\n";

    echo "\nAll Phase 2 Components Verified Successfully.\n";
} catch (\Throwable $e) {
    echo "\nVerification FAILED: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    exit(1);
}
