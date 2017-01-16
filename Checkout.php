<?php

// php -S localhost:8000

class Checkout {


    public $productsTable;
    private $basket = array();


    public function __construct($productsTable) {
        $this->productsTable = $productsTable;
    }

    public function checkout() {

        foreach($this->basket as $basketItem) {

            $scanned = (array_count_keys($basketItem));
            print_r($scanned);

//            $finalCart = array();
//
//            foreach($scanned as $item => $quantity) {
//                $row = $this->findItem($item);
//                echo '<br/>';
//                echo $item.' '.$quantity.' : '. $row['price'].' * '.$row['offer'].' * ';
//
//
//            }
        }


    }

    private function findItem($itemKey) {

        foreach($this->productsTable as $row ) {

            if($key = array_search($itemKey, $row)) {

                return $row;
            }

        }
    }


    public function scan($item) {

        $itemRow = $this->findItem($item);
        array_push($this->basket, $itemRow);

        //print_r($this->basket);

    }

    public function getBasket() {
        return $this->basket;
    }


}


