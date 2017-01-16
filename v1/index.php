<?php

require('Checkout.php');


$productsTable = array (
    array(
        'item' => 'strawberries',
        'price' => 50,
        'offer' => '[3] = 130',
    ),
    array(
        'item' => 'biscuits',
        'price' => 30,
        'offer' => '[2] = 45',
    ),
    array(
        'item' => 'bread',
        'price' => 20,
        'offer' => null,
    ),
    array(
        'item' => 'bananas',
        'price' => 15,
        'offer' => null,
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
$one->add('biscuits');
$one->add('biscuits');

$basket = $one->getBasket();
print_r($basket);

$one->checkout();