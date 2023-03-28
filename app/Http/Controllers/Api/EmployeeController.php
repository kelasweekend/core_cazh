<?php

namespace App\Http\Controllers\Api;

use App\Imports\EmployeesImport;
use App\Services\Api\Employee\BalanceEmployeeService;
use App\Services\Api\Employee\CreateEmployeeService;
use App\Services\Api\Employee\DeleteEmployeeService;
use App\Services\Api\Employee\DetailEmployeeService;
use App\Services\Api\Employee\IndexEmployeeService;
use App\Services\Api\Employee\UpdateEmployeeService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends BaseController
{
    public function index(Request $request)
    {
        return (new IndexEmployeeService)->handle($request);
    }

    public function store(Request $request)
    {
        return (new CreateEmployeeService)->handle($request);
    }

    public function update(Request $request)
    {
        return (new UpdateEmployeeService)->handle($request);
    }

    public function destroy(Request $request)
    {
        return (new DeleteEmployeeService)->handle($request);
    }

    public function detail(Request $request)
    {
        return (new DetailEmployeeService)->handle($request);
    }

    public function balance(Request $request)
    {
        return (new BalanceEmployeeService)->handle($request);
    }
}
