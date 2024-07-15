<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CostumerController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);


	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('/orders', [OrderController::class, 'index'])->name('orders');
	Route::post('/confirm/{id}',[OrderController::class, 'confirm'])->name('orders.confirm');
	Route::get('/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('products', [ProductController::class, 'index'])->name('products');
	Route::post('updateProduct/{id}', [ProductController::class, 'update'])->name('products.update');
	Route::get('insert-products', [ProductController::class, 'insert'])->name('products.insert');



	Route::get('clients', [CostumerController::class, 'index'])->name('clients');
	Route::post('add',[CostumerController::class, 'add'])->name('clients.add');
	Route::post('updateClient/{phone}', [CostumerController::class, 'update'])->name('clients.update');
	Route::get('insert-client', [CostumerController::class, 'insert'])->name('clients.insert');


    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});


Route::group(['middleware' => 'guest'], function () {


    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');


Route::group(['middleware' => 'auth.admin'], function () {

    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');

	Route::get('user-management', [UsersController::class, 'index'])->name('users');
	Route::post('addUser', [UsersController::class, 'add'])->name('users.add');
	Route::post('updateUser/{id}', [UsersController::class, 'update'])->name('users.update');
	Route::get('deleteUser/{id}', [UsersController::class, 'delete'])->name('users.delete');




}

);
