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
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                        <li>
                            <form action="/catalog/editar" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-outline-light btn-sm">Editar Vehiculo</button>
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
    pantalla principal

@stop
