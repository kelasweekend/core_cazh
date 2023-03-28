<?php

namespace App\Services\Api\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\EmployeeRepository;

/**
 * Class IndexEmployeeService
 * @package App\Services
 */
class IndexEmployeeService extends BaseController
{
    public function handle($request)
    {
        if ($request->company_id) {
            # code...
            $data = (new EmployeeRepository)->getByCompanyApi($request);
            return $this->sendResponse($data, 'Filter Employee By Company');
        }

        $data = (new EmployeeRepository)->getAllApi();
        return $this->sendResponse($data, 'Get All Employee');
    }
}
