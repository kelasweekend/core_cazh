<?php

namespace App\Repositories;

use App\Models\V1\Companie;
use App\Models\V1\Employee;

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
        return Companie::paginate(5);
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

    public function getById($id)
    {
        return Companie::with('employee')->find($id);
    }

    public function getEmployee($id)
    {
        return [
            'company' => $this->getById($id),
            'employee' => Employee::where('company_id', $id)->paginate(5)
        ];
    }
    public function getEmployeeApi($id)
    {
        return [
            'company' => $this->getById($id),
            'employee' => Employee::where('company_id', $id)->get()
        ];
    }

    public function updateNoLogo($data, $id)
    {
        return $this->getById($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'website' => $data['website'],
            'balance' => $data['balance']
        ]);
    }

    public function updateWithLogo($data, $id)
    {
        return $this->getById($id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'website' => $data['website'],
            'logo' => $data['logo'],
            'balance' => $data['balance']
        ]);
    }

    public function updateBalance($data, $company)
    {
        return $this->getById($company->id)->update([
            'balance' => $data['company_last_balance']
        ]);
    }
}
