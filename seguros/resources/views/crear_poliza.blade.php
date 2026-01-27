@extends('layouts.master')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="/poliza">Pólizas</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">Bienvenido, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
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
            <h2>Crear Nueva Póliza</h2>
            
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('poliza.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="vehiculo_id">Vehículo:</label>
                    <select class="form-control" id="vehiculo_id" name="vehiculo_id" required>
                        <option value="">Selecciona un vehículo</option>
                        @foreach($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }} - {{ $vehiculo->modelo }} ({{ $vehiculo->matricula }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tipo_poliza">Tipo de Póliza:</label>
                    <select class="form-control" id="tipo_poliza" name="tipo_poliza" required>
                        <option value="">Selecciona un tipo</option>
                        <option value="todo_riesgo">A Todo Riesgo</option>
                        <option value="terceros">Terceros</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="importe">Importe:</label>
                    <input type="number" class="form-control" id="importe" name="importe" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Entrada en Vigor:</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>

                <div class="form-group">
                    <label for="fecha_renovacion">Fecha de Renovación:</label>
                    <input type="date" class="form-control" id="fecha_renovacion" name="fecha_renovacion" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Póliza</button>
                <a href="/poliza" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
