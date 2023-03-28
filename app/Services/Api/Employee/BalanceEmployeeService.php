<?php

namespace App\Services\Api\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class BalanceEmployeeService
 * @package App\Services
 */
class BalanceEmployeeService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $company = (new CompanyRepository)->getById($request->company_id);
        if (empty($company)) {
            # code...
            return $this->sendError('Company Not Found', null);
        }

        $id = $request->employee_id;
        $employee = (new EmployeeRepository)->getByCompany($company, $id);
        if (empty($employee)) {
            # code...
            return $this->sendError('Employee Not Found', null);
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
        $response = (new TransactionRepository)->addBalanceEmployee($data);
        return $this->sendResponse('Balance Hass Been Add', $response);
    }
}
