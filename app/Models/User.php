<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Usuario tiene (1:1)    
    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }

    public function session(): HasOne
    {
        return $this->hasOne(Session::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    //---------------------Tiene muchos------------------------
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function adress(): HasMany
    {
        return $this->hasMany(Address::class);
    }
    
    
    //---------------------Polimorficas-------------------------
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function paymentMethod()
    {
        return $this->morphMany(paymentMethod::class, 'payable');
    }

    //-----------Productos comprados y vendidos-------------
    public function productsSold()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function productsBought()
    {
        return $this->hasMany(Product::class, 'buyer_id');
    }

    //-------------------Reviews escritas----------------------
    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'from_user_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'to_user_id');
    }

}
