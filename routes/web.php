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
    Route::get('/employees/{id}/edit', 'EmployeeController@edit')->name('employees.edit');
    Route::put('/employees/{id}/edit', 'EmployeeController@update')->name('employees.update');
    Route::delete('/employees/{id}/delete', 'EmployeeController@destroy')->name('employees.destroy');
});

// 40 min

require __DIR__.'/auth.php';
