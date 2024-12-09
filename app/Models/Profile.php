<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    /**
     * Relacionamento: Um perfil pode estar associado a vários usuários.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}