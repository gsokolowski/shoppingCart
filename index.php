<?php

// Call
// php -S localhost:8000
// and go to http://localhost:8000


// How this works
// 0. user creates products table with items pricing and offer
// 1. User is loading products information setup
// 2. user scans item by item by loading items in any order
// 2. when scaning is finished user calls checkout() method and receives associative array with info about
// quantity and price per type of item

// I tried to keep all functions as small a possible and assign to them single responsibility so they can be testable

// Just read function names to understand what program does



require('Checkout.php');


$productsTable = array (
    array(
        'item' => 'strawberries',
        'price' => 50,
        'offer' => '3|130', // 3 strawberries cost 130
    ),
    array(
        'item' => 'biscuits',
        'price' => 30,
        'offer' => '2|45', // 2 biscuits cost 45
    ),
    array(
        'item' => 'bread',
        'price' => 20,
        'offer' => '|', // no offer
    ),
    array(
        'item' => 'bananas',
        'price' => 15,
        'offer' => '|', // no offer
    ),
);

// Laad products information as table (item, price, offer)
$item = new Checkout($productsTable);


// scan Item by Item
$cart = $item->scan('strawberries'); // scanning first item
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

$shopping = $item->checkout($cart); // returns associative array with processed prices per type of item


// display shopping
print_r($shopping);



// Obviously this could be displayed in html and layout as table with rows and columns
// but this is not part of this exercise



// How to test this?

// I made all methods of class Checkout public to be able to test them all
// How?
// For example you call scan() passing bread and you expect that class property array $cart will contain one element bread.
// If this is true test passed
// you scan bread again -> you should have 2 bread in $cart

// for method findItemFullPricing() pass itemName and you should expect to get Full Pricing

// etc.



