<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Negociation extends Model
{
    use HasFactory;

       //Pertenece a (FK)
       public function active_user(): BelongsTo
       {
           return $this->belongsTo(User::class);
       }

        //Pertenece a (FK)
        public function passive_user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
