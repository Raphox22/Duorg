<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalInfo extends Model
{
    use HasFactory;

    protected $table = 'medical_info';

    protected $fillable = [
        'user_id', 'type', 'blood_type', 'rh_factor', 'organs',
        'health_problems', 'medical_history', 'transplant_history',
        'alcohol_consumer', 'smoker', 'family_history',
    ];

    protected $casts = [
        'organs' => 'array',
        'alcohol_consumer' => 'boolean',
        'smoker' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
