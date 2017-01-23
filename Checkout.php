<?php


class Checkout {


    public $productsTable;
    private $cart = array();


    public function __construct($productsTable) {
        $this->productsTable = $productsTable;
    }

    public function scan($item) {

        array_push($this->cart, $item);
        return $this->cart;

    }

    public function checkout($cart) {

        $scannedItems = (array_count_values($cart));


        $totalShopping = [];

        foreach($scannedItems as $item => $quantity) {

            $itemRow = $this->findItemFullPricing($item);

            $itemOffer = $this->getItemOffer($itemRow);


            if($itemOffer[0] != 0 and is_numeric($itemOffer[0])) {

                $totalPricePerItemOffer = $this->calculateTotalPerItemOffer($itemRow, $quantity, $itemOffer);

                $totalShopping[] = array('items' => $item, 'quantity' => $quantity, 'total' => $totalPricePerItemOffer);

            } else {

                $totalPricePerItemNoOffer = $this->calculateTotalPerItemNoOffer($itemRow, $quantity);

                $totalShopping[] = array('items' => $item, 'quantity' => $quantity, 'total' => $totalPricePerItemNoOffer);

            }
        }


        return $totalShopping;
    }

    private function findItemFullPricing($itemKey) {

        foreach($this->productsTable as $row ) {

            if($key = array_search($itemKey, $row)) {

                return $row;
            }
        }
    }

    private function getItemOffer($itemRow) {

        $itemOffer = explode( '|',$itemRow['offer'] );
        return $itemOffer;

    }

    public function calculateTotalPerItemOffer($itemRow, $quantity, $itemOffer){

        $mod = $quantity % $itemOffer[0];

        if($mod == 0) {

            $offerQuantity = $quantity/$itemOffer[0];
            $price = $offerQuantity * $itemOffer[1];


        } else {

            $offerQuantity = floor($quantity/$itemOffer[0]); // * offer price
            $extraItems = $mod; // * normal price
            $price = ($offerQuantity * $itemOffer[1] ) + ($extraItems * $itemRow['price']);

        }
        return $price;

    }

    public function calculateTotalPerItemNoOffer($itemRow, $quantity) {

        return $price = $quantity * $itemRow['price'];

    }



}

