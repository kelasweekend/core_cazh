<?php

namespace App\Services\V1\Employee;

use App\Repositories\EmployeeRepository;

/**
 * Class EmployeDeleteService
 * @package App\Services
 */
class EmployeDeleteService
{
    public function handle($id)
    {
        $data = (new EmployeeRepository)->getById($id);
        if (empty($data)) {
            # code...
            return redirect()->route('employee.index')->with('galat', 'Employee Not Found');
        }
        return $data->delete();
    }
}
