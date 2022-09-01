<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;

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

    // profile
    Route::controller(ProfessionalController::class)->group(function () {
        Route::get('/professional/profile', 'view')->name('professional.profile.view');
        Route::post('/professional/profile/update','update')->name('professional.profile.update');
    });

    // content
    Route::controller(ContentController::class)->group(function() {
        Route::get('/professional/content', 'view')->name('professional.content.view');
        Route::post('/professional/content/add', 'add')->name('professional.content.add');
        Route::post('/professional/content/search', 'search')->name('professional.content.search');
        Route::post('/professional/content/filter', 'filter')->name('professional.content.filter');
        Route::get('/professional/content/delete/{id}', 'delete')->name('professional.content.delete');
        Route::get('/professional/content/edit/{id}', 'edit')->name('professional.content.edit');
        Route::post('/professional/content/update', 'update')->name('professional.content.update');

        // detail
        Route::get('/professional/content/detail/{id}', 'viewDetail')->name('professional.content_detail.view');
        Route::post('/professional/content/detail/add', 'addDetail')->name('professional.content_detail.add');
        Route::get('/professional/content/detail/delete/{id}', 'deleteDetail')->name('professional.content_detail.delete');
        Route::get('/professional/content/detail/edit/{id}', 'editDetail')->name('professional.content_detail.edit');
        Route::post('/professional/content/detail/update', 'updateDetail')->name('professional.content_detail.update');
    });

    // event
    Route::controller(EventController::class)->group(function() {
        Route::get('/professional/event', 'view')->name('professional.event.view');
        Route::get('/professional/event/add/{type}', 'add')->name('professional.event.add');
        Route::post('/professional/event/create', 'create')->name('professional.event.create');
        Route::get('/professional/event/edit/{id}', 'edit')->name('professional.event.edit');
        Route::post('/professional/event/update', 'update')->name('professional.event.update');
        Route::get('/professional/event/delete/{id}', 'delete')->name('professional.event.delete');
        Route::post('/professional/event/search', 'search')->name('professional.event.search');
        Route::post('/professional/event/filter', 'filter')->name('professional.event.filter');
        Route::get('/professional/event/all', 'viewAll')->name('professional.event.viewAll');
    });

    // schedule
    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/professional/event/{id}/schedule', 'view')->name('professional.event.schedule.view');
        Route::post('/professional/event/schedule/create', 'create')->name('professional.event.schedule.create');
        Route::get('/professional/event/schedule/edit/{id}', 'edit')->name('professional.event.schedule.edit');
        Route::post('/professional/event/schedule/update', 'update')->name('professional.event.schedule.update');
        Route::get('/professional/event/schedule/delete/{id}', 'delete')->name('professional.event.schedule.delete');
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

Route::controller(EventController::class)->group(function () {
    Route::get('/event', 'userView')->name('event.view');
});

Route::controller(AppointmentController::class)->group(function () {
    Route::get('/appointment/add/view/{id}', 'viewAddPage')->name('appointment.add.view');
    Route::post('/appointment/add', 'add')->name('appointment.add');
    Route::get('/appointment/cancel/{id}', 'delete')->name('appointment.delete');
});