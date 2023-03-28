<?php

namespace App\Services\Api\Company;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class CompanyUpdateService
 * @package App\Services
 */
class CompanyUpdateService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'balance' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'website' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $company = (new CompanyRepository)->getById($request->company_id);
        if (empty($company)) {
            # code...
            return $this->sendError(null, 'Company Not Found');
        }

        $id = $request->company_id;

        if ($request->file('image')) {
            # code...
            unlink(public_path('storage/app/company/' . $company->logo));

            $file = $request->file('image');
            $filename = time() . '.' . $file->extension();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $filename,
                'balance' => $request->balance,
            ];

            $response =  (new CompanyRepository)->updateWithLogo($data, $id);
            $file->storeAs('public/app/company/', $filename);
            return $this->sendResponse($response, 'Company Hass Been Update');
        } else {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'balance' => $request->balance,
            ];

            $response =  (new CompanyRepository)->updateNoLogo($data, $id);
            return $this->sendResponse($response, 'Company Hass Been Update');
        }
    }
}
