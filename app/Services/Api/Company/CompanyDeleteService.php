<?php

namespace App\Services\Api\Company;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class CompanyDeleteService
 * @package App\Services
 */
class CompanyDeleteService extends BaseController
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
        $data = (new CompanyRepository)->getById($id);
        if (empty($data)) {
            # code...
            return $this->sendError(null, 'Company Not Found');
        }

        unlink(public_path('storage/app/company/' . $data->logo));
        $data->delete();
        return $this->sendResponse(null, 'Company Hass Been Delete');
    }
}
