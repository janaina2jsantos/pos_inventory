<?php

namespace App\Http\BUS;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Exception;
use DB;

class CompanyBUS
{
	public static function updateCompany(CompanyRequest $request) 
	{
        $setting = DB::table('settings')->first(); 

        // upload image
		if ((isset($_FILES['company_logo'])) && ($_FILES['company_logo']['type'] != "")) {
			if(!is_dir("dist/assets/img/settings/")) {
				mkdir("dist/assets/img/settings/");
			}

	        if ($setting->company_logo) {
				// delete the old image if it exists
	        	if (\File::exists(public_path($setting->company_logo))) {
	        		\File::delete(public_path($setting->company_logo));
	        	}
	        }

			$file = $_FILES['company_logo'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/settings/". $_FILES["company_logo"]["name"]; 
				move_uploaded_file($_FILES['company_logo']['tmp_name'], $uploaded);
			}
		}

        DB::table('settings')
		    ->where('id', $setting->id) 
		    ->update([
		        'company_name' => $request->input('company_name'),
	            'company_email' => $request->input('company_email'),
	            'company_phone' => $request->input('company_phone'),
	            'company_zip' => $request->input('company_zip'),
	            'company_address' => $request->input('company_address'),
	            'company_number' => $request->input('company_number'),
	            'company_complement' => isset($request->company_complement) ? $request->input('company_complement') : $setting->company_complement,
	            'company_neighborhood' => $request->input('company_neighborhood'),
	            'company_city' => $request->input('company_city'),
	            'company_state' => $request->input('company_state'),
	            'company_logo' => isset($uploaded) ? "/" . $uploaded : $setting->company_logo
		    ]);

		return $setting;
	}
}
