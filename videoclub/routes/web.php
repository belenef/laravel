<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('home');
});

// si está dentro de una carpeta se debe poner el nombre de la carpeta y despues el archivo
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/catalog', function () {
    return view('catalog.index');
});

Route::get('/catalog/show/{id}', function ($id) {
    return view('catalog.show', ['id' => $id]);
});

Route::get('/catalog/create', function () {
    return view('catalog.create');
});

Route::get('/catalog/edit/{id}', function ($id) {
    return view('catalog.edit', ['id' => $id]);
});