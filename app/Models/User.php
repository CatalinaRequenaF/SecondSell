<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
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
     * @var array<integer, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<integer, string>
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

    //---------------------------------------------RELACIONES----------------------------------------------------
    //------------------------------------------------------------------------------------------------------------
    //Usuario tiene un teléfono, una sesión y un carrito
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

    //---------------------Tiene muchos roles, direcciones------------------------
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
        
    //---------------------Polimorficas-------------------------
    //Puede tener varias imágenes en su perfil y varios métodos de pago
    public function pictures(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    //Métodos de pago
    public function paymentMethod(): MorphToMany
    {
        return $this->morphToMany(paymentMethod::class, 'payable');
    }

    //Un usuario puede ser seguido por otros usuarios, llamados 'followers'.
    public function followers(): MorphToMany
    {
        return $this->morphedByMany(Follow::class, 'followable');
    }

    //Un usuario puede seguir a otros usuarios, a productos o a categorías que le interesen.
    public function followed(): MorphToMany
    {
        return $this->morphToMany(Follow::class, 'followable');
    }

    //Un usuario, por alguna razón, podría tener descuentos en la compra de productos.
    public function discount(): MorphMany
    {
        return $this->morphMany(Discount::class, 'discountable');
    }

    
    //-----------------LISTA DE PRODUCTOS A LA VENTA--------------------
    //----------------------------------------------------------------------------
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    //-----------------LISTA DE PRODUCTOS COMPRADOS Y VENDIDOS--------------------
    //----------------------------------------------------------------------------
    public function productsSold()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function productsBought()
    {
        return $this->hasMany(Product::class, 'buyer_id');
    }



    //----------REVIEWS DE LOS PRODUCTOD VENDIDOS Y COMPRADOS (Hechas y recibidas)-----------
    //---------------------------------------------------------------------------------------
    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'from_user_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'to_user_id');
    }

    
    //---------------------------------------------PEDIDOS----------------------------------
    //---------------------------------------------------------------------------------------
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     //---------------------------------------------MENASJES----------------------------------
    //---------------------------------------------------------------------------------------
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

     //---------------------------------------------CHATS----------------------------------
    //---------------------------------------------------------------------------------------
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
