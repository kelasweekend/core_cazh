<?php

namespace App\Services\Api\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class DeleteEmployeeService
 * @package App\Services
 */
class DeleteEmployeeService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $id = $request->employee_id;
        $employee = (new EmployeeRepository)->getById($id);
        if (empty($employee)) {
            # code...
            return $this->sendError('Employee Not Found', null);
        }
        $employee->delete();
        return $this->sendResponse(null, 'Employee Hass Been Delete');
    }
}
