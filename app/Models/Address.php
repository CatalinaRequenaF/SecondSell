<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<integer, string>
     */
    protected $fillable = [
        'street',
        'integer',
        'complement',
        'city',
        'state',
        'country',
        'postal_code',
        'is_primary',
        'user_id'
    ];
    
    //Una dirección pertenece a un usuario.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
