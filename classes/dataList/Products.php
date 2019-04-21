<?php

namespace dataList;

class Products extends AbstractData {

    public function findCategoryByProductId($productId) {

        foreach ($this->dataList() as $key => $value) {
            if ($value['id'] == $productId) {
                return $value['category'];
            }
        }
        \OrderProcessor::responseError("product not found");
    }

    protected function getFileName() {
        return "products";
    }

}
