<?php

namespace App\Services\Api\Transaction;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\TransactionRepository;

/**
 * Class TransactionAllService
 * @package App\Services
 */
class TransactionAllService extends BaseController
{
    public function handle()
    {
        $response = (new TransactionRepository)->getAllApi();
        return $this->sendResponse('Employee Hass Been Update', $response);
    }
}
