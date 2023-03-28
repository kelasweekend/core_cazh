<?php

namespace App\Repositories\Api;

use App\Models\V1\Companie;

/**
 * Class CompanyRepository.
 */
class CompanyRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getAll()
    {
        return Companie::all();
    }

    public function create($data)
    {
        return Companie::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'website' => $data['website'],
            'logo' => $data['logo'],
            'balance' => $data['balance']
        ]);
    }
}
