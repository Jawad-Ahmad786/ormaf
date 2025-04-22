<?php

namespace App\Services;

use App\Models\User;

class RegisterService
{
    public function store($data)
    {
      return User::create([
            'country_id' => $data['country'],
            'state_id'  => $data['state'],
            'city_id' => $data['city'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
            'terms_conditions' => $data['terms_conditions']
        ]);
    }
}
