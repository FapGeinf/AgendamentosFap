<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('salas')->name('salas.')->group(function () {
    Route::get('/', [SalaController::class, 'index'])->name('index');
    Route::get('/create', [SalaController::class, 'createSala'])->name('create');
    Route::post('/insert', [SalaController::class, 'insertSala'])->name('insert');
    Route::get('/edit',[SalaController::class,'editSala'])->name('edit');
    Route::put('/update',[SalaController::class,'updateSala'])->name('update');
    Route::delete('/delete',[SalaController::class,'deleteSala'])->name('delete');
});

Route::prefix('unidades')->name('unidades.')->group(function () {
    Route::get('/', [UnidadeController::class, 'index'])->name('index');
    Route::get('/create', [UnidadeController::class, 'createUnidade'])->name('create');
    Route::post('/insert', [UnidadeController::class, 'insertUnidade'])->name('insert');
    Route::get('/edit/{id}', [UnidadeController::class, 'editUnidade'])->name('edit');
    Route::put('/update/{id}', [UnidadeController::class, 'updateUnidade'])->name('update');
    Route::delete('/delete/{id}', [UnidadeController::class, 'deleteUnidade'])->name('delete');
});



require __DIR__.'/auth.php';
