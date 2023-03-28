<?php

namespace App\Services\V1\Company;

use App\Repositories\CompanyRepository;

/**
 * Class CompanyDeleteService
 * @package App\Services
 */
class CompanyDeleteService
{
    public function handle($id)
    {
        $data = (new CompanyRepository)->getById($id);
        if (empty($data)) {
            # code...
            return redirect()->route('companies.index')->with('galat', 'Company Not Found');
        }

        unlink(public_path('storage/app/company/' . $data->logo));
        return $data->delete();
    }
}
