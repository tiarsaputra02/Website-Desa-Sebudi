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
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\FamilyHeadPuraController;
use App\Http\Controllers\FamilyHeadSorgaController;
use App\Http\Controllers\FamilyHeadDukuhController;
use App\Http\Controllers\CitizenSorgaController;
use App\Http\Controllers\CitizenDukuhController;
use App\Http\Controllers\CitizenPuraController;
use App\Http\Controllers\BpjsMemberPuraController;
use App\Http\Controllers\BpjsMemberSorgaController;
use App\Http\Controllers\BpjsMemberDukuhController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/',[FrontEndController::class,'index'])->name('dashboard');

Route::middleware('auth')->group(function(){

//Route Dashbiard
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard')->middleware('role:Admin Utama');

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

//Route Assistance
Route::resource('/assistance',AssistanceController::class);

//Route User/Akun
Route::resource('/user',UserController::class);
//



//Route Pura
Route::resource('family/pura',FamilyHeadPuraController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');
Route::get('/dashboard/pura',[DashboardController::class,'pura'])->name('dashboard.pura')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

//route Citizen Pura
Route::prefix('/citizen/pura')->name('citizen.pura.')->group(function () {

    Route::get('/{id}',[CitizenPuraController::class,'index'])->name('citizen.pura')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::get('/create/{id}', [CitizenPuraController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::post('/', [CitizenPuraController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::get('/{id}/edit', [CitizenPuraController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::put('/{id}', [CitizenPuraController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::delete('/{id}', [CitizenPuraController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::get('/list/{id}', [CitizenPuraController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

});
//Route Bpjs Pura
Route::prefix('bpjs/pura')->name('bpjs.pura.')->group(function () {

    Route::get('/', [BpjsMemberPuraController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::get('/create/{id}', [BpjsMemberPuraController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::post('/', [BpjsMemberPuraController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::get('/{id}/edit', [BpjsMemberPuraController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::put('/{id}', [BpjsMemberPuraController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');

    Route::delete('/{id}', [BpjsMemberPuraController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Pura');
});

//Route Sorga
Route::resource('family/sorga',FamilyHeadSorgaController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');
Route::get('/dashboard/sorga',[DashboardController::class,'sorga'])->name('dashboard.sorga')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

Route::prefix('/citizen/sorga')->name('citizen.sorga.')->group(function () {

    Route::get('/{id}',[CitizenSorgaController::class,'index'])->name('citizen.sorga')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::get('/create/{id}', [CitizenSorgaController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::post('/', [CitizenSorgaController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::get('/{id}/edit', [CitizenSorgaController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::put('/{id}', [CitizenSorgaController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::delete('/{id}', [CitizenSorgaController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::get('/list/{id}', [CitizenSorgaController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

});
//
//Route Bpjs
Route::prefix('bpjs/sorga')->name('bpjs.sorga.')->group(function () {

    Route::get('/', [BpjsMemberSorgaController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::get('/create/{id}', [BpjsMemberSorgaController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::post('/', [BpjsMemberSorgaController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::get('/{id}/edit', [BpjsMemberSorgaController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::put('/{id}', [BpjsMemberSorgaController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');

    Route::delete('/{id}', [BpjsMemberSorgaController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sorga');
});

//Route Sorga
Route::resource('family/dukuh',FamilyHeadDukuhController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');
Route::get('/dashboard/dukuh',[DashboardController::class,'dukuh'])->name('dashboard.dukuh')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

Route::prefix('/citizen/dukuh')->name('citizen.dukuh.')->group(function () {

    Route::get('/{id}',[CitizenDukuhController::class,'index'])->name('citizen.dukuh')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/create/{id}', [CitizenDukuhController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::post('/', [CitizenDukuhController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/{id}/edit', [CitizenDukuh::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::put('/{id}', [CitizenDukuhController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::delete('/{id}', [CitizenDukuhController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/list/{id}', [CitizenDukuhController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

});
//
//Route Bpjs
Route::prefix('bpjs/dukuh')->name('bpjs.dukuh.')->group(function () {

    Route::get('/', [BpjsMemberDukuhController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/create/{id}', [BpjsMemberDukuhController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::post('/', [BpjsMemberDukuhController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/{id}/edit', [BpjsMemberDukuhController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::put('/{id}', [BpjsMemberDukuhController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::delete('/{id}', [BpjsMemberDukuhController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');
});

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
