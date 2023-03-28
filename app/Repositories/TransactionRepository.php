<?php

namespace App\Repositories;

use App\Models\V1\Historie;

/**
 * Class TransactionRepository.
 */
class TransactionRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getTransactionCompany($company)
    {
       return Historie::with('employee')->where('company_id', $company)->paginate(5);
    }

    public function addBalanceEmployee($data)
    {
        return Historie::create($data);
    }

    public function getAll()
    {
        return Historie::with('employee', 'company')->paginate(5);
    }

    public function getAllApi()
    {
        return Historie::with('employee', 'company')->get();
    }
}
