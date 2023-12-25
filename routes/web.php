<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ManPowerSupplyController;
use App\Http\Controllers\SystemSettingController;

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


Auth::routes();

Route::get('english-to-arabic-convert', [HomeController::class, 'english_to_arabic'])->name('english_to_arabic');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // ============== currency ================
    Route::resource('currency', CurrencyController::class)->names('currency');
    Route::get('currency-delete/{id}', [CurrencyController::class, 'delete'])->name('currency.delete');
    Route::get('currency-change-status/{id}', [CurrencyController::class, 'change_status'])->name('currency.change_status');
    Route::get('currency-multi-delete', [CurrencyController::class, 'multi_delete'])->name('currency.multi_delete');


    // ============== Designation ================
    Route::resource('designation', DesignationController::class)->names('designation');
    Route::get('designation-delete/{id}', [DesignationController::class, 'delete'])->name('designation.delete');
    Route::get('designation-change-status/{id}', [DesignationController::class, 'change_status'])->name('designation.change_status');
    Route::get('designation-multi-delete', [DesignationController::class, 'multi_delete'])->name('designation.multi_delete');

    // ============== Person ================
    Route::resource('person', PersonController::class)->names('person');
    Route::get('person-delete/{id}', [PersonController::class, 'delete'])->name('person.delete');
    Route::get('person-change-status/{id}', [PersonController::class, 'change_status'])->name('person.change_status');
    Route::get('person-multi-delete', [PersonController::class, 'multi_delete'])->name('person.multi_delete');


    // ============== Customer ================
    Route::resource('customer', CustomerController::class)->names('customer');
    Route::get('customer-delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::get('customer-change-status/{id}', [CustomerController::class, 'change_status'])->name('customer.change_status');
    Route::get('customer-multi-delete', [CustomerController::class, 'multi_delete'])->name('customer.multi_delete');


    // ============== Man Power Supply ================
    Route::resource('man-power-supply', ManPowerSupplyController::class)->names('man-power-supply');
    Route::get('man-power-supply-import', [ManPowerSupplyController::class, 'import'])->name('man-power-supply.import');
    Route::post('man-power-supply-import-store', [ManPowerSupplyController::class, 'import_store'])->name('man-power-supply.import_store');
    Route::get('man-power-supply-delete/{id}', [ManPowerSupplyController::class, 'delete'])->name('man-power-supply.delete');
    Route::get('man-power-supply-change-status/{id}', [ManPowerSupplyController::class, 'change_status'])->name('man-power-supply.change_status');
    Route::get('man-power-supply-multi-delete', [ManPowerSupplyController::class, 'multi_delete'])->name('man-power-supply.multi_delete');


    // ============== Invoice ================
    Route::resource('invoice', InvoiceController::class)->names('invoice');
    Route::get('invoice-export/{customer_id}/{month}/{invoice_id}', [InvoiceController::class, 'export'])->name('invoice.export');
    Route::get('invoice-pdf/{invoice_id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
    Route::get('invoice-draft', [InvoiceController::class, 'draft'])->name('invoice.draft');
    Route::get('invoice-generate', [InvoiceController::class, 'generate'])->name('invoice.generate');
    Route::get('invoice-delete/{id}', [InvoiceController::class, 'delete'])->name('invoice.delete');
    Route::get('invoice-change-status/{id}', [InvoiceController::class, 'change_status'])->name('invoice.change_status');
    Route::get('invoice-multi-delete', [InvoiceController::class, 'multi_delete'])->name('invoice.multi_delete');

    // ============= system setting =============
    Route::prefix('systemsetting')->as('systemsetting.')->group(function () {
        Route::get('/', [SystemSettingController::class, 'index'])->name('index');
        Route::put('/{id}', [SystemSettingController::class, 'update'])->name('update');
    });

    // ============= user profile ================
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
    Route::post('/profile-update', [HomeController::class, 'profile_update'])->name('profile_update');
    Route::post('/password-update', [HomeController::class, 'password_update'])->name('password_update');
});
