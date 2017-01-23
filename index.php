<?php

// Just call
// php -S localhost:8000
// and go to http://localhost:8000



require('Checkout.php');


$productsTable = array (
    array(
        'item' => 'strawberries',
        'price' => 50,
        'offer' => '3|130',
    ),
    array(
        'item' => 'biscuits',
        'price' => 30,
        'offer' => '2|45',
    ),
    array(
        'item' => 'bread',
        'price' => 20,
        'offer' => '|',
    ),
    array(
        'item' => 'bananas',
        'price' => 15,
        'offer' => '|',
    ),
);

// Laad products information as table (item, price, offer)
$item = new Checkout($productsTable);


// scan Item by Item
$cart = $item->scan('strawberries');
$cart = $item->scan('biscuits');
$cart = $item->scan('bread');
$cart = $item->scan('strawberries');
$cart = $item->scan('bread');
$cart = $item->scan('strawberries');
$cart = $item->scan('strawberries');
$cart = $item->scan('bananas');
$cart = $item->scan('strawberries');
$cart = $item->scan('biscuits');
$cart = $item->scan('bananas');
$cart = $item->scan('bread');
$cart = $item->scan('biscuits');


//$cart = $item->scan('bananas');

$shopping = $item->checkout($cart);

print_r($shopping);



