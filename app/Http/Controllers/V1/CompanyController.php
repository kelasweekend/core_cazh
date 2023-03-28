<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Services\V1\Company\CompanyDeleteService;
use App\Services\V1\Company\CompanyUpdateService;
use App\Services\V1\Company\CreateService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (new CompanyRepository)->getAll();
        return view('backend.companies.index', compact('data'));
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
        return redirect()->route('companies.index')->with('success', 'Companies Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $data = (new CompanyRepository)->getEmployee($id);
        if (empty($data['company'])) {
            # code...
            return redirect()->route('companies.index')->with('galat', 'Company Not Found');
        }
        return view('backend.companies.detail.index', compact('data'));
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
        (new CompanyUpdateService)->handle($request, $id);
        return redirect()->route('companies.detail', $id)->with('success', 'Company Hass Been Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (new CompanyDeleteService)->handle($id);
        return redirect()->route('companies.index')->with('success', 'Company Hass Been Deleted');
    }

    /**
     * Export To PDF
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportPDF($id)
    {
        $data = (new CompanyRepository)->getById($id);
        $pdf = Pdf::loadView('backend.companies.pdf.index', compact('data'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
