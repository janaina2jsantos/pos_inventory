<?php

namespace App\Http\BUS;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Exception;

class ProductBUS
{
	public static function getProducts(Request $request) 
	{
		$products = new Product();
		if ($request->has("search")) {
			if ($request->word != "" || $request->status != "") {
				$products = $products->where("name", "LIKE", "%{$request->word}%")
					->orWhere("status", "=", $request->status);
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
				->orWhere('code', 'LIKE', '%' . $request->word . '%');
		}
		return $products;
	}

	public static function storeProduct(ProductRequest $request) 
	{
		$buyingPrice = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->buying_price)));
		$sellingPrice = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->selling_price)));

		// upload image
		if ((isset($_FILES['image'])) && ($_FILES['image']['type'] != "")) {
			if(!is_dir("dist/assets/img/products/")) {
				mkdir("dist/assets/img/products/");
			}

			$file = $_FILES['image'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/products/". $_FILES["image"]["name"]; 
				move_uploaded_file($_FILES['image']['tmp_name'], $uploaded);
			}
		}

		$product = Product::create([
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'code' => $request->code,
            'garage' => $request->garage,
            'route' => $request->route,
            'buying_price' => $buyingPrice,
            'selling_price' => $sellingPrice,
            'image' => isset($uploaded) ? "/".$uploaded : null,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'status' => $request->status
        ]);

		return $product;
	}
	
	public static function updateProduct(ProductRequest $request, $id) 
	{
		$buyingPrice = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->buying_price)));
		$sellingPrice = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->selling_price)));
		$product = Product::findOrFail($id);

		// upload image
		if ((isset($_FILES['image'])) && ($_FILES['image']['type'] != "")) {
	        if ($product->image) {
				// delete the old image if it exists
	        	if (\File::exists(public_path($product->image))) {
	        		\File::delete(public_path($product->image));
	        	}
	        }

			$file = $_FILES['image'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/products/". $_FILES["image"]["name"]; 
				move_uploaded_file($_FILES['image']['tmp_name'], $uploaded);
			}
		}

		$product->update([
			'category_id' => $request->input('category_id'),
            'supplier_id' => $request->input('supplier_id'),
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'garage' => $request->input('garage'),
            'route' => $request->input('route'),
            'buying_price' => $buyingPrice,
            'selling_price' => $sellingPrice,
            'image' => isset($uploaded) ? "/" . $uploaded : $product->image,
            'buying_date' => $request->input('buying_date'),
            'expire_date' => $request->input('expire_date'),
            'status' => $request->input('status')
        ]);

		return $product;
	}

	public static function destroyProduct($id) 
	{
        try {
			$product = Product::findOrFail($id);
			// delete the product image if it exists
	        if ($product->image) {
	        	if (\File::exists(public_path($product->image))) {
	        		\File::delete(public_path($product->image));
	        	}
	        }
	        return $product->delete();
		}
		catch(Exception $ex) {
			return false;
		}
	}
}
