<?php

namespace App\Http\BUS;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use Exception;

class SupplierBUS
{
	public static function getSuppliers(Request $request) {
		$suppliers = new Supplier();
		if ($request->has("search")) {
			if ($request->word != "" || $request->status != "") {
				$suppliers = $suppliers->where("name", "LIKE", "%{$request->word}%")
					->where("status", "=", $request->status);
			}
			else {
				die();
			}
		}
		if ($request->has("status")) {
			if ($request->status != "") {
				$suppliers = $suppliers->where("status", "=", $request->status);
			}
		}
		if ($request->has("word")) {
			$suppliers = $suppliers->where('name', 'LIKE', '%' . $request->word . '%')
				->orWhere('email', 'LIKE', '%' . $request->word . '%')
				->orWhere('city', 'LIKE', '%' . $request->word . '%')
				->orWhere('shop_name', 'LIKE', '%' . $request->word . '%');
		}
		return $suppliers;
	}

	public static function storeSupplier(SupplierRequest $request) 
	{
		$supplier = Supplier::create([
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
            'type' => $request->type,
            'shop_name' => $request->shop_name,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'status' => $request->status
        ]);

		return $supplier;
	}
	
	public static function updateSupplier(SupplierRequest $request, $id) 
	{
		$supplier = Supplier::findOrFail($id);
		$supplier->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'zip' => $request->input('zip'),
            'address' => $request->input('street'),
            'number' => $request->input('number'),
            'complement' => isset($request->complement) ? $request->input('complement') : $supplier->complement,
            'neighborhood' => $request->input('neighborhood'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'type' => $request->input('type'),
            'shop_name' => $request->input('shop_name'),
            'account_holder' => $request->input('account_holder'),
            'account_number' => $request->input('account_number'),
            'bank_name' => $request->input('bank_name'),
            'bank_branch' => $request->input('bank_branch'),
            'status' => $request->input('status')
        ]);

		return $supplier;
	}

	public static function destroySupplier($id) 
	{
        return Supplier::findOrFail($id)->delete();
	}
}
