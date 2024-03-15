<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\HomeCareController;
use App\Http\Controllers\HomeCarePatientController;
use App\Http\Controllers\HomeCareRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return to_route('auth.login');
});

Route::controller(AuthController::class)->middleware('guest')->prefix('auth')->name('auth.')->group(function(){
    Route::get('login', 'login')->name('login');
    Route::post('verify', 'verify')->name('verify');
    Route::get('register', 'register')->name('register');
    Route::post('registration', 'registration')->name("registration");
});

Route::middleware('auth:web,patient')->group(function(){
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('editprofile', [AuthController::class, 'editProfile'])->name('edit-profile');
    Route::put('update-password', [AuthController::class, 'updatePassword'])->name('update-password');
    Route::put('update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::middleware('roles_check:Administrator')->group(function(){
        Route::controller(GenderController::class)->prefix('gender')->name('gender.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('datatable', 'datatable');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::prefix("{id}")->group(function(){
                Route::get('edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::get('delete', 'delete')->name('delete');
            });
        });
    
        Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('datatable', 'datatable');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::prefix("{id}")->group(function(){
                Route::get('edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::get('delete', 'delete')->name('delete');
            });
        });
    
        Route::controller(StatusController::class)->prefix('status')->name('status.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('datatable', 'datatable');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::prefix("{id}")->group(function(){
                Route::get('edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::get('delete', 'delete')->name('delete');
            });
        });

        Route::controller(UserController::class)->prefix('user')->name('user.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('datatable', 'datatable');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::prefix("{id}")->group(function(){
                Route::get('edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::get('delete', 'delete')->name('delete');
            });
        });

        Route::controller(PatientController::class)->prefix('patient')->name('patient.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('datatable', 'datatable');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::prefix("{id}")->group(function(){
                Route::get('detail', 'detail')->name('detail');
                Route::get('edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::get('delete', 'delete')->name('delete');
            });
        });
    });

    Route::middleware('roles_check:Doctor,Nurse')->group(function(){
        Route::controller(HomeCarePatientController::class)->prefix('home-care-patient')->name('home_care_patient.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/datatable', 'datatable');
            Route::prefix('{id}')->group(function(){
                Route::get('detail', 'detail')->name('detail');
                Route::post('detail/send-chat', 'sendChat');
                Route::get('detail/get-chat', 'getChat');
                Route::get('change-status/{statusId}', 'changeStatus');
                Route::get('change-dpjp/{dpjpId}', 'changeDpjp');
            });
        });

        Route::controller(ReportController::class)->prefix('report')->name('report.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('graphic/{dateRange}', 'graphic');
        });
    });

    Route::middleware('roles_check:Patient')->group(function(){
        Route::controller(HomeCareRegisterController::class)->prefix('home-care-register')->name('home_care_register.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'registration')->name('registration');
        });

        Route::controller(HomeCareController::class)->prefix('home-care')->name('home_care.')->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('get-chat', 'getChat');
            Route::post('send-chat', 'sendChat');
        });
    });
});