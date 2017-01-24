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

        foreach($scannedItems as $itemName => $quantity) {

            $itemRow = $this->findItemFullPricing($itemName);

            $itemOffer = $this->getItemOffer($itemRow);


            if(is_numeric($itemOffer[0])) {

                $totalPricePerItemOffer = $this->calculateTotalPerItemOffer($itemRow, $quantity);

                $totalShopping[] = array('item' => $itemName, 'quantity' => $quantity, 'total' => $totalPricePerItemOffer);

            } else {

                $totalPricePerItemNoOffer = $this->calculateTotalPerItemNoOffer($itemRow, $quantity);

                $totalShopping[] = array('item' => $itemName, 'quantity' => $quantity, 'total' => $totalPricePerItemNoOffer);

            }
        }


        return $totalShopping;
    }


    public function findItemFullPricing($itemName) {

        foreach($this->productsTable as $row ) {

            if($key = array_search($itemName, $row)) {

                return $row;
            }
        }
    }

    public function getItemOffer($itemRow) {

        $itemOffer = explode( '|',$itemRow['offer'] );
        return $itemOffer;

    }

    public function calculateTotalPerItemOffer($itemRow, $quantity){

        $itemOffer = $this->getItemOffer($itemRow);
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

