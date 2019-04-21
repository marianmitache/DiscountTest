<?php

namespace validator;

class OrderValidator {

    private $orderFields = ["id", "customer-id", "items", "total"];
    private $itemsFields = ["product-id", "quantity", "unit-price", "total"];

    public function validate($data) {
        $this->validateOrder($data);
        if (!is_array($data['items'])) {
            \OrderProcessor::responseError("invalid order structure");
        }
        foreach ($data['items'] as $item) {
            $this->validateItem($item);
        }
    }

    private function validateOrder($data) {
        foreach ($this->orderFields as $field) {
            if (!isset($data[$field])) {
                \OrderProcessor::responseError("invalid order structure");
            }
        }
    }

    private function validateItem($item) {
        foreach ($this->itemsFields as $field) {
            if (!isset($item[$field])) {
                \OrderProcessor::responseError("invalid order structure");
            }
        }
    }

}
