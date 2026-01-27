<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Poliza;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        $examenes = Examen::all();
        return view('Home', compact('examenes'));
    }

    // PROCESA LA CARGA DE LA IMAGEN, LA VALIDA Y LA GUARDA EN public/images y EN LA BD
    public function store(Request $request)
    {
        \Log::info('Iniciando carga de imagen');
        \Log::info('Archivos recibidos: ' . print_r($request->allFiles(), true));
        
        // Validar los datos
        $validated = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:8',
            'anio_fab' => 'required|string|max:8',
            'matricula' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        \Log::info('Validación completada');

        // Guardar la imagen
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $nombreArchivo = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $carpeta = public_path('images');
            
            \Log::info('Archivo encontrado: ' . $file->getClientOriginalName());
            \Log::info('Carpeta de destino: ' . $carpeta);
            
            // Crear la carpeta si no existe
            if (!is_dir($carpeta)) {
                mkdir($carpeta, 0777, true);
                \Log::info('Carpeta creada');
            }
            
            // Mover el archivo
            try {
                $file->move($carpeta, $nombreArchivo);
                \Log::info('Archivo movido: ' . $nombreArchivo);
                $validated['poster'] = 'images/' . $nombreArchivo;
            } catch (\Exception $e) {
                \Log::error('Error moviendo archivo: ' . $e->getMessage());
                return redirect('/')->with('error', 'Error al mover la imagen: ' . $e->getMessage());
            }
        } else {
            \Log::error('No se encontró archivo poster');
            return redirect('/')->with('error', 'No se encontró la imagen');
        }

        // Guardar en la base de datos
        try {
            Examen::create($validated);
            \Log::info('Vehiculo guardado en BD');
        } catch (\Exception $e) {
            \Log::error('Error en BD: ' . $e->getMessage());
            return redirect('/')->with('error', 'Error al guardar en BD: ' . $e->getMessage());
        }

        return redirect('/')->with('success', 'Vehiculo guardado correctamente');
    }

    public function destroy($id)
    {
        $examen = Examen::findOrFail($id);
        
        // Eliminar la imagen del servidor
        if (file_exists(public_path($examen->poster))) {
            unlink(public_path($examen->poster));
        }
        
        $examen->delete();
        
        return redirect('/')->with('success', 'Imagen eliminada correctamente');
    }

    public function getCreate()
    {
        $examenes = Examen::all();
        return view('home', compact('examenes'));
    }

   public function postCreate(Request $request)
    {
        try {
            // Validar los datos sin la imagen primero
            $validated = $request->validate([
                'marca' => 'required|string|max:255',
                'modelo' => 'required|string|max:8',
                'anio_fab' => 'required|string|max:8',
                'matricula' => 'required|string',
                'poster' => 'required|file|max:5120',
            ]);

            \Log::info('Validación completada');

            // Guardar el archivo
            if ($request->hasFile('poster')) {
                $file = $request->file('poster');
                
                \Log::info('Archivo original: ' . $file->getClientOriginalName());
                \Log::info('Tamaño: ' . $file->getSize());
                \Log::info('MIME: ' . $file->getMimeType());
                
                $nombreArchivo = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $carpeta = public_path('images');
                
                // Crear la carpeta si no existe
                if (!is_dir($carpeta)) {
                    mkdir($carpeta, 0777, true);
                    \Log::info('Carpeta creada');
                }
                
                // Mover el archivo
                $file->move($carpeta, $nombreArchivo);
                $validated['poster'] = 'images/' . $nombreArchivo;
                \Log::info('Archivo guardado: ' . $nombreArchivo);
            } else {
                \Log::error('No se encontró archivo');
                return back()->with('error', 'No se encontró la imagen');
            }

            // Crear y guardar el vehiculo
            $vehiculo = new Examen();
            $vehiculo->marca = $validated['marca'];
            $vehiculo->modelo = $validated['modelo'];
            $vehiculo->anio_fab = $validated['anio_fab'];
            $vehiculo->matricula = $validated['matricula'];
            $vehiculo->poster = $validated['poster'];

            // $movie->synopsis = $validated['synopsis'];
            // $movie->rented = false;
            
            \Log::info('Guardando vehiculo: ' . json_encode($validated));
            
            $vehiculo->save();
            
            \Log::info('Vehiculo guardado con ID: ' . $vehiculo->id);
            return redirect('/')->with('success', 'Vehiculo creado correctamente');
            
        } catch (\Exception $e) {
            \Log::error('Error en postCreate: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function editarVehiculo()
    {
       $examenes = Examen::all();
        return view('editar_vehiculo', compact('examenes'));
    }

    public function principal()
    {
        $examenes = Examen::all();
        return view('principal', compact('examenes'));
    }

    public function poliza()
    {
        $polizas = Poliza::all();
        $vehiculos = Examen::all();
        return view('poliza', compact('polizas', 'vehiculos'));
    }

    public function getCreatePoliza()
    {
        $vehiculos = Examen::all();
        return view('crear_poliza', compact('vehiculos'));
    }

    public function storePoliza(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_vehiculo' => 'required|exists:vehiculo,id',
                'tipo' => 'required|in:todo_riesgo,terceros',
                'importe' => 'required|numeric|min:0',
                'fecha_comienzo' => 'required|date',
                'fecha_renovacion' => 'required|date|after:fecha_inicio',
            ]);

            Poliza::create($validated);
            
            \Log::info('Póliza guardada correctamente');
            return redirect('/poliza')->with('success', 'Póliza creada correctamente');
            
        } catch (\Exception $e) {
            \Log::error('Error en storePoliza: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function editpoliza($id)
    {
        $poliza = Poliza::findOrFail($id);
        $vehiculos = Examen::all();
        return view('edit_poliza', compact('poliza', 'vehiculos'));
    }

    public function updatePoliza(Request $request, $id)
    {
        try {
            $poliza = Poliza::findOrFail($id);
            
            $validated = $request->validate([
                'id_vehiculo' => 'required|exists:vehiculo,id',
                'tipo' => 'required|in:todo_riesgo,terceros',
                'importe' => 'required|numeric|min:0',
                'fecha_comienzo' => 'required|date',
                'fecha_renovacion' => 'required|date|after:fecha_inicio',
            ]);

            $poliza->update($validated);
            
            \Log::info('Póliza actualizada con ID: ' . $poliza->id);
            return redirect('/poliza')->with('success', 'Póliza actualizada correctamente');
            
        } catch (\Exception $e) {
            \Log::error('Error en updatePoliza: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroyPoliza($id)
    {
        try {
            $poliza = Poliza::findOrFail($id);
            $poliza->delete();
            
            return redirect('/poliza')->with('success', 'Póliza eliminada correctamente');
        } catch (\Exception $e) {
            \Log::error('Error en destroyPoliza: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }   

    public function edit($id)
    {
        $vehiculo = Examen::findOrFail($id);
        return view('edit_vehiculo', compact('vehiculo'));
    }

    public function update(Request $request, $id)
    {
        try {
            $vehiculo = Examen::findOrFail($id);
            
            // Validar los datos
            $validated = $request->validate([
                'marca' => 'required|string|max:255',
                'modelo' => 'required|string|max:8',
                'anio_fab' => 'required|string|max:8',
                'matricula' => 'required|string',
                'poster' => 'nullable|file|max:5120',
            ]);

            \Log::info('Validación completada para edición');

            // Si hay nueva imagen, actualizar
            if ($request->hasFile('poster')) {
                $file = $request->file('poster');
                
                \Log::info('Archivo original: ' . $file->getClientOriginalName());
                
                // Eliminar imagen anterior si existe
                if (file_exists(public_path($vehiculo->poster))) {
                    unlink(public_path($vehiculo->poster));
                    \Log::info('Imagen anterior eliminada');
                }
                
                $nombreArchivo = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $carpeta = public_path('images');
                
                if (!is_dir($carpeta)) {
                    mkdir($carpeta, 0777, true);
                }
                
                $file->move($carpeta, $nombreArchivo);
                $validated['poster'] = 'images/' . $nombreArchivo;
                \Log::info('Nueva imagen guardada: ' . $nombreArchivo);
            } else {
                // Mantener la imagen anterior
                unset($validated['poster']);
            }

            // Actualizar el vehículo
            $vehiculo->update($validated);
            
            \Log::info('Vehiculo actualizado con ID: ' . $vehiculo->id);
            return redirect('/')->with('success', 'Vehiculo actualizado correctamente');
            
        } catch (\Exception $e) {
            \Log::error('Error en update: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
