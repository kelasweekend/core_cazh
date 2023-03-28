<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    use HasFactory;
    protected $guarded;

    public function employee()
    {
        return $this->hasMany(Employee::class, 'company_id');
    }
}
