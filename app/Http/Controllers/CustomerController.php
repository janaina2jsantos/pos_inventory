<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\BUS\CustomerBUS;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->title = "Customers";
    }

    public function index()
    {
        return view("customers.index")
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
        $total = CustomerBUS::getCustomers($request)->count();
        $customers = CustomerBUS::getCustomers($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($customers)) {
            foreach($customers as $customer) {
                $data[] = [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'city' => $customer->city,
                    'state' => $customer->state,
                    'shop_name' => $customer->shop_name,
                    'photo' => $customer->photo,
                    'status'  => $customer->status
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
            ['name' => 'Data', 'url' => route('customers.index')],
            ['name' => 'Add Customer', 'url' => null],
        ];

        return view("customers.create")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(CustomerRequest $request) 
    {
        CustomerBUS::storeCustomer($request);
        return redirect()->route("customers.index")->with("success", "Customer created successfully.");
    }

    public function show($id) 
    { 
        $customer = Customer::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('customers.index')],
            ['name' => 'Basic Information', 'url' => null],
        ];

        return view("customers.show")
            ->with('customer', $customer)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function edit($id) 
    { 
        $customer = Customer::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('customers.index')],
            ['name' => 'Edit Customer', 'url' => null],
        ];

        return view("customers.edit")
            ->with('customer', $customer)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(CustomerRequest $request, $id) 
    {
        CustomerBUS::updateCustomer($request, $id);
        return redirect()->route("customers.index")->with("success", "Customer updated successfully.");
    }

    public function destroy($id) 
    {
        try {
            if (CustomerBUS::destroyCustomer($id)) {  
                return response()->json(["status" => true, "message" => "Customer deleted successfully."], 200);
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
