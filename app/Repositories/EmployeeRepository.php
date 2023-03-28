<?php

namespace App\Repositories;

use App\Models\V1\Companie;
use App\Models\V1\Employee;

//use Your Model

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function create($data)
    {
        return Employee::create([
            'company_id' => $data['company'],
            'name' => $data['name'],
            'email' => $data['email'],
            'balance' => $data['balance']
        ]);
    }

    public function getById($id)
    {
        return Employee::with('company')->find($id);
    }

    public function update($data, $employee)
    {
        return $this->getById($employee->id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'balance' => $data['balance']
        ]);
    }

    public function updateBalance($data, $employee)
    {
        return $this->getById($employee->id)->update([
            'balance' => $data['employee_last_balance']
        ]);
    }

    public function getByCompany($company, $id)
    {
        return Employee::with('company')->where([
            'company_id' => $company->id,
            'id' => $id
        ])->first();
    }

    public function getByCompanyApi($request)
    {
        return Employee::with('company')->where([
            'company_id' => $request->company_id
        ])->get();
    }

    public function getAll()
    {
        return Employee::with('company')->paginate(5);
    }

    public function getAllApi()
    {
        return Employee::with('company')->get();
    }

    public function searchCompany($request)
    {
        $search = $request->q;
        return Companie::select("id", "name")
            ->where('name', 'LIKE', "%$search%")
            ->get();
    }

    public function searchEmployee($request, $company)
    {
        $search = $request->q;
        return Employee::select("id", "name")
            ->where('name', 'LIKE', "%$search%")
            ->where('company_id', $company)
            ->get();
    }
}
