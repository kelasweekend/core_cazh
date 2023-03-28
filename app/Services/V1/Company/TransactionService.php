<?php

namespace App\Services\V1\Company;

use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\TransactionRepository;

/**
 * Class TransactionService
 * @package App\Services
 */
class TransactionService
{
    public function handle($request, $company)
    {
        $request->validate([
            'employee' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

        $id = $request->employee;
        $employee = (new EmployeeRepository)->getByCompany($company, $id);
        if (empty($employee)) {
            # code...
            return back()->with('galat', 'Employee Not Found');
        }

        $data = [
            'company_id' => $company->id,
            'employee_id' => $employee->id,
            'balance' => $request->balance,
            'company_start_balance' => intval($company->balance),
            'company_last_balance' => intval($company->balance) - intval($request->balance),
            'employee_start_balance' => intval($employee->balance),
            'employee_last_balance' => intval($employee->balance) + intval($request->balance),
        ];

        (new CompanyRepository)->updateBalance($data, $company);
        (new EmployeeRepository)->updateBalance($data, $employee);
        return (new TransactionRepository)->addBalanceEmployee($data);
    }
}
