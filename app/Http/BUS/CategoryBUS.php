<?php

namespace App\Http\BUS;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Exception;

class CategoryBUS
{
	public static function getCategories(Request $request) {
		$categories = new Category();
		if ($request->has("search")) {
			if ($request->word != "" || $request->status != "") {
				$categories = $categories->where("name", "LIKE", "%{$request->word}%");
			}
			else {
				die();
			}
		}
		if ($request->has("word")) {
			$categories = $categories->where('name', 'LIKE', '%' . $request->word . '%');
		}
		return $categories;
	}

	public static function storeCategory(CategoryRequest $request) 
	{
		$category = Category::create([
            'name' => $request->name
        ]);
        
		return $category;
	}
	
	public static function updateCategory(CategoryRequest $request, $id) 
	{
		$category = Category::findOrFail($id);
		$category->update([
            'name' => $request->input('name')
        ]);

		return $category;
	}

	public static function destroyCategory($id) 
	{
		try {
            $category = Category::findOrFail($id);
            $category->delete();
            return true;
        }
        catch(Exception $ex) {
            return false;
        }
	}
}
