<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$orderMessage = @json_decode(file_get_contents("php://input"), true);


spl_autoload_register(function ($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
});

if(!$orderMessage){
    OrderProcessor::responseError("Invalid JSON");
}

$order = new OrderProcessor($orderMessage);
$order->process();
