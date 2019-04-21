<?php

namespace discount;

class CheapestProductType implements TypeInterface {

    const DISCOUNT_VALUE = 0.2;
    const MIN_QUANTITY = 2;

    public function addDiscount(&$data, $item = null) {
        foreach ($this->getChepeastItemsKeys($item) as $key) {
            $data['discount'] += $data['items'][$key]['unit-price'] * self::DISCOUNT_VALUE * $data['items'][$key]['quantity'];
            array_push($data['discount_reasons'], 'Chepeast Product Discount');
        }
    }

    private function getChepeastItemsKeys($tools) {
        $min_price = min($tools);
        $key = array_keys($tools, $min_price);
        return $key;
    }

}
