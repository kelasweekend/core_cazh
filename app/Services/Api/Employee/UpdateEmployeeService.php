<?php

namespace App\Services\Api\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class UpdateEmployeeService
 * @package App\Services
 */
class UpdateEmployeeService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric',
            'company_id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'balance' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $company = (new CompanyRepository)->getById($request->company_id);
        if (empty($company)) {
            # code...
            return $this->sendError('Company Not Found', null);
        }

        $employee = (new EmployeeRepository)->getById($request->employee_id);
        if (empty($employee)) {
            # code...
            return $this->sendError('Employee Not Found', null);
        }

        $data = [
            'company' => $company->id,
            'name' => $request->name,
            'email' => $request->email,
            'balance' => $request->balance,
        ];

        $response = (new EmployeeRepository)->update($data, $employee);
        return $this->sendResponse('Employee Hass Been Update', $response);
    }
}
