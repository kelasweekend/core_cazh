<?php

namespace App\Services\Api\Company;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class CompanyDetailService
 * @package App\Services
 */
class CompanyDetailService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $id = $request->company_id;
        $company = (new CompanyRepository)->getById($id);
        if (empty($company)) {
            # code...
            return $this->sendError(null, 'Company Not Found');
        }

        $data = [
            'Company' => $company,
            'Employee' => (new CompanyRepository)->getEmployeeApi($company->id)
        ];

        return $this->sendResponse($data, 'Detail Company');
    }
}
