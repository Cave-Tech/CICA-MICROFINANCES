<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Employe\DetailCustomerComponent;
use App\Livewire\Client\DetailsLoanComponent;
use App\Livewire\Employe\DetailEmployeComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Route pour les clients
Route::get('/client-dashboard', function () {
    return view('client.dashboard');
})->name('client.dashboard');

Route::get('/client-profile', function () {
    return view('client.profile');
})->name('client.profile');

Route::get('/client-operations', function () {
    return view('client.operations');
})->name('client.operations');

Route::get('/client-loan-request', function () {
    return view('client.loan-request');
})->name('client.loan-request');

Route::get('client-details-loan/{loanId}', DetailsLoanComponent::class)->name('client.details-loan');






Route::get('/employe-dashboard', function () {
    return view('employe.dashboard');
})->name('employe.dashboard');


Route::get('/employe-profile', function () {
    return view('employe.profile');
})->name('employe.profile');

Route::get('/customer-list', function () {
    return view('employe.customer-list');
})->name('employe.customer-list');

Route::get('/employee-list', function () {
    return view('employe.employee-list');
})->name('employe.employee-list');

Route::get('/loan-request', function () {
    return view('employe.loan-request');
})->name('employe.loan-request');

Route::get('/paiement-list', function () {
    return view('employe.paiement-list');
})->name('employe.paiement-list');

Route::get('/operation-list', function () {
    return view('employe.operation-list');
})->name('employe.operartion-list');

Route::get('/current-accounts', function () {
    return view('employe.current-accounts');
})->name('employe.current-accounts');

Route::get('/savings-accounts', function () {
    return view('employe.savings-accounts');
})->name('employe.savings-accounts');

Route::get('/create-current-account', function () {
    return view('employe.create-current-account');
})->name('employe.create-current-account');

Route::get('/create-savings-account', function () {
    return view('employe.create-savings-account');
})->name('employe.create-savings-account');


Route::get('/save-operation', function () {
    return view('employe.save-operation');
})->name('employe.save-operation');

Route::get('/details', function () {
    return view('employe.details');
})->name('employe.details');

Route::get('/details_pret', function () {
    return view('employe.details-pret');
})->name('employe.details-pret');

Route::get('/loan-in-progress', function () {
    return view('employe.loan-in-progress');
})->name('employe.loan-in-progress');


Route::get('/customer/{customerId}', DetailCustomerComponent::class)->name('customer.detail');
Route::get('/employe/{employeId}', DetailEmployeComponent::class)->name('employe.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
