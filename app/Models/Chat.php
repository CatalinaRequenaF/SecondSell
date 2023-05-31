<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    //Mensajes
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //Ofertas
    public function offers()
    {
        return $this->hasMany(Message::class);
    }
}
