<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'ban'])->group(function(){

    Route::get('/dashboard', [\App\Http\Controllers\MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/colocations/create', function () {
        return view('colocations.create');
    })->name('colocations.create');

    Route::post('/colocations/store' , [ColocationController::class , 'store' ])->name('colocations.store');
    Route::post('/colocations/invite' , [ColocationController::class , 'invite' ])->name('colocations.invite');
    
    Route::get('/invitations/{token}', [ColocationController::class, 'showInvitation'])->name('invitations.show');
    Route::post('/invitations/{token}/accept', [ColocationController::class, 'acceptInvitation'])->name('invitations.accept');
    Route::post('/invitations/{token}/decline', [ColocationController::class, 'declineInvitation'])->name('invitations.decline');

    Route::get('/owner/dashboard', [\App\Http\Controllers\OwnerDashboardController::class, 'index'])->name('owner.dashboard');

    Route::post('/expense/store', [\App\Http\Controllers\ExpenseController::class, 'store'])->name('expense.store');

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/ban', [\App\Http\Controllers\AdminController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [\App\Http\Controllers\AdminController::class, 'unban'])->name('users.unban');
    
    Route::get('/colocations', [\App\Http\Controllers\AdminController::class, 'colocations'])->name('colocations');
    Route::get('/colocations/{id}', [\App\Http\Controllers\AdminController::class, 'showColocation'])->name('colocations.show');
});

require __DIR__.'/auth.php';
