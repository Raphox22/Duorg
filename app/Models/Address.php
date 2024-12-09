<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street', 'number', 'complement', 'city', 'state', 'zip_code',
    ];

    /**
     * Relacionamento: Um endereço pode estar associado a vários usuários.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relacionamento: Um endereço pode estar associado a vários hospitais.
     */
    public function hospitals(): HasMany
    {
        return $this->hasMany(Hospital::class);
    }
}