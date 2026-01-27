@extends('layouts.master')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="/principal">Vehiculos</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">Bienvenido, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" href="/principal" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                        <li>
                            <form action="/catalog/create" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-outline-light btn-sm">Subir Vehiculo</button>
                            </form>

                            <form action="/poliza" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-outline-light btn-sm">Polizas</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <h2>Editar Vehiculo</h2>
            
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('catalog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>


                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="director" name="director" required>
                </div>

                
                <div class="form-group">
                    <label for="anio_fab">Año:</label>
                    <input type="text" class="form-control" id="year" name="year" maxlength="8" required>
                </div>

                <div class="form-group">
                    <label for="matricula">Matricula:</label>
                    <input class="form-control" id="synopsis" name="synopsis" maxlength="8" rows="4" required></input>
                </div>

                <div class="form-group">
                    <label for="poster">Imagen/Póster:</label>
                    <input type="file" class="form-control" id="poster" name="poster" accept="image/*" required>
                    <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF (máx. 5MB)</small>
                </div>

                <button type="submit" class="btn btn-primary">Editar vehiculo</button>
            </form>
        </div>
    </div>

   
    </div>
@stop
