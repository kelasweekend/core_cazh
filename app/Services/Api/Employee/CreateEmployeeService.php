<?php

namespace App\Services\Api\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class CreateEmployeeService
 * @package App\Services
 */
class CreateEmployeeService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
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

        $data = [
            'company' => $company->id,
            'name' => $request->name,
            'email' => $request->email,
            'balance' => $request->balance,
        ];

        $response = (new EmployeeRepository)->create($data);
        return $this->sendResponse('Employee Hass Been Added', $response);
    }
}
