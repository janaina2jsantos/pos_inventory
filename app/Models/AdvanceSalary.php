<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceSalary extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'month', 'advance_salary'];

    protected $dates = ['month'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
