<?php

namespace dataList;

class Customers extends AbstractData {
    
    public function findCustomerRevenue($customerId) {
        foreach ($this->dataList() as $key => $value) {
            if ($value['id'] == $customerId) {
                return $value['revenue'];
            }
        }
        \OrderProcessor::responseError("customer not found");
    }
    
    protected function getFileName() {
        return "customers";
    }

}
