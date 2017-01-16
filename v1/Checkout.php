<?php

// php -S localhost:8000

class Checkout {


    public $productsTable;
    private $basket = array();


    public function __construct($productsTable) {
        $this->productsTable = $productsTable;
    }

    private function scan() {

        print_r(array_values($this->basket));


    }

    private function findItem($itemKey) {

        foreach($this->productsTable as $row ) {

            if($key = array_search($itemKey, $row)) {

                return $row;
            }

        }
    }

    private function display() {

        print_r($this->basket);

    }

    public function checkout() {

        $this->scan(); // scan basket for the same items rows

        //$this->dispay(); // display all items and price to pay after offers have been done


    }

    public function add($item) {


        $itemRow = $this->findItem($item);

        array_push($this->basket, $itemRow);


    }

    public function getBasket() {
        return $this->basket;
    }


}


