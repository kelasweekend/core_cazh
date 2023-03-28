<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded;

    public function company()
    {
        return $this->belongsTo(Companie::class, 'company_id');
    }
}
