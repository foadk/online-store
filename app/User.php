<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'phone'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * return orders associated with this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * get comments associated with user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * get products commented by this user.
     *
     * @return $this
     */
    public function commentedProducts()
    {
        return $this->belongsToMany('App\Product')
            ->withTimestamps()
            ->withPivot('comment_text');
    }

    /**
     * If user has any active orders.
     *
     * @return bool
     */
    public function hasActiveOrder()
    {
        $count = $this->orders()->where('paid', false)->count();
        if($count > 0) {
            return true;
        }
        return false;
    }

    /**
     * Get active order for this user.
     *
     * @return null
     */
    public function getActiveOrder()
    {
        if($this->hasActiveOrder()) {
            return $this->orders()->where('paid', false)->first();
        }
        return null;
    }

    public function isAdmin()
    {
        if($this->role == 'admin') {
            return true;
        }
        return false;
    }

}
