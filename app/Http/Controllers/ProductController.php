<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Http\BUS\ProductBUS;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->title = "Products";
    }

    public function index()
    {
        return view("products.index")
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
        $total = ProductBUS::getProducts($request)->count();
        $products = ProductBUS::getProducts($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];
        
        if(!empty($products)) {
            foreach($products as $product) {
                $data[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'code' => $product->code,
                    'selling_price' => number_format($product->selling_price, 2, ',', '.'),
                    'expire_date' => $product->expire_date->format('d/m/Y'),
                    'image' => $product->image,
                    'status' => $product->status,
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
        $categories = Category::all();
        $suppliers = Supplier::where('status', 1)->get();
        $breadItems = [
            ['name' => 'Data', 'url' => route('products.index')],
            ['name' => 'Add Product', 'url' => null],
        ];

        return view("products.create")
            ->with('categories', $categories)
            ->with('suppliers', $suppliers)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(ProductRequest $request) 
    {
        ProductBUS::storeProduct($request);
        return redirect()->route("products.index")->with("success", "Product successfully created.");
    }

    public function show($id) 
    { 
        $product = Product::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('products.index')],
            ['name' => 'Basic Information', 'url' => null],
        ];
        
        return view("products.show")
            ->with('product', $product)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function edit($id) 
    { 
        $product = Product::findOrFail($id); 
        $categories = Category::all();
        $suppliers = Supplier::where('status', 1)->get();
        $breadItems = [
            ['name' => 'Data', 'url' => route('products.index')],
            ['name' => 'Edit Product', 'url' => null],
        ];

        return view("products.edit")
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('suppliers', $suppliers)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(ProductRequest $request, $id) 
    {
        ProductBUS::updateProduct($request, $id);
        return redirect()->route("products.index")->with("success", "Product successfully updated.");
    }

    public function destroy($id) 
    {
        if(ProductBUS::destroyProduct($id)) {  
            return response()->json(["status" => true, "message" => "Product successfully deleted."], 200);
        }
        else {
            return response()->json(["status" => false, "message" => "This action couldn't be completed."], 400); 
        }
    }
}
