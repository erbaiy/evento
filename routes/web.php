<?php

use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Authenfication routes

Route::get('/signUp', [AuthentificationController::class, 'getSignUpView'])->name('getSignUpView');
Route::post('/register', [AuthentificationController::class, 'register'])->name('auth_Rogister');
Route::get('/signIn', [AuthentificationController::class, 'getSignInView'])->name('getSignInView');
Route::post('/login', [AuthentificationController::class, 'login'])->name('auth_Login');


// Reset password routes

Route::get('/forgetpassword', [ForgetPasswordController::class, 'forgetPassword'])->name("getForgotPasswordView");
Route::post('/sendToEmail', [ForgetPasswordController::class, 'sendToEmail'])->name("auth_sendToEmail");
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'getThenewPassword'])->name('reset-password');
Route::post('/insertnewpassword/{token}', [ForgetPasswordController::class, 'addNewPassword'])->name('new_password');



// category
Route::get('Category/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('Category/store', [CategoryController::class, 'store'])->name('category.store');
Route::DELETE('Category/delte', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::put('Category/update', [CategoryController::class, 'update'])->name('category.update');





// front-office view

Route::get('index', function () {
    return view('front-office.index');
});
Route::get('detail', function () {
    return view('front-office.detail');
});

//event 
Route::get('event', [EventController::class, 'index'])->name('event.index');
Route::post('event/store', [EventController::class, 'store'])->name('events.store');
Route::delete('event/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');
