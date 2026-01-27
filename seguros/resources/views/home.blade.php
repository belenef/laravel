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
                            <form action="/catalog/editar" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-outline-light btn-sm">Editar Vehiculo</button>
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
            <h2>Subir Vehiculo</h2>
            
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('catalog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>


                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>

                
                <div class="form-group">
                    <label for="anio_fab">Año:</label>
                    <input type="text" class="form-control" id="anio_fab" name="anio_fab" maxlength="8" required>
                </div>

                <div class="form-group">
                    <label for="matricula">Matricula:</label>
                    <input class="form-control" id="matricula" name="matricula" maxlength="8" required></input>
                </div>

                <div class="form-group">
                    <label for="poster">Imagen/Póster:</label>
                    <input type="file" class="form-control" id="poster" name="poster" accept="image/*" required>
                    <small class="form-text text-muted">Formatos: JPEG, PNG, JPG, GIF (máx. 5MB)</small>
                </div>

                <button type="submit" class="btn btn-primary">Guardar vehiculo</button>
            </form>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Vehiculos guardados</h2>
            
            @auth
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Matricula</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($examenes as $vehiculo)
                            <tr>
                                <td>{{ $vehiculo->marca }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->anio_fab }}</td>
                                <td>{{ $vehiculo->matricula}}</td>
                                <td>
                                    @if ($vehiculo->poster)
                                        <img src="{{ asset($vehiculo->poster) }}" alt="{{ $vehiculo->modelo }}" width="50">
                                    @else
                                        Sin imagen
                                    @endif
                                <td>
                                    <a href="{{ route('catalog.edit', $vehiculo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('catalog.destroy', $vehiculo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay vehiculos</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    Debes iniciar sesión para ver los vehiculos guardados.
                </div>
            @endauth
        </div>
    </div>
@stop
