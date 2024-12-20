<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WasteController;
use App\Http\Controllers\DisposalRecordController;


use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecyclingCenterController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipationController;


use App\Http\Controllers\EquipmentController;





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

// post and comment part
Route::middleware(['auth'])->group(function () {
    Route::get('/posts_list', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [PostController::class, 'unlike'])->name('posts.unlike');
    Route::get('/posts/{post}/likes', [PostController::class, 'getLikes'])->name('posts.likes');

});



require __DIR__.'/auth.php';

// categorie
Route::middleware(['auth'])->group(function () {
Route::get('/categories', [CategoryController::class, 'index'])->name('CentreRecyclage.categorie');
Route::get('/CentreRecyclage/{id}', [CategoryController::class, 'show'])->name('CentreRecyclage.show');
Route::get('/CentreRecyclage', [RecyclingCenterController::class, 'create'])->name('CentreRecyclage.create');
Route::post('/CentreRecyclage', [RecyclingCenterController::class, 'store'])->name('CentreRecyclage.store');
});

//events
// Routes pour les événements et participations protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class);
    Route::resource('events.participations', ParticipationController::class)->shallow();
    Route::get('events/{event}/participants/create', [ParticipationController::class, 'create'])->name('participants.create');
Route::post('participants', [ParticipationController::class, 'store'])->name('participants.store');
});


Route::middleware(['auth'])->group(function () {
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/{id}', [EquipmentController::class, 'show'])->name('equipment.show');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profil.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

});

