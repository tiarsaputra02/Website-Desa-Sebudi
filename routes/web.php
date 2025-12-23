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
use App\Http\Controllers\FamilyHeadSebudiController;
use App\Http\Controllers\FamilyHeadTengahController;
use App\Http\Controllers\FamilyHeadKelodanController;
use App\Http\Controllers\FamilyHeadAncutController;
use App\Http\Controllers\FamilyHeadYehaController;
use App\Http\Controllers\FamilyHeadLebihController;
use App\Http\Controllers\FamilyHeadBuanaController;
use App\Http\Controllers\CitizenSorgaController;
use App\Http\Controllers\CitizenDukuhController;
use App\Http\Controllers\CitizenPuraController;
use App\Http\Controllers\CitizenSebudiController;
use App\Http\Controllers\CitizenTengahController;
use App\Http\Controllers\CitizenKelodanController;
use App\Http\Controllers\CitizenAncutController;
use App\Http\Controllers\CitizenYehaController;
use App\Http\Controllers\CitizenLebihController;
use App\Http\Controllers\CitizenBuanaController;
use App\Http\Controllers\BpjsMemberPuraController;
use App\Http\Controllers\BpjsMemberSorgaController;
use App\Http\Controllers\BpjsMemberDukuhController;
use App\Http\Controllers\BpjsMemberSebudiController;
use App\Http\Controllers\BpjsMemberTengahController;
use App\Http\Controllers\BpjsMemberKelodanController;
use App\Http\Controllers\BpjsMemberAncutController;
use App\Http\Controllers\BpjsMemberYehaController;
use App\Http\Controllers\BpjsMemberLebihController;
use App\Http\Controllers\BpjsMemberBuanaController;
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

//Route Dukuh
Route::resource('family/dukuh',FamilyHeadDukuhController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');
Route::get('/dashboard/dukuh',[DashboardController::class,'dukuh'])->name('dashboard.dukuh')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

Route::prefix('/citizen/dukuh')->name('citizen.dukuh.')->group(function () {

    Route::get('/{id}',[CitizenDukuhController::class,'index'])->name('citizen.dukuh')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/create/{id}', [CitizenDukuhController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::post('/', [CitizenDukuhController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/{id}/edit', [CitizenDukuhController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::put('/{id}', [CitizenDukuhController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::delete('/{id}', [CitizenDukuhController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/list/{id}', [CitizenDukuhController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

});
//
//Route Bpjs Dukuh
Route::prefix('bpjs/dukuh')->name('bpjs.dukuh.')->group(function () {

    Route::get('/', [BpjsMemberDukuhController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/create/{id}', [BpjsMemberDukuhController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::post('/', [BpjsMemberDukuhController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::get('/{id}/edit', [BpjsMemberDukuhController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::put('/{id}', [BpjsMemberDukuhController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');

    Route::delete('/{id}', [BpjsMemberDukuhController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Dukuh');
});

//Route Sebudi
Route::resource('family/sebudi',FamilyHeadSebudiController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');
Route::get('/dashboard/sebudi',[DashboardController::class,'sebudi'])->name('dashboard.sebudi')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

Route::prefix('/citizen/sebudi')->name('citizen.sebudi.')->group(function () {

    Route::get('/{id}',[CitizenSebudiController::class,'index'])->name('citizen.sebudi')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::get('/create/{id}', [CitizenSebudiController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::post('/', [CitizenSebudiController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::get('/{id}/edit', [CitizenSebudiController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::put('/{id}', [CitizenSebudiController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::delete('/{id}', [CitizenSebudiController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::get('/list/{id}', [CitizenSebudiController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

});
//
//Route Bpjs Sebudi
Route::prefix('bpjs/sebudi')->name('bpjs.sebudi.')->group(function () {

    Route::get('/', [BpjsMemberSebudiController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::get('/create/{id}', [BpjsMemberSebudiController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::post('/', [BpjsMemberSebudiController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::get('/{id}/edit', [BpjsMemberSebudiController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::put('/{id}', [BpjsMemberSebudiController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');

    Route::delete('/{id}', [BpjsMemberSebudiController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Sebudi');
});

//Route Tengah
Route::resource('family/tengah',FamilyHeadTengahController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');
Route::get('/dashboard/tengah',[DashboardController::class,'tengah'])->name('dashboard.tengah')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

Route::prefix('/citizen/tengah')->name('citizen.tengah.')->group(function () {

    Route::get('/{id}',[CitizenTengahController::class,'index'])->name('citizen.tengah')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::get('/create/{id}', [CitizenTengahController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::post('/', [CitizenTengahController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::get('/{id}/edit', [CitizenTengahController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::put('/{id}', [CitizenTengahController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::delete('/{id}', [CitizenTengahController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::get('/list/{id}', [CitizenTengahController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

});
//
//Route Bpjs Sebudi
Route::prefix('bpjs/tengah')->name('bpjs.tengah.')->group(function () {

    Route::get('/', [BpjsMemberTengahController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::get('/create/{id}', [BpjsMemberTengahController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::post('/', [BpjsMemberTengahController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::get('/{id}/edit', [BpjsMemberTengahController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::put('/{id}', [BpjsMemberTengahController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

    Route::delete('/{id}', [BpjsMemberTengahController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');
});
    //
//Route Tengah
Route::resource('family/kelodan',FamilyHeadKelodanController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');
Route::get('/dashboard/kelodan',[DashboardController::class,'kelodan'])->name('dashboard.kelodan')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

Route::prefix('/citizen/kelodan')->name('citizen.kelodan.')->group(function () {

    Route::get('/{id}',[CitizenKelodanController::class,'index'])->name('citizen.kelodan')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::get('/create/{id}', [CitizenKelodanController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::post('/', [CitizenKelodanController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::get('/{id}/edit', [CitizenKelodanController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::put('/{id}', [CitizenKelodanController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::delete('/{id}', [CitizenKelodanController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::get('/list/{id}', [CitizenKelodanController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Tengah');

});
//
//Route Bpjs Sebudi
Route::prefix('bpjs/kelodan')->name('bpjs.kelodan.')->group(function () {

    Route::get('/', [BpjsMemberKelodanController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::get('/create/{id}', [BpjsMemberKelodanController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::post('/', [BpjsMemberKelodanController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::get('/{id}/edit', [BpjsMemberKelodanController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::put('/{id}', [BpjsMemberKelodanController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');

    Route::delete('/{id}', [BpjsMemberKelodanController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');
});
    //
//Route Ancut
Route::resource('family/ancut',FamilyHeadAncutController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');
Route::get('/dashboard/ancut',[DashboardController::class,'ancut'])->name('dashboard.ancut')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

Route::prefix('/citizen/ancut')->name('citizen.ancut.')->group(function () {

    Route::get('/{id}',[CitizenAncutController::class,'index'])->name('citizen.ancut')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::get('/create/{id}', [CitizenAncutController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::post('/', [CitizenAncutController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::get('/{id}/edit', [CitizenAncutController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::put('/{id}', [CitizenAncutController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::delete('/{id}', [CitizenAncutController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::get('/list/{id}', [CitizenAncutController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

});
//
//Route Bpjs Ancut
Route::prefix('bpjs/ancut')->name('bpjs.ancut.')->group(function () {

    Route::get('/', [BpjsMemberAncutController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::get('/create/{id}', [BpjsMemberAncutController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::post('/', [BpjsMemberAncutController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::get('/{id}/edit', [BpjsMemberAncutController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::put('/{id}', [BpjsMemberAncutController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Ancut');

    Route::delete('/{id}', [BpjsMemberAncutController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Kelodan');
});

//Route Yeha
Route::resource('family/yeha',FamilyHeadYehaController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');
Route::get('/dashboard/yeha',[DashboardController::class,'yeha'])->name('dashboard.yeha')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

Route::prefix('/citizen/yeha')->name('citizen.yeha.')->group(function () {

    Route::get('/{id}',[CitizenYehaController::class,'index'])->name('citizen.yeha')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::get('/create/{id}', [CitizenYehaController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::post('/', [CitizenYehaController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::get('/{id}/edit', [CitizenYehaController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::put('/{id}', [CitizenYehaController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::delete('/{id}', [CitizenYehaController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::get('/list/{id}', [CitizenYehaController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

});
//
//Route Bpjs Yeha
Route::prefix('bpjs/yeha')->name('bpjs.yeha.')->group(function () {

    Route::get('/', [BpjsMemberYehaController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::get('/create/{id}', [BpjsMemberYehaController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::post('/', [BpjsMemberYehaController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::get('/{id}/edit', [BpjsMemberYehaController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::put('/{id}', [BpjsMemberYehaController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Yeha');

    Route::delete('/{id}', [BpjsMemberYehaController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Yeha');
});
    //
//Route Lebih
Route::resource('family/lebih',FamilyHeadLebihController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');
Route::get('/dashboard/lebih',[DashboardController::class,'lebih'])->name('dashboard.lebih')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

Route::prefix('/citizen/lebih')->name('citizen.lebih.')->group(function () {

    Route::get('/{id}',[CitizenLebihController::class,'index'])->name('citizen.lebih')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::get('/create/{id}', [CitizenLebihController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::post('/', [CitizenLebihController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::get('/{id}/edit', [CitizenLebihController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::put('/{id}', [CitizenLebihController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::delete('/{id}', [CitizenLebihController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::get('/list/{id}', [CitizenLebihController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

});
//
//Route Bpjs Lebih
Route::prefix('bpjs/lebih')->name('bpjs.lebih.')->group(function () {

    Route::get('/', [BpjsMemberLebihController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::get('/create/{id}', [BpjsMemberLebihController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::post('/', [BpjsMemberLebihController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::get('/{id}/edit', [BpjsMemberLebihController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::put('/{id}', [BpjsMemberLebihController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Lebih');

    Route::delete('/{id}', [BpjsMemberLebihController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Lebih');
});

//Route buana
Route::resource('family/buana',FamilyHeadBuanaController::class)->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');
Route::get('/dashboard/buana',[DashboardController::class,'buana'])->name('dashboard.buana')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

Route::prefix('/citizen/buana')->name('citizen.buana.')->group(function () {

    Route::get('/{id}',[CitizenBuanaController::class,'index'])->name('citizen.buana')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::get('/create/{id}', [CitizenBuanaController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::post('/', [CitizenBuanaController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::get('/{id}/edit', [CitizenBuanaController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::put('/{id}', [CitizenBuanaController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::delete('/{id}', [CitizenBuanaController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::get('/list/{id}', [CitizenBuanaController::class, 'show'])->name('show')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

});
//
//Route Bpjs Buana
Route::prefix('bpjs/buana')->name('bpjs.buana.')->group(function () {

    Route::get('/', [BpjsMemberBuanaController::class, 'index'])->name('index')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::get('/create/{id}', [BpjsMemberBuanaController::class, 'create'])->name('create')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::post('/', [BpjsMemberBuanaController::class, 'store'])->name('store')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::get('/{id}/edit', [BpjsMemberBuanaController::class, 'edit'])->name('edit')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::put('/{id}', [BpjsMemberBuanaController::class, 'update'])->name('update')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Telung Buana');

    Route::delete('/{id}', [BpjsMemberBuanaController::class, 'destroy'])->name('destroy')->middleware('role:Admin Utama,Admin Desa,Admin Banjar Badeg Telung Buana');
});
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
