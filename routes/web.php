<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Employe\DetailCustomerComponent;
use App\Livewire\Client\DetailsLoanComponent;
use App\Livewire\Employe\DetailEmployeComponent;
use Illuminate\Support\Facades\Auth;
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


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        $user = Auth::user();
        
    
        if ($user) {
            if($user->profile_id == 3){
                return redirect('client-dashboard');
            }else if($user->profile_id == 4){
                return redirect('employe-dashboard');
            }else if($user->profile_id == 1){
                return redirect('admin.dashboard');
            }else{
                return redirect('superadmin.dashboard');
            }
        } else {
            // Redirige l'utilisateur vers la page de connexion
            return redirect('login');
        }
    });
    
    //Route pour les clients
    Route::get('/client-dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard')->middleware('client');
    
    Route::get('/client-profile', function () {
        return view('client.profile');
    })->name('client.profile')->middleware('client');
    
    Route::get('/client-operations', function () {
        return view('client.operations');
    })->name('client.operations')->middleware('client');
    
    Route::get('/client-loan-request', function () {
        return view('client.loan-request');
    })->name('client.loan-request')->middleware('client');
    
    Route::get('client-details-loan/{loanId}', DetailsLoanComponent::class)->name('client.details-loan')->middleware('loan.details');
    
    
    
    
    
    
    Route::get('/employe-dashboard', function () {
        return view('employe.dashboard');
    })->name('employe.dashboard')->middleware(['employe']);
    
    
    Route::get('/employe-profile', function () {
        return view('employe.profile');
    })->name('employe.profile')->middleware(['employe']);
    
    Route::get('/payement-loan', function () {
        return view('employe.payement-loan');
    })->name('payement-loan')->middleware(['employe']);

    Route::get('/list-payement', function () {
        return view('employe.list-payement-component');
    })->name('list-payement')->middleware(['employe']);

    Route::get('/late-payment', function () {
        return view('employe.late-payment');
    })->name('late-payement')->middleware(['employe']);


    Route::get('/pret-groupe', function () {
        return view('employe.loan-bulk');
    })->name('employe.pret-groupe')->middleware(['agent_terrain']);
    
    Route::get('/customer-list', function () {
        return view('employe.customer-list');
    })->name('employe.customer-list')->middleware(['directeur']);
    
    Route::get('/employee-list', function () {
        return view('employe.employee-list');
    })->name('employe.employee-list')->middleware(['directeur']);
    
    Route::get('/loan-request', function () {
        return view('employe.loan-request');
    })->name('employe.loan-request')->middleware(['loan']);
    
    Route::get('/paiement-list', function () {
        return view('employe.paiement-list');
    })->name('employe.paiement-list')->middleware(['loan']);
    
    Route::get('/operation-list', function () {
        return view('employe.operation-list');
    })->name('employe.operartion-list')->middleware(['agent_caisse']);
    
    Route::get('/current-accounts', function () {
        return view('employe.current-accounts');
    })->name('employe.current-accounts')->middleware(['charge_clientele']);
    
    Route::get('/savings-accounts', function () {
        return view('employe.savings-accounts');
    })->name('employe.savings-accounts')->middleware(['charge_clientele']);
    
    Route::get('/create-current-account', function () {
        return view('employe.create-current-account');
    })->name('employe.create-current-account')->middleware(['charge_clientele']);
    
    Route::get('/loan-request', function () {
        return view('employe.loan-request');
    })->name('employe.loan-request')->middleware(['agent_terrain']);
    
    
    Route::get('/create-loan-request', function () {
        return view('employe.create-loan-request');
    })->name('employe.create-loan-request')->middleware(['agent_terrain']);
    
    
    Route::get('/create-savings-account', function () {
        return view('employe.create-savings-account');
    })->name('employe.create-savings-account')->middleware(['charge_clientele']);
    
    
    Route::get('/save-operation', function () {
        return view('employe.save-operation');
    })->name('employe.save-operation')->middleware(['agent_caisse']);
    
    Route::get('/details', function () {
        return view('employe.details');
    })->name('employe.details')->middleware(['directeur']);
    
    Route::get('/inscription-employer', function () {
        return view('inscription.inscription');
    })->name('inscription')->middleware(['employe']);
    
    Route::get('/create-client', function () {
        return view('inscription.create-client');
    })->name('/create-client')->middleware(['employe']);
    
    Route::get('/profile', function () {
        return view('editprofile.profile');
    })->name('profile');
    
    Route::get('/details_pret', function () {
        return view('employe.details-pret');
    })->name('employe.details-pret')->middleware(['client']);
    
    Route::get('/loan-in-progress', function () {
        return view('employe.loan-in-progress');
    })->name('employe.loan-in-progress')->middleware(['directeur']);

    Route::get('/validated-loan', function () {
        return view('employe.validated-loan');
    })->name('employe.validated-loan')->middleware(['agent_caisse']);

    Route::get('/mes-clients', function () {
        return view('employe.liste-create-client');
    })->name('employe.mes-clients')->middleware(['employe']);
    
    
    Route::get('/customer/{customerId}', DetailCustomerComponent::class)->name('customer.detail')->middleware(['employe']);
    Route::get('/employe/{employeId}', DetailEmployeComponent::class)->name('employe.detail')->middleware(['directeur']);
    

});


require __DIR__.'/auth.php';
