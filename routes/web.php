<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $no_of_farmers = \App\Models\Farmer::all()->count();
    $total_borrowed = \App\Models\Loan::query()->where("status", "approved")->sum("amount");
    $approved_loans = \App\Models\Loan::query()->where("status", "approved")->count();
    $pending_loans = \App\Models\Loan::query()->where("status", "pending")->count();
    $rejected_loans = \App\Models\Loan::query()->where("status", "rejected")->count();

    return view('dashboard', ["no_of_farmers" => $no_of_farmers, "total_borrowed" => $total_borrowed,"approved_loans"=> $approved_loans, "pending_loans"=>$pending_loans, "rejected_loans"=>$rejected_loans, ]);

})->middleware(['auth', 'verified'])->name('dashboard');


// Farmers
Route::resource('/farmers', FarmerController::class);

Route::resource('/loans', LoanController::class);
Route::post('/loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');
Route::post('/loans/{loan}/reject', [LoanController::class, 'reject'])->name('loans.reject');
Route::post('/loans/{loan}/repaid', [LoanController::class, 'markAsRepaid'])->name('loans.repaid');

// Modules


// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
