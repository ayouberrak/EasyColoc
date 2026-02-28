<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColocationMemberController;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth', 'ban'])->group(function(){

    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
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

    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
    Route::post('/owner/colocation/cancel', [OwnerDashboardController::class, 'anullerColocation'])->name('owner.colocation.cancel');
    Route::get('/owner/colocation/export-pdf', [ExportController::class, 'exportColocationPdf'])->name('owner.colocation.export-pdf');

    Route::get('/my-colocations', [ColocationController::class, 'myColocations'])->name('my-colocations');

    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');

    Route::post('/payment/store',[PaymentController::class,'store'])->name('payment.store');

    Route::post('/leave/colo' , [MemberDashboardController::class , 'leaveSeul'])->name('leave.colo');
    Route::post('/colocations/owner/{member}', [ColocationController::class, 'transferOwnership'])->name('colocations.transfer-ownership');

    Route::post('/colocations/remove/{member}', [MemberDashboardController::class, 'leaveByOwner'])->name('colocations.owner.remove');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/chat/{colocationId}', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
    Route::post('/chat', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::post('/users/{user}/ban', [AdminController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [AdminController::class, 'unban'])->name('users.unban');
    
    Route::get('/colocations', [AdminController::class, 'colocations'])->name('colocations');
    Route::get('/colocations/{id}', [AdminController::class, 'showColocation'])->name('colocations.show');
});

require __DIR__.'/auth.php';
