@extends('layouts.master')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="/principal">Pólizas</a>
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
                        <li>
                            <a href="{{ route('poliza.create') }}" class="btn btn-outline-light btn-sm">+ Nueva Póliza</a>
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
        <div class="col-md-12">
            <h2>Gestión de Pólizas</h2>
            
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            @auth
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Vehículo</th>
                            <th>Tipo de Póliza</th>
                            <th>Importe (€)</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Renovación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($polizas as $poliza)
                            <tr>
                                <td>
                                    @if($poliza->vehiculo)
                                        {{ $poliza->vehiculo->marca }} - {{ $poliza->vehiculo->modelo }}
                                    @else
                                        Vehículo no disponible
                                    @endif
                                </td>
                                <td>
                                    {{ $poliza->tipo == 'todo_riesgo' ? 'A Todo Riesgo' : 'Terceros' }}
                                </td>
                                <td>{{ number_format($poliza->importe, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($poliza->fecha_comienzo)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($poliza->fecha_renovacion)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('poliza.edit', $poliza->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('poliza.destroy', $poliza->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay pólizas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    Debes iniciar sesión para ver las pólizas guardadas.
                </div>
            @endauth
        </div>
    </div>
@stop
