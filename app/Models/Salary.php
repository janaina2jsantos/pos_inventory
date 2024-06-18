<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'month', 'paid_amount', 'status'];

    protected $dates = ['month'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
