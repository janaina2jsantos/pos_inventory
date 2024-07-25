<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\BUS\ExpenseBUS;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->title = "Expenses";
    }

    public function create() 
    {
        $breadItems = [
            ['name' => 'Data', 'url' => route('expenses.today')],
            ['name' => 'Add Expense', 'url' => null],
        ];

        return view("expenses.create")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(ExpenseRequest $request) 
    {
        ExpenseBUS::storeExpense($request);
        return redirect()->back()->with("success", "Expense successfully created.");
    }

    public function edit($id) 
    { 
        $expense = Expense::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('expenses.today')],
            ['name' => 'Edit Expense', 'url' => null],
        ];

        return view("expenses.edit")
            ->with('expense', $expense)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(ExpenseRequest $request, $id) 
    {
        ExpenseBUS::updateExpense($request, $id);
        return redirect()->back()->with("success", "Expense successfully updated.");
    }

    public function todayExpenses()
    {
        $expensesCount = number_format(Expense::whereDate('created_at', Carbon::now()->format('Y-m-d'))->sum('amount'), 2, ',', '.');
        
        return view("expenses.today")
            ->with('expensesCount', $expensesCount)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function todayExpensesAjax(Request $request)
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
        $total = ExpenseBUS::todayExpenses($request)->count();
        $expenses = ExpenseBUS::todayExpenses($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($expenses)) {
            foreach($expenses as $expense) {
                $data[] = [
                    'id' => $expense->id,
                    'details' => $expense->details,
                    'amount' => number_format($expense->amount, 2, ',', '.'),
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

    public function monthlyExpenses()
    {
        $expensesCount = number_format(Expense::whereMonth('created_at', Carbon::now()->format('m'))->sum('amount'), 2, ',', '.');

        return view("expenses.monthly")
            ->with('expensesCount', $expensesCount)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function monthlyExpensesAjax(Request $request)
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

        // $test = ExpenseBUS::monthlyExpenses($request);
        // return response()->json($test);

        // Get how many items there should be
        $total = ExpenseBUS::monthlyExpenses($request)->count();
        $expenses = ExpenseBUS::monthlyExpenses($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($expenses)) {
            foreach($expenses as $expense) {
                $data[] = [
                    'id' => $expense->id,
                    'details' => $expense->details,
                    'amount' => number_format($expense->amount, 2, ',', '.'),
                    'date' => Carbon::parse($expense->created_at)->format('d/m/Y'),
                    'searchedMonth' => Carbon::parse($request->month)->format('F')
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

    public function yearlyExpenses()
    {
        $expensesCount = number_format(Expense::whereYear('created_at', Carbon::now()->format('Y'))->sum('amount'), 2, ',', '.');

        return view("expenses.yearly")
            ->with('expensesCount', $expensesCount)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function yearlyExpensesAjax(Request $request)
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
        $total = ExpenseBUS::yearlyExpenses($request)->count();
        $expenses = ExpenseBUS::yearlyExpenses($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($expenses)) {
            foreach($expenses as $expense) {
                $data[] = [
                    'id' => $expense->id,
                    'details' => $expense->details,
                    'date' => Carbon::parse($expense->created_at)->format('d/m/Y'),
                    'amount' => number_format($expense->amount, 2, ',', '.'),
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
}
