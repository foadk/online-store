<?php

namespace App\Services;

use App\Product;

class ProductQuantityValidator {

    /**
     * Validate the quantity of the requested item.
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $quantity = Product::findOrFail($attribute)->stock;
        if($value > $quantity) return false;
        return true;
    }

}