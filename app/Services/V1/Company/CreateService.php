<?php

namespace App\Services\V1\Company;

use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateService
 * @package App\Services
 */
class CreateService
{
    public function handle($request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'balance' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg',
            'website' => 'required'
        ]);

        $file = $request->file('image');
        $filename = time() . '.' . $file->extension();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $filename,
            'balance' => $request->balance,
        ];

        $response =  (new CompanyRepository)->create($data);
        $file->storeAs('public/app/company/', $filename);

        return $response;
    }
}
