<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'cnpj', 'address_id', 'phone', 'email', 'status',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hospital_user');
    }
}