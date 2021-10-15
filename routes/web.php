<?php

use App\Http\Controllers\CustomTypeController;
use App\Http\Controllers\EnterTestController;
use App\Http\Controllers\GetdataController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index']);
Route::post('login', [UserController::class, 'login']);
    

Route::middleware(['protectedPages'])->group(function () {
    
    //Users Routes
    Route::get('dashboard', [UserController::class, 'home'])->name('dashboard');
    Route::get('add-user', [UserController::class, 'addNewUser'])->name('add-user');
    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::get('user-list', [UserController::class, 'userList'])->name('user-list');
    Route::get('edit-user/{id}', [UserController::class, 'editUser']);
    Route::post('update-user',[UserController::class, 'updateUser'])->name('update-user');
    Route::get('delete-user/{id}', [UserController::class, 'delete']);
    Route::get('user-profile', [UserController::class, 'userProfile'])->name('user-profile');
    Route::post('edit-profile', [UserController::class, 'profileEdit'])->name('edit-profile');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    //Enter Test Routes
    Route::get('results', [EnterTestController::class, 'index'])->name('results');
    Route::get('enter-test', [EnterTestController::class, 'create'])->name('enter-test');
    Route::post('store-labs', [EnterTestController::class, 'store'])->name('store-labs');
    Route::get('print-results/{id}', [EnterTestController::class, 'getResults']);
    Route::get('edit-test/{id}', [EnterTestController::class, 'edit']);
    Route::post('update-labs', [EnterTestController::class, 'update'])->name('update-labs');
    Route::get('delete-labs/{id}', [EnterTestController::class, 'destroy']);
    Route::get('doc-get-labs', [EnterTestController::class, 'docGetLabResults'])->name('doc-get-labs');
    Route::post('doc-view-labs', [EnterTestController::class, 'docViewResults'])->name('doc-view-labs');

    //Custom Type Routes
    Route::get('custom-types', [CustomTypeController::class, 'index'])->name('custom-types');
    Route::get('category', [CustomTypeController::class, 'createCategory'])->name('category');
    Route::post('add-category', [CustomTypeController::class, 'storeCategory'])->name('add-category');
    Route::get('dropdown', [CustomTypeController::class, 'createDropdown'])->name('dropdown');
    Route::post('add-dropdown', [CustomTypeController::class, 'storeDropdown'])->name('add-dropdown');
    Route::get('edit-dropdown/{id}', [CustomTypeController::class, 'editDropdown']);
    Route::post('update-dropdown', [CustomTypeController::class, 'updateDropdown'])->name('update-dropdown');
    Route::get('delete-dropdown/{id}', [CustomTypeController::class, 'destroyDropdown']);

    //Patients Routes
    Route::get('patients-list', [PatientsController::class, 'index'])->name('patients-list');
    Route::get('add-patient', [PatientsController::class, 'create'])->name('add-patient');
    Route::post('new-patient', [PatientsController::class, 'store'])->name('new-patient');
    Route::get('edit-patient/{id}', [PatientsController::class, 'edit']);
    Route::post('update-patient', [PatientsController::class, 'update'])->name('update-patient');
    Route::get('delete-patient/{id}', [PatientsController::class, 'destroy']);
});

//Get Data Routes
Route::post('/getname', [GetdataController::class, 'getPatientName']);
Route::post('/getisolate', [GetdataController::class, 'getIsolate']);
Route::get('/antibiotic', [GetdataController::class, 'getAntibiotics']);
Route::post('/getlab-number-check', [GetdataController::class, 'getLabNumberCheck']);
Route::post('/get-patient-info', [GetdataController::class, 'getPatientInfo']);
