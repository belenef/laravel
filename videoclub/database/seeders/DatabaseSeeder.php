<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    private $arrayPeliculas; // array para inicializar la tabla movies

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->seedCatalog(); // inicializa la tabla movies
        $this->command->info('Tabla catalogo inicializada con datos!');
    }

    // funcion para inicializar la tabla movies
    private function seedCatalog(): void
    {
        // cargo el array de peliculas
        $this->arrayPeliculas = require app_path('Http/Controllers/array_peliculas.php');
        
        Movie::truncate(); // vacio la tabla movies

        // recorro el array e inserto los datos en la tabla movies
        foreach($this->arrayPeliculas as $pelicula) {
            $p = new Movie();
            $p->title = $pelicula['title'];
            $p->year = $pelicula['year'];
            $p->director = $pelicula['director'];
            $p->poster = $pelicula['poster'];
            $p->rented = $pelicula['rented'];
            $p->synopsis = $pelicula['synopsis'];
            $p->save();
        }
    }
}
