<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\DisposalRecordController;


use App\Http\Controllers\Auth\LoginController;


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



Route::get('/', function () {
    return view('welcome');
})->name('home');  




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/wastes', [WasteController::class, 'index'])->name('wastes.index');
    Route::get('/wastes/create', [WasteController::class, 'create'])->name('wastes.create');
    Route::post('/wastes', [WasteController::class, 'store'])->name('wastes.store');
    Route::get('/wastes/{waste}/edit', [WasteController::class, 'edit'])->name('wastes.edit');
    Route::put('/wastes/{waste}', [WasteController::class, 'update'])->name('wastes.update');
    Route::delete('/wastes/{waste}', [WasteController::class, 'destroy'])->name('wastes.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/disposalRecords', [DisposalRecordController::class, 'index'])->name('disposalRecords.index');
    Route::get('/disposalRecords/create', [DisposalRecordController::class, 'create'])->name('disposalRecords.create');
    Route::post('/disposalRecords', [DisposalRecordController::class, 'store'])->name('disposalRecords.store');
    Route::get('/disposalRecords/{disposalRecord}/edit', [DisposalRecordController::class, 'edit'])->name('disposalRecords.edit');
    Route::put('/disposalRecords/{disposalRecord}', [DisposalRecordController::class, 'update'])->name('disposalRecords.update');
    Route::delete('/disposalRecords/{disposalRecord}', [DisposalRecordController::class, 'destroy'])->name('disposalRecords.destroy');
});


require __DIR__.'/auth.php';
