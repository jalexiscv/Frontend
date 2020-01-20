<?php
require_once __DIR__ . '/../autoload.php';
// Mock Html class if autoload is insufficient or specific environment needed
// Assuming autoload works based on other tests

use Higgs\Frontend\Bootstrap\v5_3_3\Interface\Card;
use Higgs\Html\Html;

echo "--- START TEST ---\n";

// Case 1: Strings (Should work)
echo "Case 1: Strings\n";
$card1 = new Card([
    'headerTitle' => 'Title 1',
    'headerButtons' => ['<button>Btn1</button>']
]);
echo $card1->render() . "\n\n";

// Case 2: Tag Objects (Should work)
echo "Case 2: Tag Objects\n";
$btn = Html::tag('button', [], 'Btn2');
$card2 = new Card([
    'headerTitle' => 'Title 2',
    'headerButtons' => [$btn]
]);
echo $card2->render() . "\n\n";

// Case 3: Raw Arrays (Suspected Issue)
echo "Case 3: Raw Arrays (Data)\n";
$card3 = new Card([
    'headerTitle' => 'Title 3',
    'headerButtons' => [
        ['label' => 'Btn3', 'class' => 'btn']
    ]
]);
echo $card3->render() . "\n";

echo "--- END TEST ---\n";
