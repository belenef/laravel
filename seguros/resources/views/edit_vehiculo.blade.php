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
            
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('catalog.update', $vehiculo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $vehiculo->marca) }}" required>
                </div>

                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}" required>
                </div>

                <div class="form-group">
                    <label for="anio_fab">Año:</label>
                    <input type="text" class="form-control" id="anio_fab" name="anio_fab" maxlength="8" value="{{ old('anio_fab', $vehiculo->anio_fab) }}" required>
                </div>

                <div class="form-group">
                    <label for="matricula">Matricula:</label>
                    <input class="form-control" id="matricula" name="matricula" maxlength="8" value="{{ old('matricula', $vehiculo->matricula) }}" required></input>
                </div>

                <div class="form-group">
                    <label for="poster">Imagen/Póster:</label>
                    @if ($vehiculo->poster)
                        <div class="mb-2">
                            <p>Imagen actual:</p>
                            <img src="{{ asset($vehiculo->poster) }}" alt="{{ $vehiculo->modelo }}" width="150">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
                    <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF (máx. 5MB) - Opcional si no quieres cambiar la imagen</small>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar vehiculo</button>
                <a href="/" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
