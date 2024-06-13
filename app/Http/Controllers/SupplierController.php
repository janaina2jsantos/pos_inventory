<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\BUS\SupplierBUS;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->title = "Suppliers";
    }

    public function index()
    {
        return view("suppliers.index")
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
        $total = SupplierBUS::getSuppliers($request)->count();
        $suppliers = SupplierBUS::getSuppliers($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($suppliers)) {
            foreach($suppliers as $supplier) {
                $data[] = [
                    'id' => $supplier->id,
                    'name' => $supplier->name,
                    'email' => $supplier->email,
                    'phone' => $supplier->phone,
                    'city' => $supplier->city,
                    'state' => $supplier->state,
                    'type' => $supplier->type,
                    'status'  => $supplier->status
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
            ['name' => 'Data', 'url' => route('suppliers.index')],
            ['name' => 'Add Supplier', 'url' => null],
        ];

        return view("suppliers.create")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(SupplierRequest $request) 
    {
        SupplierBUS::storeSupplier($request);
        return redirect()->route("suppliers.index")->with("success", "Supplier created successfully.");
    }

     public function show($id) 
    { 
        $supplier = Supplier::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('suppliers.index')],
            ['name' => 'Basic Information', 'url' => null],
        ];

        return view("suppliers.show")
            ->with('supplier', $supplier)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function edit($id) 
    { 
        $supplier = Supplier::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('suppliers.index')],
            ['name' => 'Edit Supplier', 'url' => null],
        ];

        return view("suppliers.edit")
            ->with('supplier', $supplier)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(SupplierRequest $request, $id) 
    {
        SupplierBUS::updateSupplier($request, $id);
        return redirect()->route("suppliers.index")->with("success", "Supplier updated successfully.");
    }

    public function destroy($id) 
    {
        try {
            if (SupplierBUS::destroySupplier($id)) {  
                return response()->json(["status" => true, "message" => "Supplier deleted successfully."], 200);
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
