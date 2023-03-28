<?php

namespace App\Services\V1\Company;

use App\Repositories\CompanyRepository;

/**
 * Class CompanyUpdateService
 * @package App\Services
 */
class CompanyUpdateService
{
    public function handle($request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'balance' => 'required|numeric',
            'image' => 'image|mimes:png,jpg',
            'website' => 'required'
        ]);

        $company = (new CompanyRepository)->getById($id);
        if (empty($company)) {
            # code...
            return redirect()->route('companies.index')->with('galat', 'Company Error');
        }

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
            return $response;
        } else {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'balance' => $request->balance,
            ];

            return (new CompanyRepository)->updateNoLogo($data, $id);
        }
    }
}
