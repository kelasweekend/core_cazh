<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\Transaction\TransactionAllService;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function index()
    {
        return (new TransactionAllService)->handle();
    }
}
