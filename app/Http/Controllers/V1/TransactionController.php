<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\TransactionRepository;
use App\Services\V1\Company\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $data = (new TransactionRepository)->getAll();
        return view('backend.transactions.index', compact('data'));
    }
    public function company(Request $request, $id)
    {
        $company = (new CompanyRepository)->getById($id);
        if (empty($company)) {
            # code...
            return redirect()->route('companies.index')->with('galat', 'Company Not Found');
        }

        if ($request->ajax()) {
            # code...
            return (new EmployeeRepository)->searchEmployee($request, $company->id);
        }

        $data = (new TransactionRepository)->getTransactionCompany($company->id);
        return view('backend.companies.transaction.index', compact('data', 'company'));
    }

    public function store(Request $request, $id)
    {
        $company = (new CompanyRepository)->getById($id);
        if (empty($company)) {
            # code...
            return redirect()->route('companies.index')->with('galat', 'Company Not Found');
        }

        (new TransactionService)->handle($request, $company);

        return redirect()->route('companies.transaction', $company->id)->with('success', 'Balance Hass Been Added');
    }
}
