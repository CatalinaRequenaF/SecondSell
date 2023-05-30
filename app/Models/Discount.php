<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Discount extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<integer, string>
     */
    protected $fillable = [
        'name',
        'percent'
    ];
    
    //Un descuento puede aplicarse por producto, por usuario o por categoría.
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

}
