<?php

namespace App\Http\BUS;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Storage;
use Exception;

class CustomerBUS
{
	public static function getCustomers(Request $request) {
		$customers = new Customer();
		if ($request->has("search")) {
			if ($request->word != "" || $request->status != "") {
				$customers = $customers->where("name", "LIKE", "%{$request->word}%")
					->where("status", "=", $request->status);
			}
			else {
				die();
			}
		}
		if ($request->has("status")) {
			if ($request->status != "") {
				$customers = $customers->where("status", "=", $request->status);
			}
		}
		if ($request->has("word")) {
			$customers = $customers->where('name', 'LIKE', '%' . $request->word . '%')
				->orWhere('email', 'LIKE', '%' . $request->word . '%')
				->orWhere('city', 'LIKE', '%' . $request->word . '%')
				->orWhere('shop_name', 'LIKE', '%' . $request->word . '%');
		}
		return $customers;
	}

	public static function storeCustomer(CustomerRequest $request) 
	{
		// upload
		if ((isset($_FILES['photo'])) && ($_FILES['photo']['type'] != "")) {
			if(!is_dir("dist/assets/img/customers/")) {
				mkdir("dist/assets/img/customers/");
			}

			$file = $_FILES['photo'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/customers/". $_FILES["photo"]["name"]; 
				move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded);
			}
		}

		$customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'address' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'shop_name' => $request->shop_name,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'photo' => isset($uploaded) ? "/".$uploaded : null,
            'status' => $request->status
        ]);

		return $customer;
	}
	
	public static function updateCustomer(CustomerRequest $request, $id) 
	{
		$customer = Customer::findOrFail($id);

		// upload
		if ((isset($_FILES['photo'])) && ($_FILES['photo']['type'] != "")) {
	        if ($customer->photo) {
				// delete the old photo if it exists
	        	if (\File::exists(public_path($customer->photo))) {
	        		\File::delete(public_path($customer->photo));
	        	}
	        }

			$file = $_FILES['photo'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/customers/". $_FILES["photo"]["name"]; 
				move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded);
			}
		}

		$customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'zip' => $request->input('zip'),
            'address' => $request->input('street'),
            'number' => $request->input('number'),
            'complement' => isset($request->complement) ? $request->input('complement') : $customer->complement,
            'neighborhood' => $request->input('neighborhood'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'shop_name' => $request->input('shop_name'),
            'account_holder' => $request->input('account_holder'),
            'account_number' => $request->input('account_number'),
            'bank_name' => $request->input('bank_name'),
            'bank_branch' => $request->input('bank_branch'),
            'photo' => isset($uploaded) ? "/" . $uploaded : $customer->photo,
            'status' => $request->input('status')
        ]);

		return $customer;
	}

	public static function destroyCustomer($id) 
	{
		try {
            $customer = Customer::findOrFail($id);
			// delete the customer photo if it exists
            if ($customer->photo) {
	        	if (\File::exists(public_path($customer->photo))) {
	        		\File::delete(public_path($customer->photo));
	        	}
	        }
            $customer->delete();
            return true;
        }
        catch(Exception $ex) {
            return false;
        }
	}
}
