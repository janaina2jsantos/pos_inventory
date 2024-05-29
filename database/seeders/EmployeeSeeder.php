<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('employees')->get()->count() == 0) {
            $employees = Employee::factory()->count(10)->create(); 
        } 
        else { 
            echo "Unable to run the seed. The table is not empty.";
            die(); 
        }
    }
}
