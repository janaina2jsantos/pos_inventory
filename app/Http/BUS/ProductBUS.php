<?php

namespace App\Http\BUS;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Exception;

class ProductBUS
{
	public static function getProducts(Request $request) {
		$products = new Product();
		if ($request->has("search")) {
			if ($request->word != "" || $request->status != "") {
				$products = $products->where("name", "LIKE", "%{$request->word}%")
					->where("status", "=", $request->status);
			}
			else {
				die();
			}
		}
		if ($request->has("status")) {
			if ($request->status != "") {
				$products = $products->where("status", "=", $request->status);
			}
		}
		if ($request->has("word")) {
			$products = $products->where('name', 'LIKE', '%' . $request->word . '%')
				->orWhere('email', 'LIKE', '%' . $request->word . '%')
				->orWhere('city', 'LIKE', '%' . $request->word . '%')
				->orWhere('shop_name', 'LIKE', '%' . $request->word . '%');
		}
		return $products;
	}

	public static function storeProduct(ProductRequest $request) 
	{
		$product = Product::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

		return $product;
	}
	
	public static function updateProduct(ProductRequest $request, $id) 
	{
		$product = Product::findOrFail($id);
		$product->update([
            'name' => $request->input('name'),
            'complement' => isset($request->complement) ? $request->input('complement') : $product->complement,
      
            'status' => $request->input('status')
        ]);

		return $product;
	}

	public static function destroyProduct($id) 
	{
		try {
            $product = Product::findOrFail($id);
            $product->delete();
            return true;
        }
        catch(Exception $ex) {
            return false;
        }
	}
}
