<?php

namespace App\Services;

use App\Models\Hospital;
use Illuminate\Support\Facades\DB;
use App\Services\AddressService;

class HospitalService
{
    public function getPaginated($request)
    {
        $perPage = $request->query('per_page', 10);
        return Hospital::query()->paginate($perPage);
    }

    public function createHospital($data)
    {
        return DB::transaction(function () use ($data) {
            // Instancie o AddressService
            $addressService = new AddressService();
            $address = $addressService->createAddress($data['address']);

            $hospital = Hospital::create([
                'name' => $data['name'],
                'cnpj' => $data['cnpj'],
                'address_id' => $address->id,
                'phone' => $data['phone'],
                'email' => $data['email'],
                'status' => $data['status'] ?? true,
            ]);

            return $hospital;
        });
    }
}