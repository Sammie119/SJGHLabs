<?php

use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\CustomTypeController;
use App\Http\Controllers\EnterTestController;
use App\Http\Controllers\GetdataController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodTransfussionsController;

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

    //Report Routes
    Route::get('report', [ReportController::class, 'index'])->name('report');
    Route::post('print-report', [ReportController::class, 'getReport'])->name('print-report');

    // Blood Bank Routes
    Route::get('donors-list', [BloodBankController::class, 'index'])->name('donors-list');
    Route::get('create-donor', [BloodBankController::class, 'createDonor'])->name('create-donor');
    Route::post('register-donor', [BloodBankController::class, 'registerDonor'])->name('register-donor');
    Route::get('edit-donor/{id}', [BloodBankController::class, 'edit']);
    Route::get('edit-blood-labs/{id}', [BloodBankController::class, 'editBloodLabs']);
    Route::post('update-donor', [BloodBankController::class, 'update'])->name('update-donor');
    Route::post('update-blood-labs', [BloodBankController::class, 'updatedBloodLabs'])->name('update-blood-labs');
    Route::get('delete-donor/{id}', [BloodBankController::class, 'deleteDonor']);
    Route::post('donor-labs', [BloodBankController::class, 'donorLabs'])->name('donor-labs');
    Route::get('results-blood-labs', [BloodBankController::class, 'bloodBankLabs'])->name('results-blood-labs');
    Route::get('delete-labs/{id}', [BloodBankController::class, 'deleteLabs']);

    Route::get('stock-blood', [BloodBankController::class, 'stockBlood'])->name('stock-blood');
    Route::post('stock-blood-bank', [BloodBankController::class, 'stockBloodBank'])->name('stock-blood-bank');
    Route::get('blood-in-stock', [BloodBankController::class, 'bloodInStock'])->name('blood-in-stock');
    Route::get('edit-blood-in-stock/{id}', [BloodBankController::class, 'editBloodInStock']);
    Route::post('update-blood-in-stock', [BloodBankController::class, 'updateBloodInStock'])->name('update-blood-in-stock');
    Route::get('delete-blood/{id}', [BloodBankController::class, 'deleteBlood']);

    // Blood Transfussions Routes
    Route::get('checkout-blood/{id}', [BloodTransfussionsController::class, 'checkoutBlood']);
    Route::get('blood-transfussions', [BloodTransfussionsController::class, 'index'])->name('blood-transfussions');
    Route::post('store-transfussion', [BloodTransfussionsController::class, 'storeTransfussion'])->name('store-transfussion');
    Route::get('edit-checkout-blood/{id}', [BloodTransfussionsController::class, 'editCheckout']);
    Route::post('update-checkout-blood', [BloodTransfussionsController::class, 'updateCheckout'])->name('update-checkout-blood');
    Route::get('delete-checkout-blood/{id}', [BloodTransfussionsController::class, 'deleteCheckout']);

});

//Get Data Routes
Route::post('/getname', [GetdataController::class, 'getPatientName']);
Route::post('/getisolate', [GetdataController::class, 'getIsolate']);
Route::get('/antibiotic', [GetdataController::class, 'getAntibiotics']);
Route::post('/getlab-number-check', [GetdataController::class, 'getLabNumberCheck']);
Route::post('/get-patient-info', [GetdataController::class, 'getPatientInfo']);
Route::post('/getblood-number-check', [GetdataController::class, 'getBloodNumberCheck']);
Route::post('/get-donor', [GetdataController::class, 'getDonorName']);
Route::post('/getblood-number', [GetdataController::class, 'getBloodNumberCheck2']);