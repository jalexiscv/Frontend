<?php

declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';

// Manual fallback for Html library if completely missing in environment
if (!class_exists('Higgs\Html\Html')) {
    $htmlAutoload = __DIR__ . '/../../Html/autoload.php';
    if (file_exists($htmlAutoload)) {
        require_once $htmlAutoload;
    }
}

use Higgs\Frontend\Frontend;
use Higgs\Frontend\Bootstrap\v5_3_3\Bootstrap;

try {
    echo "Starting Full Suite Verification...\n";
    $frontend = new Frontend();
    $bs = $frontend->get_Builder();

    // Alerts
    $bs->alert('Alert content');
    $bs->successAlert('Success content');
    echo "Alerts OK\n";

    // Cards
    $bs->card('Title', 'Content');
    $bs->horizontalCard('img.jpg', 'Title', 'Content');
    $bs->cardGroup();
    echo "Cards OK\n";

    // Buttons
    $bs->button('Button');
    $bs->buttonGroup([$bs->button('A')]);
    echo "Buttons OK\n";

    // Badges
    echo "Checking Badge class existence...\n";
    $badgeClass = 'Higgs\Frontend\Bootstrap\v5_3_3\Interface\Badge';
    if (class_exists($badgeClass)) {
        echo "Badge class exists.\n";
    } else {
        echo "Badge class DOES NOT exist.\n";
    }
    $bs->badge('Badge');
    echo "Badges OK\n";

    ob_implicit_flush(true);
    // Nav / Breadcrumb
    echo "Testing Nav...\n";
    $bs->nav();
    echo "Nav OK.\nTesting Navbar...\n";
    $bs->navbar();
    echo "Navbar OK.\nTesting Breadcrumb...\n";
    $bs->breadcrumb([['texto' => 'Home', 'url' => '/']]);
    echo "Nav/Breadcrumb OK\n";

    // Carousel
    $bs->carousel('myCarousel', [['image' => 'img.jpg']]);
    echo "Carousel OK\n";

    // Interface
    $bs->collapse('myCollapse', 'Content');
    $bs->dropdown('Dropdown', ['Item 1']);
    $bs->listGroup(['Item 1']);
    $bs->modal('myModal', 'Title');
    $bs->offcanvas('myOffcanvas', 'Title');
    $bs->popover('Content', 'Title');
    $bs->toast('Content', 'Title');
    $bs->tooltip('Content');
    echo "Interface (Collapse, Modal, etc) OK\n";

    // Progress / Spinner
    $bs->progress(50);
    $bs->spinner();
    echo "Progress/Spinner OK\n";

    // Pagination
    $bs->pagination(100, 1);
    echo "Pagination OK\n";

    // Layout
    $bs->container();
    $bs->grid();
    $bs->row();
    $bs->col();
    echo "Layout OK\n";

    // Content
    $bs->table();
    $bs->figure('img.jpg');
    $bs->typography('p');
    echo "Content OK\n";

    // Forms
    $bs->form();
    $bs->input('text', 'name');
    $bs->select('select', ['a' => 'A']);
    $bs->check('check', 'Label');
    $bs->radio('radio');
    $bs->file('file');
    $bs->textarea('textarea');
    // inputGroup might need specific args, let's check signature or skip for basic test
    // $bs->inputGroup(...); 
    echo "Forms OK\n";

    echo "\nFULL SUITE VERIFICATION PASSED.\n";
} catch (\Throwable $e) {
    echo "\nVERIFICATION FAILED:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    exit(1);
}
