<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    // inicializo el array de peliculas
    // private $arrayPeliculas; 
    public function run(): void
    {
        $this->seedUsers(); // inicializa usuarios
        // $this->seedCatalog(); // inicializa tabla movies desde array
        $this->command->info('Tabla users inicializada con datos!');
    }


    // FUNCION PARA INICIALIZAR TABLA CON ARRAY
    //  private function seedCatalog(): void
    // {
        // cargo el array de peliculas
        // $this->arrayPeliculas = require app_path('Http/Controllers/array_peliculas.php');
        
        // Movie::truncate(); // vacio la tabla movies

        // recorro el array e inserto los datos en la tabla movies
    //     foreach($this->arrayPeliculas as $pelicula) {
    //         $p = new Movie();
    //         $p->title = $pelicula['title'];
    //         $p->year = $pelicula['year'];
    //         $p->director = $pelicula['director'];
    //         $p->poster = $pelicula['poster'];
    //         $p->rented = $pelicula['rented'];
    //         $p->synopsis = $pelicula['synopsis'];
    //         $p->save();
    //     }
    // }
    
    public function seedUsers():void{
        User::truncate(); // vacio la tabla users

        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@example.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'Admin@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
