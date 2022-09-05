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


/*
| Landing page
*/
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

/*
| Professional's
| Authentication and Authorization
*/
Route::get('/login/professional', [LoginController::class, 'showProfessionalLoginForm']);
Route::get('/register/professional', [RegisterController::class, 'showProfessionalRegisterForm']);
Route::post('/login/professional', [LoginController::class,'professionalLogin']);
Route::post('/register/professional', [RegisterController::class,'createProfessional']);

/*
| Professional's Route &
| Administrator's Route
*/
Route::group(['middleware' => 'auth:professional'], function () {
    /*
    | Home page
    */
    Route::get('/professional', [HomeController::class, 'professional'])->name('professional.home');

    /*
    | Profile page
    */
    Route::controller(ProfessionalController::class)->group(function () {
        Route::get('/professional/profile', 'view')->name('professional.profile.view');
        Route::post('/professional/profile/update','update')->name('professional.profile.update');

        /*
        | Administrator
        | profile view
        */
    });

    /*
    | Content page 
    | Include(Content, Content Detail, Content Community & Content Community Detail page)
    */
    Route::controller(ContentController::class)->group(function() {
        // content
        Route::get('/professional/content', 'view')->name('professional.content.view');
        Route::get('/professional/content/add', 'add')->name('professional.content.add');
        Route::post('/professional/content/create', 'create')->name('professional.content.create');
        Route::post('/professional/content/search', 'search')->name('professional.content.search');
        Route::post('/professional/content/filter', 'filter')->name('professional.content.filter');
        Route::get('/professional/content/delete/{id}', 'delete')->name('professional.content.delete');
        Route::get('/professional/content/edit/{id}', 'edit')->name('professional.content.edit');
        Route::post('/professional/content/update', 'update')->name('professional.content.update');

        // content detail
        Route::get('/professional/content/detail/{id}', 'viewDetail')->name('professional.content_detail.view');
        Route::post('/professional/content/detail/add', 'addDetail')->name('professional.content_detail.add');
        Route::get('/professional/content/detail/delete/{id}', 'deleteDetail')->name('professional.content_detail.delete');
        Route::get('/professional/content/detail/edit/{id}', 'editDetail')->name('professional.content_detail.edit');
        Route::post('/professional/content/detail/update', 'updateDetail')->name('professional.content_detail.update');

        // community
        Route::get('/professional/content/community', 'viewAll')->name('professional.content.community.view');
        Route::post('/professional/content/community/search', 'searchAll')->name('professional.content.community.search');
        Route::post('/professional/content/community/filter', 'filterAll')->name('professional.content.community.filter');

        // community detail
        Route::get('/professional/content/community/detail/{id}', 'viewDetailAll')->name('professional.content.community.detail.view');

        /*
        | Administrator
        | content approve
        */
        Route::get('/administrator/content', 'adminView')->name('administrator.content.view')->middleware('is_admin');;
        Route::get('/administrator/content/approve/{id}', 'adminApprove')->name('administrator.content.approve')->middleware('is_admin');;
    });

    /*
    | Event page 
    */
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

        /*
        | Administrator
        | event approve
        */
    });

    /*
    | Schedule page 
    */
    Route::controller(ScheduleController::class)->group(function () {
        Route::get('/professional/event/{id}/schedule', 'view')->name('professional.event.schedule.view');
        Route::post('/professional/event/schedule/create', 'create')->name('professional.event.schedule.create');
        Route::get('/professional/event/schedule/edit/{id}', 'edit')->name('professional.event.schedule.edit');
        Route::post('/professional/event/schedule/update', 'update')->name('professional.event.schedule.update');
        Route::get('/professional/event/schedule/delete/{id}', 'delete')->name('professional.event.schedule.delete');
    });

    /*
    | Appointment page
    */
    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/professional/appointment', 'view')->name('professional.appointment.view');
        Route::get('/professional/appointment/approve/{id}', 'approve')->name('professional.appointment.approve');
    });

    /*
    | Chat page
    */

    /*
    | Task page
    */

    /*
    | Payment page
    */

});


    /*
    | Home page
    */
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /*
    | Profile page
    */
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'view')->name('profile.view');
        Route::get('/profile/update', 'update')->name('profile.update');
    });
    
    /*
    | Content page
    */

    /*
    | Event page
    */
    Route::controller(EventController::class)->group(function () {
        Route::get('/event', 'userView')->name('event.view');
    });

    /*
    | Appointment page
    */
    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/appointment/add/{id}', 'userAdd')->name('appointment.add');
        Route::post('/appointment/create', 'userCreate')->name('appointment.create');
        Route::get('/appointment/cancel/{id}', 'userDelete')->name('appointment.delete');
    });

    /*
    | Chat page
    */

    /*
    | Task page
    */

    /*
    | Payment page
    */
    Route::controller(AppointmentController::class)->group(function () {
        Route::get('/appointment/payment/add/{id}', 'add')->name('appointment.add');
        Route::post('/appointment/payment/create', 'create')->name('appointment.create');
    });



/*
| Logout page
| Applicable for (User, Professional & Administrator)
*/
Route::get('logout', [LoginController::class,'logout']);