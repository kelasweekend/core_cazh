<?php

namespace App\Services\Api\Company;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\Api\CompanyRepository;
use Illuminate\Support\Facades\Validator;

/**
 * Class CompanyCreateService
 * @package App\Services
 */
class CompanyCreateService extends BaseController
{
    public function handle($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'balance' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'website' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $file = $request->file('image');
        $filename = time() . '.' . $file->extension();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $filename,
            'balance' => $request->balance,
        ];

        $response = (new CompanyRepository)->create($data);
        $file->storeAs('public/app/company/', $filename);

        return $this->sendResponse($response, 'Company Hass Been Create');
    }
}
