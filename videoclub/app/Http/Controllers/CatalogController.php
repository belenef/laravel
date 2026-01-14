<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private $arrayPeliculas;

    public function __construct()
    {
        // Cargar el array desde el archivo
        $this->arrayPeliculas = require 'array_peliculas.php';
    }
    public function getIndex()
    {
        return view('catalog.index', [
            'arrayPeliculas' => $this->arrayPeliculas
        ]);
    }
    
    public function getShow($id)
    {
        // Verificar que exista la película
        if (!isset($this->arrayPeliculas[$id])) {
            abort(404, 'Película no encontrada');
        }

        // Pasar la película a la vista
        return view('catalog.show', [
            'pelicula' => $this->arrayPeliculas[$id],
            'id' => $id
        ]);
    }

    public function getEdit($id)
    {
        // Verificar que exista la película
        if (!isset($this->arrayPeliculas[$id])) {
            abort(404, 'Película no encontrada');
        }

        // Pasar la película a la vista de edición
        return view('catalog.edit', [
            'pelicula' => $this->arrayPeliculas[$id],
            'id' => $id
        ]);
    }


    public function getCreate()
    {
        return view('catalog.create');
    }

}
