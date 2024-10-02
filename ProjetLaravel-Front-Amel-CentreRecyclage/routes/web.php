<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecyclingCenterController;

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MaintenanceController;
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


// categorie 
Route::get('/categories', [CategoryController::class, 'index'])->name('CentreRecyclage.categorie');
Route::get('/CentreRecyclage/{id}', [CategoryController::class, 'show'])->name('CentreRecyclage.show');
Route::get('/CentreRecyclage', [RecyclingCenterController::class, 'create'])->name('CentreRecyclage.create');
Route::post('/CentreRecyclage', [RecyclingCenterController::class, 'store'])->name('CentreRecyclage.store');


Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/{id}', [EquipmentController::class, 'show'])->name('equipment.show');



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