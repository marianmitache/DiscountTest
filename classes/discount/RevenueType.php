<?php

namespace discount;

use discount\TypeInterface;

class RevenueType implements TypeInterface {

    const DISCOUNT_VALUE = 0.1;
    const MIN_REVENUE = 1000;
    
    public function addDiscount(&$data, $item = null){
        $data['discount'] += $data['total'] * self::DISCOUNT_VALUE;
        array_push($data['discount_reasons'], 'Revenue Discount');
  
    }

}
