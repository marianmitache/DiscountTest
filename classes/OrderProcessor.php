<?php

use discount\CreateDiscount;
use validator\OrderValidator;

class OrderProcessor {

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function process() {
        $this->validateOrder();
        $discount = new CreateDiscount($data);
        $discount->generate($this->data);
    }

    static public function responseOk($message) {
        echo json_encode([
            "status" => "OK",
            "message" => $message
        ]);
        die();
    }

    static public function responseError($message) {
        echo json_encode([
            "status" => "ERROR",
            "message" => $message
        ]);
        die();
    }

    private function validateOrder() {
        $orderValidator = new OrderValidator();
        $orderValidator->validate($this->data);
    }

}
