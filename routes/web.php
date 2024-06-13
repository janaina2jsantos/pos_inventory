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
    Route::get('/dashboard', function () {
        $breadTitle = "Dashboard"; 
        return view('dashboard', compact('breadTitle'));
    })->name('dashboard');

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

    // advance-salaries 
    Route::get('/advance-salaries', 'AdvanceSalaryController@index')->name('advance-salaries.index');
    Route::get('/ajax/advance-salaries', 'AdvanceSalaryController@indexAjax')->name('advance-salaries.index.ajax');
    Route::get('/advance-salaries/create', 'AdvanceSalaryController@create')->name('advance-salaries.create');
    Route::post('/advance-salaries/create', 'AdvanceSalaryController@store')->name('advance-salaries.store');

    Route::get('/advance-salaries/{id}/edit', 'AdvanceSalaryController@edit')->name('advance-salaries.edit');
    Route::put('/advance-salaries/{id}/edit', 'AdvanceSalaryController@update')->name('advance-salaries.update');

    Route::delete('/advance-salaries/{id}/delete', 'AdvanceSalaryController@destroy')->name('advance-salaries.destroy');

});

// 00



// Route::get('/teste', function() {
//     // $a = [5, 6, 7];
//     // $b = [3, 6, 10];

//     $a = [17, 28, 30];
//     $b = [99, 16, 8];

//     print_r(compareTriplets($a, $b));
// });

// function compareTriplets($a, $b) {
//     $challengers = ['Alice' => 0, 'Bob' => 0];
    
//     foreach($a as $key => $value) {
//         if($a[$key] > $b[$key]) {
//             $challengers['Alice'] += 1;  
//         }
//         elseif($a[$key] == $b[$key]) {
//            continue;
//         }
//         else {
//             $challengers['Bob'] += 1;  
//         }
//     }
//     return array_values($challengers);
// }


require __DIR__.'/auth.php';








