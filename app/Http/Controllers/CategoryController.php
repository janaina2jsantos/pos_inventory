<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\BUS\CategoryBUS;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->title = "Categories";
    }

    public function index()
    {
        return view("categories.index")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function indexAjax(Request $request)
    {
        $page = 1;
        $per_page = 10;

        // Define the default order
        $order_field = 'id';
        $order_sort = 'DESC';

        // Get the request parameters
        $params = $request->all();

        // Set the current page
        if(isset($params['pagination']['page']))
        {
            $page = $params['pagination']['page'];
        }

        // Set the number of items
        if(isset($params['pagination']['perpage']))
        {
            $per_page = $params['pagination']['perpage'];
        }

        // Set the sort order and field
        if(isset($params['sort']['field']))
        {
            $order_field = $params['sort']['field'];
            $order_sort = $params['sort']['sort'];
        }

        // Get how many items there should be
        $total = CategoryBUS::getCategories($request)->count();
        $categories = CategoryBUS::getCategories($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($categories)) {
            foreach($categories as $category) {
                $data[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }
        }

        $response = [
            'meta' => [
                "page" => $page,
                "pages" => ceil($total / $per_page),
                "perpage" => $per_page,
                "total" => $total,
                "sort" => $order_sort,
                "field" => $order_field
            ],
            'data' => $data
        ];

        return response()->json($response);
    }

    public function create() 
    {
        $breadItems = [
            ['name' => 'Data', 'url' => route('categories.index')],
            ['name' => 'Add Category', 'url' => null],
        ];

        return view("categories.create")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(CategoryRequest $request) 
    {
        CategoryBUS::storeCategory($request);
        return redirect()->route("categories.index")->with("success", "Category successfully created.");
    }

    public function edit($id) 
    { 
        $category = Category::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('categories.index')],
            ['name' => 'Edit Category', 'url' => null],
        ];

        return view("categories.edit")
            ->with('category', $category)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(CategoryRequest $request, $id) 
    {
        CategoryBUS::updateCategory($request, $id);
        return redirect()->route("categories.index")->with("success", "Category successfully updated.");
    }

    public function destroy($id) 
    {
        try {
            if (CategoryBUS::destroyCategory($id)) {  
                return response()->json(["status" => true, "message" => "Category successfully deleted."], 200);
            } 
            else {
                return response()->json(["status" => false, "message" => "This action couldn't be completed."], 400); 
            }
        } 
        catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}
