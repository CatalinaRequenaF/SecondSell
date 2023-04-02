<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PaymentMethod extends Model
{
    use HasFactory;

    //Obtiene todos los usuarios a los que se les ha asignado el método de pago
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'payable');
    }
 
}
