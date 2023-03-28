<?php

namespace App\Services\V1\Employee;

use App\Models\V1\Companie;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;

/**
 * Class EmployeUpdateService
 * @package App\Services
 */
class EmployeUpdateService
{
    public function handle($request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'balance' => 'required|numeric',
            'company' => 'required|numeric'
        ]);

        $company = (new CompanyRepository)->getById($request->company);
        if (empty($company)) {
            # code...
            return back()->with('galat', 'Company Not Found');
        }

        $employee = (new EmployeeRepository)->getById($id);
        if (empty($employee)) {
            # code...
            return back()->with('galat', 'Employee Not Found');
        }

        $data = [
            'company' => $company->id,
            'name' => $request->name,
            'email' => $request->email,
            'balance' => $request->balance,
        ];

        return (new EmployeeRepository)->update($data, $employee);
    }
}
