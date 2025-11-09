<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\VillagesController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfesionController;
use App\Http\Controllers\MaritalStatusController;

Route::get('/', function () {
    return view('welcome');
});
//Route Dashbiard
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

//Route Empeloyee
Route::resource('/employee',EmployeesController::class);

//Route Role
Route::resource('/role',RoleController::class);

//Route village
Route::resource('/village',VillagesController::class);

//Route village
Route::resource('/religion',ReligionController::class);

//Route village
Route::resource('/education',EducationController::class);
//
//Route profesion
Route::resource('/profesion',ProfesionController::class);

//Route Marital
Route::resource('/marital',MaritalStatusController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
