<?php

namespace App\Services;
use Auth;
use App\Services\StockManager;

class DifferenceQuantityValidator extends ProductQuantityValidator {

    protected $stockManager;

    public function __construct(StockManager $stockManager)
    {
        $this->stockManager = $stockManager;
    }

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
        $parts = explode('.', $attribute);
        $difference = $this->stockManager->calculateDifference($parts[1], $value);

        if($difference <= 0) {
            return true;
        }
        return parent::validate($parts[1], $difference, $parameters, $validator);
    }
}