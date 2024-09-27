<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecyclingCenterController;

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
});


// categorie 
Route::get('/categories', [CategoryController::class, 'index'])->name('CentreRecyclage.categorie');
Route::get('/CentreRecyclage/{id}', [CategoryController::class, 'show'])->name('CentreRecyclage.show');
Route::get('/CentreRecyclage', [RecyclingCenterController::class, 'create'])->name('CentreRecyclage.create');
Route::post('/CentreRecyclage', [RecyclingCenterController::class, 'store'])->name('CentreRecyclage.store');
