@extends('layouts.master')

@section('content')
    <!-- Detail view of the movie {{ $id }} -->

    <div class="row">
       
        <div class="col-sm-4"><br>
            {{-- TODO: Imagen de la película --}}
            
                <img src="{{$pelicula['poster']}}" style="height:400px"/>
            </div>
            <div class="col-sm-8"><br>
            {{-- TODO: Datos de la película --}}
                
                    <h1><strong> {{$pelicula['title']}}</strong></h1>
                    <h4><strong>Año:</strong> {{$pelicula['year']}}</h4>
                    <h4><strong>Director:</strong> {{$pelicula['director']}}</h4><br>
                    <p style="margin-right:6rem"><strong>Resumen:</strong> {{$pelicula['synopsis']}}</p><br>
                    <p><strong>Estado:</strong>
                        @if($pelicula['rented'])
                            Película actualmente alquilada
                        @else
                            Disponible
                        @endif
                    </p><br>

                    <button type="button" class="btn btn-danger">Devolver película</button>
                    <form action="{{ url('/catalog/edit/' . $id) }}" method="get" style="display:inline">
                        <button type="submit" class="btn btn-warning" style="color:white">Editar película</button>
                    </form>
                     <form action="{{ url('/catalog') }}" method="get" style="display:inline">
                        <button type="submit" class="btn btn-light" style="border: solid 1px lightgrey;">Volver al listado</button>
                    </form>
                
            </div>
        </div>
 
@stop
