<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    // dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    
    // employees 
    Route::get('/employees', 'EmployeeController@index')->name('employees.index');
    Route::get('/ajax/employees', 'EmployeeController@indexAjax')->name('employees.index.ajax');
    Route::get('/employees/create', 'EmployeeController@create')->name('employees.create');
    Route::post('/employees/create', 'EmployeeController@store')->name('employees.store');
    Route::get('/employees/{id}/show', 'EmployeeController@show')->name('employees.show');
    Route::get('/employees/{id}/edit', 'EmployeeController@edit')->name('employees.edit');
    Route::put('/employees/{id}/edit', 'EmployeeController@update')->name('employees.update');
    Route::delete('/employees/{id}/delete', 'EmployeeController@destroy')->name('employees.destroy');

    // customers 
    Route::get('/customers', 'CustomerController@index')->name('customers.index');
    Route::get('/ajax/customers', 'CustomerController@indexAjax')->name('customers.index.ajax');
    Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
    Route::post('/customers/create', 'CustomerController@store')->name('customers.store');
    Route::get('/customers/{id}/show', 'CustomerController@show')->name('customers.show');
    Route::get('/customers/{id}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::put('/customers/{id}/edit', 'CustomerController@update')->name('customers.update');
    Route::delete('/customers/{id}/delete', 'CustomerController@destroy')->name('customers.destroy');

    // suppliers 
    Route::get('/suppliers', 'SupplierController@index')->name('suppliers.index');
    Route::get('/ajax/suppliers', 'SupplierController@indexAjax')->name('suppliers.index.ajax');
    Route::get('/suppliers/create', 'SupplierController@create')->name('suppliers.create');
    Route::post('/suppliers/create', 'SupplierController@store')->name('suppliers.store');
    Route::get('/suppliers/{id}/show', 'SupplierController@show')->name('suppliers.show');
    Route::get('/suppliers/{id}/edit', 'SupplierController@edit')->name('suppliers.edit');
    Route::put('/suppliers/{id}/edit', 'SupplierController@update')->name('suppliers.update');
    Route::delete('/suppliers/{id}/delete', 'SupplierController@destroy')->name('suppliers.destroy');

    // salaries and advances
    Route::get('/advance-salaries', 'SalaryController@index')->name('advance-salaries.index');
    Route::get('/ajax/advance-salaries', 'SalaryController@indexAjax')->name('advance-salaries.index.ajax');
    Route::get('/advance-salaries/create', 'SalaryController@create')->name('advance-salaries.create');
    Route::post('/advance-salaries/create', 'SalaryController@store')->name('advance-salaries.store');
    Route::get('/advance-salaries/{id}/edit', 'SalaryController@edit')->name('advance-salaries.edit');
    Route::put('/advance-salaries/{id}/edit', 'SalaryController@update')->name('advance-salaries.update');
    Route::delete('/advance-salaries/{id}/delete', 'SalaryController@destroy')->name('advance-salaries.destroy');
    Route::get('/pay-salary', 'SalaryController@paySalary')->name('pay.salary');
    Route::get('/ajax/pay-salary', 'SalaryController@paySalaryAjax')->name('pay.salary.ajax');
    Route::post('/ajax/pay-salary/{id}', 'SalaryController@paySalaryToEmployeeAjax')->name('pay.salary.employee.ajax');
    Route::post('/ajax/advance-salaries/{id}/recurring', 'SalaryController@recurringAdvanceAjax')->name('advance-salaries.recurring');

    // categories 
    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::get('/ajax/categories', 'CategoryController@indexAjax')->name('categories.index.ajax');
    Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('/categories/create', 'CategoryController@store')->name('categories.store');
    Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('/categories/{id}/edit', 'CategoryController@update')->name('categories.update');
    Route::delete('/categories/{id}/delete', 'CategoryController@destroy')->name('categories.destroy');

    // products 
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/ajax/products', 'ProductController@indexAjax')->name('products.index.ajax');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::post('/products/create', 'ProductController@store')->name('products.store');
    Route::get('/products/{id}/show', 'ProductController@show')->name('products.show');
    Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('/products/{id}/edit', 'ProductController@update')->name('products.update');
    Route::delete('/products/{id}/delete', 'ProductController@destroy')->name('products.destroy');

    // expenses 
    Route::get('/expenses', 'ExpenseController@index')->name('expenses.index');
    Route::get('/ajax/expenses', 'ExpenseController@indexAjax')->name('expenses.index.ajax');
    Route::get('/expenses/create', 'ExpenseController@create')->name('expenses.create');
    Route::post('/expenses/create', 'ExpenseController@store')->name('expenses.store');
    Route::get('/expenses/{id}/edit', 'ExpenseController@edit')->name('expenses.edit');
    Route::put('/expenses/{id}/edit', 'ExpenseController@update')->name('expenses.update');
    Route::get('/expenses/today', 'ExpenseController@todayExpenses')->name('expenses.today');
    Route::get('/ajax/expenses/today', 'ExpenseController@todayExpensesAjax')->name('expenses.today.ajax');
    Route::get('/expenses/monthly', 'ExpenseController@monthlyExpenses')->name('expenses.monthly');
    Route::get('/ajax/expenses/monthly', 'ExpenseController@monthlyExpensesAjax')->name('expenses.monthly.ajax');
    Route::get('/expenses/yearly', 'ExpenseController@yearlyExpenses')->name('expenses.yearly');
    Route::get('/ajax/expenses/yearly', 'ExpenseController@yearlyExpensesAjax')->name('expenses.yearly.ajax');

    // attendances 
    Route::get('/attendances', 'AttendanceController@index')->name('attendances.index');
    Route::get('/ajax/attendances', 'AttendanceController@indexAjax')->name('attendances.index.ajax');
    Route::get('/attendances/take', 'AttendanceController@takeAttendance')->name('attendances.take');
    Route::get('/ajax/attendances/take', 'AttendanceController@takeAttendanceAjax')->name('attendances.take.ajax');
    Route::post('/attendances/{id}/create', 'AttendanceController@store')->name('attendances.store');
    Route::put('/attendances/{id}/edit/single', 'AttendanceController@update')->name('attendances.update');
    Route::get('/attendances/{date}/show', 'AttendanceController@showAttendances')->name('attendances.show');
    Route::get('/ajax/attendances/{date}/show', 'AttendanceController@editAttendancesAjax')->name('attendances.show.ajax');
    Route::get('/attendances/{date}/edit', 'AttendanceController@editAttendances')->name('attendances.edit');
    Route::get('/ajax/attendances/{date}/edit', 'AttendanceController@editAttendancesAjax')->name('attendances.edit.ajax');
    Route::delete('/attendances/{id}/delete', 'AttendanceController@destroy')->name('attendances.destroy');

    // settings 
    Route::get('/settings', 'CompanyController@edit')->name('settings.edit');
    Route::put('/settings', 'CompanyController@update')->name('settings.update');


    // 00:00



});

require __DIR__.'/auth.php';

