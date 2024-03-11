<?php

use App\Http\Controllers\AcueilActionController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckUser;
use App\Http\Middleware\CheckAdmin;
use App\Models\Ticket;

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

// Event routes

// Authentication routes
Route::get('/signUp', [AuthentificationController::class, 'getSignUpView'])->name('getSignUpView');
Route::post('/register', [AuthentificationController::class, 'register'])->name('auth_Rogister');
Route::get('/signIn', [AuthentificationController::class, 'getSignInView'])->name('getSignInView');
Route::post('/login', [AuthentificationController::class, 'login'])->name('auth_Login');


// forget password
Route::get('/forgetpassword', [ForgetPasswordController::class, 'forgetPassword'])->name("getForgotPasswordView");
Route::post('/sendToEmail', [ForgetPasswordController::class, 'sendToEmail'])->name("auth_sendToEmail");
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'getThenewPassword'])->name('reset-password');
Route::post('/insertnewpassword/{token}', [ForgetPasswordController::class, 'addNewPassword'])->name('new_password');


// Detail
Route::get('detail', [ReservationController::class, 'detail'])->name('front-office.detail');
Route::get('galory', [ReservationController::class, 'galory'])->name('front-office.galory');
// Route::get('/events/search', [AcueilActionController::class, 'search'])->name('events.search');

// Route::get('/events/filter', [AcueilActionController::class, 'filter'])->name('events.filter');

Route::get('/categories/{categoryId}/events/{textsearch}', [AcueilActionController::class, 'EventsByCategory']);

Route::get('/', [ReservationController::class, 'index'])->name('acceuill');
Route::match(['get', 'post'], '/reserveTicket', [ReservationController::class, 'reserve'])->name('reserveTicket');


// Auth midleweare
Route::group(['middleware' => [CheckAuth::class]], function () {
    Route::get('logout', [AuthentificationController::class, 'logout'])->name('auth_Logout');
    // ADMIN
    Route::prefix('admin')->middleware('admin')->group(function () {

        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('Category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::DELETE('Category/delte', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::put('Category/update', [CategoryController::class, 'update'])->name('category.update');

        // Handle event admin
        Route::get('eventHundel', [AdminController::class, 'index'])->name('eventsHundel');
        Route::post('eventAction', [AdminController::class, 'action'])->name('eventAction');

        //Statistique
        Route::get('adminStatstique', [DashboardController::class, 'adminStatstique'])->name('adminStatstique');
        // USER CRUD
        Route::get('user', [AdminController::class, 'getAllUser'])->name('user.index');
        Route::post('user/store', [AdminController::class, 'store'])->name('user.store');
        Route::DELETE('user/delte/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
        Route::put('user/update/{id}', [AdminController::class, 'update'])->name('user.update');
    });

    // organzer
    Route::prefix('organizer')->middleware('organizer')->group(function () {

        Route::get('event', [EventController::class, 'index'])->name('event.index');
        Route::post('event/store', [EventController::class, 'store'])->name('events.store');
        Route::delete('event/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::put('event/update/{id}', [EventController::class, 'update'])->name('event.update');
        // Action reservation organizateur 
        Route::get('/getAllReservation', [ReservationController::class, 'getAllReservation'])->name('getAllReservation');
        Route::match(['get', 'post'], '/acceptReservation', [ReservationController::class, 'acceptReservation'])->name('reservation.accept');
        Route::match(['get', 'post', 'delete'], '/refuseReservation', [ReservationController::class, 'refuseReservation'])->name('reservation.refuse');

        //  statistiques

        Route::get('/organizerStatstique', [DashboardController::class, 'organizerStatstique'])->name('organizerStatstique');
    });



    // USER
    // Route::prefix('user')->middleware('user')->group(function () {


    // });

    // ORGANZER

});
