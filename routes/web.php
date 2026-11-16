<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuideVideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Siswa\CatalogController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\LoanController as SiswaLoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/photo/{user}', [ProfileController::class, 'showPhoto'])->name('profile.photo.show');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/panduan/video', [GuideVideoController::class, 'show'])->name('guide.video');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', BookController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroyCategory'])->name('categories.destroy');
    Route::post('/shelves', [CategoryController::class, 'storeShelf'])->name('shelves.store');
    Route::put('/shelves/{shelf}', [CategoryController::class, 'updateShelf'])->name('shelves.update');
    Route::delete('/shelves/{shelf}', [CategoryController::class, 'destroyShelf'])->name('shelves.destroy');

    Route::get('/loans', [AdminLoanController::class, 'index'])->name('loans.index');
    Route::patch('/loans/{loan}/approve', [AdminLoanController::class, 'approve'])->name('loans.approve');
    Route::patch('/loans/{loan}/reject', [AdminLoanController::class, 'reject'])->name('loans.reject');
    Route::patch('/loans/{loan}/reprocess', [AdminLoanController::class, 'reprocess'])->name('loans.reprocess');
    Route::patch('/loans/{loan}/hand-over', [AdminLoanController::class, 'handOver'])->name('loans.hand-over');
    Route::patch('/loans/{loan}/extend', [AdminLoanController::class, 'extend'])->name('loans.extend');
    Route::patch('/loans/{loan}/return', [AdminLoanController::class, 'returnBook'])->name('loans.return');

    Route::get('/fines', [FineController::class, 'index'])->name('fines.index');
    Route::patch('/fines/{fine}/paid', [FineController::class, 'markPaid'])->name('fines.paid');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
    Route::get('/reports/export', [ReportController::class, 'exportExcel'])->name('reports.export');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');
    Route::get('/loans', [SiswaLoanController::class, 'index'])->name('loans.index');
    Route::post('/loans/{book}', [SiswaLoanController::class, 'store'])->name('loans.store');
    Route::patch('/loans/{loan}/extend', [SiswaLoanController::class, 'extend'])->name('loans.extend');
});