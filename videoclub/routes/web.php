<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

// DEVUELVEN STRINGS
// Route::get('/', function () {
//     return 'Main page';
// });

// Route::get('/login', function () {
//     return 'User login';
// });

// Route::get('/logout', function () {
//     return 'User logout';
// });

// Route::get('/catalog', function () {
//     return 'Movie list';
// });

// Route::get('/catalog/show/{id}', function ($id) {
//     return "Detail view of the movie $id";
// });

// Route::get('/catalog/create', function () {
//     return "Add movie";
// });

// Route::get('/catalog/edit/{id}', function ($id) {
//     return "Edit movie $id";
// });


// DEVUELVEN VISTAS
// Route::get('/', function () {
//     return view('home');
// });

// si está dentro de una carpeta se debe poner el nombre de la carpeta y despues el archivo
// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/catalog', function () {
//     return view('catalog.index');
// });

// Route::get('/catalog/show/{id}', function ($id) {
//     return view('catalog.show', ['id' => $id]);
// });

// Route::get('/catalog/create', function () {
//     return view('catalog.create');
// });

// Route::get('/catalog/edit/{id}', function ($id) {
//     return view('catalog.edit', ['id' => $id]);
// });

// DEVUELVEN VISTAS A TRAVÉS DE UN CONTROLADOR
Route::middleware(['auth'])->group(function () {

    // Vistas
    Route::get('/catalog', [CatalogController::class, 'getIndex'])->name('catalog.index');
    Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow'])->name('catalog.show');
    Route::get('/catalog/create', [CatalogController::class, 'getCreate'])->name('catalog.create');
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit'])->name('catalog.edit');

    // Formularios
    Route::post('/catalog/create', [CatalogController::class, 'postCreate'])->name('catalog.store');
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit'])->name('catalog.update');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

