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

   public function postCreate(Request $request)
    {
        // 1. Crear una nueva instancia de Movie
        $movie = new Movie();

        // 2. Asignar valores desde el formulario
        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->year = $request->input('year');

        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');

        // 3. Guardar en la base de datos
        $movie->save();

        // 4. Redirigir al catálogo
        return redirect('/catalog');
    }

    public function putEdit(Request $request, $id)
    {
        // 1. Recuperar la película por ID
        $movie = Movie::findOrFail($id);

        // 2. Actualizar valores
        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->year = $request->input('year');

        // 3. Guardar cambios
        $movie->save();

        // 4. Redirigir a la vista detalle de la película
        return redirect('/catalog/show/' . $movie->id);
    }

}
