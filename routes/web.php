<?php

use App\Http\Controllers\ProfileController;
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

<<<<<<< HEAD
<<<<<<< Updated upstream
=======
=======
>>>>>>> 6f98568311a6207d878b5dbd78c0a4d184518580
Route::get('/client-dashboard', function () {
    return view('client.dashboard');
})->name('client.dashboard');

Route::get('/client-profile', function () {
    return view('client.profile');
})->name('client.profile');

<<<<<<< HEAD
=======

>>>>>>> 6f98568311a6207d878b5dbd78c0a4d184518580
Route::get('/client-loan-request', function () {
    return view('client.loan-request');
})->name('client.loan-request');

<<<<<<< HEAD




=======
>>>>>>> 6f98568311a6207d878b5dbd78c0a4d184518580
Route::get('/employe-dashboard', function () {
    return view('employe.dashboard');
})->name('employe.dashboard');


Route::get('/employe-profile', function () {
    return view('employe.profile');
})->name('employe.profile');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
<<<<<<< HEAD
>>>>>>> Stashed changes
=======
>>>>>>> 6f98568311a6207d878b5dbd78c0a4d184518580
