<?php

namespace discount;

use dataList\Customers;
use dataList\Products;

class CreateDiscount {

    const TOOLS_CATEGORY = 1;
    const SWITCHES_CATEGORY = 2;

    private $customers;
    private $products;
    private $gift;
    private $cheapeast;
    private $revenue;
    
    protected $toolsQuantity;

    public function generate($data) {

        $this->customers = new Customers();
        $this->products = new Products();
        $this->gift = new GiftType();
        $this->cheapeast = new CheapestProductType();
        $this->revenue = new RevenueType(); 
        
        $data['discount'] = null;
        $data['discount_reasons'] = [];
        
        $tools = [];
        
        foreach ($data['items'] as $key => $item) {
            if ($this->products->findCategoryByProductId($item['product-id']) == self::TOOLS_CATEGORY) {
                $this->toolsQuantity += $item['quantity'];
                $this->quantityPrice[] = [$item['quantity'] => (float) $item['unit-price']];
                $tools[$key] = $item['unit-price'];
            } elseif (($this->products->findCategoryByProductId($item['product-id']) == self::SWITCHES_CATEGORY) && ($item['quantity'] >= GiftType::MIN_QUANTITY)) {
                $this->gift->addDiscount($data, $key);
            }
        }
        if ($this->toolsQuantity >= CheapestProductType::MIN_QUANTITY) {
            $this->cheapeast->addDiscount($data, $tools);
        }
        if ($this->customers->findCustomerRevenue($data['customer-id']) >= RevenueType::MIN_REVENUE) {
            $this->revenue->addDiscount($data);
        }
        
        $data['total'] = 0;
        
        foreach($data['items'] as $item){
            $data['total'] += $item['total'];
        }
        
        $data['total_with_discount'] = $data['total'] - $data['discount'];
      
        \OrderProcessor::responseOk($data);
    }

}
