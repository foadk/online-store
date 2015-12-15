<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
        'description',
        'image',
        'thumbnail'
    ];

    public function scopeAvailable($query)
    {
        $query->where('stock', '>=', 1);
    }

    /**
     * get category for this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * get comments associated with this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * get orders associated with this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order')
            ->withTimestamps()
            ->withPivot('quantity', 'total_price');
    }

    /**
     * get users commenting on this product.
     *
     * @return $this
     */
    public function commentingUsers()
    {
        return $this->belongsToMany('App\User', 'comments')
            ->withTimestamps()
            ->withPivot('comment_text');
    }

}
