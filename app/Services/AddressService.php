<?php

namespace App\Services;

use App\Models\Address;

class AddressService
{

    /**
     * Cria um novo endereço
     *
     * @param array $data
     * @return Address
     */
    public function createAddress($data)
    {
        return Address::create([
            'street' => $data['street'],
            'number' => $data['number'] ?? null,
            'complement' => $data['complement'] ?? null,
            'city' => $data['city'],
            'state' => $data['state'],
            'zipcode' => $data['zipcode'] ?? null,
        ]);
    }
}