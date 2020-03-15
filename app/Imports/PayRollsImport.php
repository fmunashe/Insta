<?php

namespace App\Imports;

use App\Employee;
use App\PayRoll;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PayRollsImport implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {
        $employee=Employee::query()->where('first_name',$row['first_name'])->where('last_name',$row['last_name'])->first();

       $salary=$employee->position->salary->amount;


        return new PayRoll([
            'roll_number' => $row['roll_number'],
            'employee_id'=>$employee->id,
            'salary' => $salary,
            'allowance' => $row['allowance'],
            'deductions' => $row['deductions'],
           'total'=>( $salary+ $row['allowance'])-$row['deductions'],
        ]);
    }
}
