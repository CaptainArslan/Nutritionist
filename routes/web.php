<?php

use App\Http\Controllers\AjaxXontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
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

// Form Actions
//Define Route for user Login
Route::post('/userlogin', [loginController::class, 'userlogin'])->name('userlogin');
//Define User Register Route
Route::post('/userregister', [loginController::class, 'userregister'])->name('userregister');
// Route::get('/', [loginController::class, 'login']);

Route::get('/logout', [loginController::class, 'logout'])->name('logout');

//Got to dashboard
Route::group(['middleware' => ['AuthMiddleWare']], function () {
    Route::get('/login', [loginController::class, 'login'])->name('login');
    Route::get('/register', [loginController::class, 'register'])->name('register');
    Route::get('/home', [loginController::class, 'dashboard'])->name('home');

    //Add Product Configuration

    // Prodect
    Route::get('/addproduct', [MainController::class, 'addproduct']);
    Route::match(['get', 'post'], '/add_product', [MainController::class, 'add_product'])->name('add_product');
    Route::get('/allproduct', [MainController::class, 'allproduct']);

    //Customer
    Route::get('/addcustomer', [MainController::class, 'addcustomer']);
    Route::match(['get', 'post'], '/add_customer', [MainController::class, 'customer'])->name('add_customer');
    Route::get('/allcustomer', [MainController::class, 'allcustomer']);

    // Nutritionist
    Route::match(['get', 'post'], '/addnutrition', [MainController::class, 'nutrition'])->name('nutrition');
    Route::match(['get', 'post'], '/allnutrition', [MainController::class, 'allnutrition']);

    //Profile
    Route::match(['get', 'post'], '/userprofile', [MainController::class, 'profile'])->name('profile');
    Route::match(['get', 'post'], '/ch_pass', [MainController::class, 'ch_pass'])->name('chpass');
    Route::match(['get', 'post'], '/dailyintake', [MainController::class, 'dailyintake'])->name('dailyintake');
    Route::match(['get', 'post'], '/report', [MainController::class, 'report'])->name('report');

    //Ajax Calls
    Route::post('/get_customer', [AjaxXontroller::class, 'get_customer']);
    Route::post('/get_products', [AjaxXontroller::class, 'get_product']);
    Route::post('/get_nutritionist', [AjaxXontroller::class, 'get_nutritionist']);
    Route::post('/intake', [AjaxXontroller::class, 'intake_product']);
    Route::post('/delrpt_intake', [AjaxXontroller::class, 'delrpt_intake']);
});
