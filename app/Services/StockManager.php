<?php

namespace App\Services;

use App\Product;
use Auth;

class StockManager {

    /**
     * Update product stock.
     *
     * @param $product_id
     * @param $amount
     */
    public function updateStock($product_id, $amount)
    {
        $product = Product::findOrFail($product_id);
        $product->stock -= $amount;
        $product->save();
    }

    /**
     * Add difference to stock.
     *
     * @param $product_id
     * @param $amount
     */
    public function updateDifference($product_id, $amount)
    {
        $difference = $this->calculateDifference($product_id, $amount);
        $this->updateStock($product_id, $difference);
    }

    /**
     * Calculate the difference between ordered and available amount.
     *
     * @param $product_id
     * @param $amount
     * @return mixed
     */
    public function calculateDifference($product_id, $amount)
    {
        $oldAmount = Auth::user()->getActiveOrder()->products()->findOrFail($product_id)->pivot->quantity;
        $difference = $amount - $oldAmount;
        return $difference;
    }
}