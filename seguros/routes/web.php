<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamenController;
use App\Models\Examen;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExamenController::class, 'getCreate'])->name('home');
Route::get('/catalog/create', [ExamenController::class, 'getCreate'])->name('catalog.create');
Route::post('/catalog/create', [ExamenController::class,'postCreate'])->name('catalog.store');
Route::get('/catalog/edit/{id}', [ExamenController::class,'edit'])->name('catalog.edit');
Route::put('/catalog/edit/{id}', [ExamenController::class,'update'])->name('catalog.update');
Route::delete('/catalog/{id}', [ExamenController::class,'destroy'])->name('catalog.destroy');
Route::get('/catalog/editar', [ExamenController::class,'editarVehiculo'])->name('catalog.editar');
Route::get('/principal', [ExamenController::class,'principal'])->name('catalog.principal');
Route::get('/poliza', [ExamenController::class,'poliza'])->name('poliza.index');
Route::get('/poliza/create', [ExamenController::class, 'getCreatePoliza'])->name('poliza.create');
Route::post('/poliza/create', [ExamenController::class, 'storePoliza'])->name('poliza.store');
Route::get('/poliza/edit/{id}', [ExamenController::class,'editpoliza'])->name('poliza.edit');
Route::put('/poliza/edit/{id}', [ExamenController::class,'updatePoliza'])->name('poliza.update');
Route::delete('/poliza/{id}', [ExamenController::class,'destroyPoliza'])->name('poliza.destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
