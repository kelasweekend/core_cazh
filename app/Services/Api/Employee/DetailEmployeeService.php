<?php

namespace App\Services\Api\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class DetailEmployeeService
 * @package App\Services
 */
class DetailEmployeeService extends BaseController
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

        return $this->sendResponse($employee, 'Detail Employee');
    }
}
