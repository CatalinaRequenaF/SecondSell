<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messagge extends Model
{
    use HasFactory;

    //Chat
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    //Emisor
    public function emisor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     //Receptor
     public function receptor()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

}
