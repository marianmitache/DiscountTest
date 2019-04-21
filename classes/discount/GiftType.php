<?php

namespace discount;

use discount\TypeInterface;

class GiftType implements TypeInterface {

    const MIN_QUANTITY = 5;

    function addDiscount(&$data, $item = null) {

        $freeQuantity = intval($data['items'][$item]['quantity'] / self::MIN_QUANTITY);
        $data['items'][$item]['quantity'] = (string) ($data['items'][$item]['quantity'] + $freeQuantity);
        $data['items'][$item]['total'] = (string)($data['items'][$item]['quantity'] * $data['items'][$item]['unit-price']);
        $data['discount'] += $freeQuantity * $data['items'][$item]['unit-price'];
        array_push($data['discount_reasons'], 'over 5 Switchs products');

        return $data;
    }

}
