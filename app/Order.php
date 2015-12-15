<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'ship_address',
        'shipped',
        'paid'
    ];

    /**
     * get the products associated with this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')
            ->withTimestamps()
            ->withPivot('quantity', 'total_price');
    }

    /**
     * get the ordering user for this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * If order has specified product.
     *
     * @param $product_id
     * @return bool
     */
    public function hasProduct($product_id)
    {
        if($this->products()->find($product_id)) {
            return true;
        }
        return false;
    }

    /**
     * If this order has any products.
     *
     * @return bool
     */
    public function isEmpty()
    {
        if(empty($this->products->toArray())) {
            return true;
        }
        return false;
    }

    /**
     * Get total price for this order.
     *
     * @return null
     */
    public function getOrderTotalPrice()
    {

        $total = null;
        foreach($this->products as $product) {
            $total += $product->pivot->total_price;
        }
        return $total;
    }

}
