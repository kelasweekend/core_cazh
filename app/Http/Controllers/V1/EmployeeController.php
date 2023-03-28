<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Imports\EmployeesImport;
use App\Repositories\EmployeeRepository;
use App\Services\V1\Employee\CreateService;
use App\Services\V1\Employee\EmployeDeleteService;
use App\Services\V1\Employee\EmployeUpdateService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = (new EmployeeRepository)->getAll();
        if ($request->ajax()) {
            # code...
            return (new EmployeeRepository)->searchCompany($request);
        }
        return view('backend.employee.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        (new CreateService)->handle($request);
        return redirect()->route('employee.index')->with('success', 'New Employee Has Been Added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            # code...
            return (new EmployeeRepository)->searchCompany($request);
        }

        $data = (new EmployeeRepository)->getById($id);
        return view('backend.employee.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        (new EmployeUpdateService)->handle($request, $id);
        return redirect()->route('employee.index')->with('success', 'Employee Hass Been Updaye');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new EmployeesImport, $request->file('excel'));
        return redirect()->route('employee.index')->with('success', 'Employee Hass Ben Import To Company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new EmployeDeleteService)->handle($id);
        return redirect()->route('employee.index')->with('success', 'Employee Hass Been Deleted');
    }
}
