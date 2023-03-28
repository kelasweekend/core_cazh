<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\Company\CompanyCreateService;
use App\Services\Api\Company\CompanyDeleteService;
use App\Services\Api\Company\CompanyDetailService;
use App\Services\Api\Company\CompanyIndexService;
use App\Services\Api\Company\CompanyUpdateService;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    public function index()
    {
        return response()->json((new CompanyIndexService)->call());
    }

    public function store(Request $request)
    {
        return (new CompanyCreateService)->handle($request);
    }

    public function update(Request $request)
    {
        return (new CompanyUpdateService)->handle($request);
    }

    public function destroy(Request $request)
    {
        return (new CompanyDeleteService)->handle($request);
    }

    public function detail(Request $request)
    {
        return (new CompanyDetailService)->handle($request);
    }
}
