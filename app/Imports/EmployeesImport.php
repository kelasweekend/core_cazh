<?php

namespace App\Imports;

use App\Models\V1\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeesImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    use RemembersChunkOffset;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.name' => 'required',
            '*.email' => 'required|email',
            '*.balance' => 'required|numeric',
            '*.company' => 'required|numeric',
        ])->validate();

        foreach ($rows as $row) {
            Employee::create([
                'company_id' => $row['company'],
                'name' => $row['name'],
                'email' => $row['email'],
                'balance' => $row['balance'],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
