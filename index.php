<?php

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
        'offer' => '',
    ),
    array(
        'item' => 'bananas',
        'price' => 15,
        'offer' => '',
    )
);


//print_r($productsTable);

//foreach($productsTable as $row ) {
//    $key = 'bread';
//
//    if($key = array_search($key, $row)) {
//        var_dump($row);
//        echo '<br />';
//    }
//}



$one = new Checkout($productsTable);
$one->scan('biscuits');
$one->scan('bread');
$one->scan('biscuits');
$one->scan('strawberries');
$one->scan('strawberries');
$one->scan('strawberries');
$one->scan('strawberries');
$one->scan('biscuits');
$one->scan('bread');
$one->scan('bananas');

$basket = $one->getBasket();
//print_r($basket);

$one->checkout();