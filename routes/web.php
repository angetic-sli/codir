<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CrClienteleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LivrableController;
use App\Http\Controllers\ObligationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportCodirController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware(['auth', 'access'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('reunions', ReunionController::class)->except(['create', 'edit', 'show', 'index']);
    Route::get('/reunions', [ReunionController::class, 'index'])->name('reunions.index');
    Route::get('/reunions/create', [ReunionController::class, 'create'])->name('reunions.create');
    Route::get('/reunions/export/excel', [ReunionController::class, 'exportExcel'])->name('reunions.export.excel');
    Route::get('/reunions/export/pdf', [ReunionController::class, 'exportPdf'])->name('reunions.export.pdf');
    Route::get('/reunions/{reunion}', [ReunionController::class, 'show'])->name('reunions.show');
    Route::get('/reunions/{reunion}/edit', [ReunionController::class, 'edit'])->name('reunions.edit');
    Route::get('/reunions/{reunion}/export/excel', [ReunionController::class, 'exportReunionExcel'])->name('reunions.export.detail.excel');
    Route::get('/reunions/{reunion}/export/pdf', [ReunionController::class, 'exportReunionPdf'])->name('reunions.export.detail.pdf');
    Route::post('/reunions/{reunion}/taches/reorder', [ReunionController::class, 'reorderTaches'])->name('reunions.taches.reorder');
    Route::post('/reunions/{reunion}/duplicate', [ReunionController::class, 'duplicate'])->name('reunions.duplicate');
    Route::delete('/reunions/{reunion}/taches/{tache}', [ReunionController::class, 'destroyTache'])->name('reunions.taches.destroy');

    Route::resource('activites', ActiviteController::class);
    Route::resource('taches', TacheController::class)->parameters(['taches' => 'tache']);
    Route::resource('livrables', LivrableController::class);
    Route::resource('clients', ClientController::class);
    Route::get('cr-clienteles/export/excel', [CrClienteleController::class, 'exportExcel'])->name('cr-clienteles.export.excel');
    Route::get('cr-clienteles/export/pdf', [CrClienteleController::class, 'exportPdf'])->name('cr-clienteles.export.pdf');
    Route::resource('cr-clienteles', CrClienteleController::class);
    Route::resource('obligations', ObligationController::class);

    Route::prefix('rapports')->name('rapports.')->group(function () {
        Route::get('/codir', [RapportCodirController::class, 'index'])->name('codir.index');
        Route::get('/codir/export/excel', [RapportCodirController::class, 'exportExcel'])->name('codir.export.excel');
        Route::get('/codir/export/pdf', [RapportCodirController::class, 'exportPdf'])->name('codir.export.pdf');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('admin/roles', RoleController::class)->names('roles');
        Route::resource('admin/permissions', PermissionController::class)->names('permissions');
    });
});

require __DIR__.'/auth.php';
