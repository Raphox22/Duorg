<?php
namespace App\Services;

use App\Models\User;
use App\Models\MedicalInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser($data)
    {
        return DB::transaction(function () use ($data) {
            // Criar endereço, se necessário
            $address = null;
            if (!empty($data['address'])) {
                $address = (new AddressService())->createAddress($data['address']);
            }
    
            // Criar usuário
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => $data['type'] ?? null,
                'birth_date' => $data['type'] === 'ADMIN' ? null : ($data['birth_date'] ?? null),
                'cpf' => $data['cpf'],
                'rg' => $data['rg'] ?? null,
                'gender' => $data['type'] === 'ADMIN' ? null : ($data['gender'] ?? null),
                'profile_id' => $data['profile_id'] ?? null,
                'address_id' => $address->id,
            ]);
    
            if ($data['type'] === 'RECEPTOR') {
                MedicalInfo::create([
                    'user_id' => $user->id,
                    'blood_type' => $data['blood_type'],
                    'rh_factor' => $data['rh_factor'],
                    'health_problems' => $data['health_problems'] ?? null,
                    'medical_history' => $data['medical_history'] ?? null,
                    'transplant_history' => $data['transplant_history'] ?? null,
                    'required_organ' => $data['required_organ'] ?? null,
                    'address_id' => $address->id,
                ]);
            } elseif ($data['type'] === 'DOADOR') {
                MedicalInfo::create([
                    'user_id' => $user->id,
                    'organs_to_donate' => $data['organs_to_donate'] ?? null,
                    'blood_type' => $data['blood_type'],
                    'rh_factor' => $data['rh_factor'],
                    'preexisting_conditions' => $data['preexisting_conditions'] ?? null,
                    'allergies' => $data['allergies'] ?? null,
                    'continuous_medication' => $data['continuous_medication'] ?? null,
                    'alcohol_consumer' => $data['alcohol_consumer'] ?? null,
                    'smoker' => $data['smoker'] ?? null,
                    'family_history' => $data['family_history'] ?? null,
                    'address_id' => $address->id,
                ]);
            }
    
            return $user;
        });
    }

    public function filterUsers($data)
    {
        $query = User::query();

    if (!empty($data['type'])) {
        $query->where('type', $data['type']);
    }

    if (!empty($data['organ'])) {
        $query->whereHas('MedicalInfo', function ($query) use ($data) {
            $query->whereJsonContains('organs_to_donate', $data['organ']);
        });
    }

    return $query->paginate($data['per_page'] ?? 10);
}
}