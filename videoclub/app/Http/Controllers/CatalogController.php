<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{
    // private $arrayPeliculas;

    // public function __construct()
    // {
    //     // Cargar el array desde el archivo
    //     $this->arrayPeliculas = require 'array_peliculas.php';
    // }
    public function getIndex()
    {
        $movies = Movie::all(); // Obtener todas las películas desde la base de datos

        return view('catalog.index', [
            'arrayPeliculas' => $movies
        ]);
    }
    
    public function getShow($id)
    {
        $pelicula = Movie::findOrFail($id); // Buscar la película por su ID o lanzar un error 404 si no se encuentra

        return view('catalog.show', [
            'pelicula' => $pelicula,
            'id' => $id
        ]);
    }

    public function getEdit($id)
    {
        $pelicula = Movie :: findOrFail($id); // Buscar la película por su ID o lanzar un error 404 si no se encuentra
        // Pasar la película a la vista de edición
        return view('catalog.edit', [
            'pelicula' => $pelicula,
            'id' => $id
        ]);
    }


    public function getCreate()
    {
        return view('catalog.create');
    }

}
