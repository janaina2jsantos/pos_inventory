<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\BUS\CompanyBUS;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use DB;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->title = "Company";
    }

    public function edit() 
    { 
        $setting = DB::table('settings')->first(); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('dashboard.index')],
            ['name' => 'Company Settings', 'url' => null],
        ];

        return view("settings.edit")
            ->with('setting', $setting)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(CompanyRequest $request) 
    {
        CompanyBUS::updateCompany($request);
        return redirect()->route("products.index")->with("success", "Settings successfully updated.");
    }
}
