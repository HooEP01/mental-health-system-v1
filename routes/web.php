<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EventController;

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

Auth::routes();

Route::get('/login/professional', [LoginController::class, 'showProfessionalLoginForm']);
Route::get('/register/professional', [RegisterController::class, 'showProfessionalRegisterForm']);

Route::post('/login/professional', [LoginController::class,'professionalLogin']);
Route::post('/register/professional', [RegisterController::class,'createProfessional']);

Route::group(['middleware' => 'auth:professional'], function () {
    // home
    Route::get('/professional', [HomeController::class, 'professional'])->name('professional.home');

    // schedule
    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/professional/schedule', 'view')->name('schedule.view');
        Route::post('/professional/schedule/add', 'add')->name('schedule.add');
        Route::get('/professional/schedule/delete/{id}', 'delete')->name('schedule.delete');
    });

    // profile
    Route::controller(ProfessionalController::class)->group(function () {
        Route::get('/professional/profile', 'view')->name('professional.profile.view');
        Route::post('/professional/profile/update','update')->name('professional.profile.update');
    });

    // content
    Route::controller(ContentController::class)->group(function() {
        Route::get('/professional/content', 'view')->name('professional.content.view');
        Route::post('/professional/content/add', 'add')->name('professional.content.add');

        // detail
        Route::get('/professional/content/detail/{id}', 'viewDetail')->name('professional.content_detail.view');
        Route::post('/professional/content/detail/add', 'addDetail')->name('professional.content_detail.add');
        Route::get('/professional/content/detail/delete/{id}', 'deleteDetail')->name('professional.content_detail.delete');
    });

    Route::controller(EventController::class)->group(function() {
        Route::get('/professional/event', 'view')->name('professional.event.view');
        Route::post('/professional/event/add', 'add')->name('professional.event.add');
        Route::get('/professional/event/edit/{id}', 'edit')->name('professional.event.edit');
        Route::post('/professional/event/update', 'update')->name('professional.event.update');
        Route::get('/professional/event/delete/{id}', 'delete')->name('professional.event.delete');
    });
});



Route::get('logout', [LoginController::class,'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
| Professional - Schedule
*/

/*
| User - Profile
*/
Route::get('/profile', [App\Http\Controllers\UserController::class, 'view'])->name('profile.view');
Route::get('/profile/add', [App\Http\Controllers\UserController::class, 'add'])->name('profile.add');
Route::get('/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');