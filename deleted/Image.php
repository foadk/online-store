<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id',
        'path'
    ];

    /**
     * get the associated product for this image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products() {
        return $this->belongsTo('App\Product');
    }

}
