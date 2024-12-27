<?php
use Modules\LoanManagement\Controllers\LoanController;

Route::middleware(['web'])->group(function () {
Route::resource('/loans', LoanController::class);
Route::post('/loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');
Route::post('/loans/{loan}/reject', [LoanController::class, 'reject'])->name('loans.reject');
Route::post('/loans/{loan}/repaid', [LoanController::class, 'markAsRepaid'])->name('loans.repaid');
});


