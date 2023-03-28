<?php

namespace App\Services\Api\Company;

use App\Base\ServiceBase;
use App\Repositories\Api\CompanyRepository;
use App\Responses\ServiceResponse;

/**
 * Class CompanyIndexService
 * @package App\Services
 */
class CompanyIndexService extends ServiceBase
{
    public function call(): ServiceResponse
    {
        $data = (new CompanyRepository)->getAll();
        if (empty($data[0])) {
            # this empty response 
            return self::error(null, 'Company Not Found');
        }
        return self::success($data, 'Get All Company');
    }
}
