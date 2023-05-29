<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function seller()
    {
        return $this->hasOne(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->hasOne(User::class, 'buyer_id');
    }
}
