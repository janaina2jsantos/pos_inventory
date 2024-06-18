<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $dates = ['vacation'];

    public function advanceSalaries()
    {
        return $this->hasMany('App\Models\AdvanceSalary');
    }

    public function salaries()
    {
        return $this->hasMany('App\Models\Salary');
    }
}
