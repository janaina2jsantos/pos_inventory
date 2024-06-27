<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['buy_date', 'expire_date'];

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function supplier()
    {
        return $this->hasOne('App\Models\Supplier');
    }
}
