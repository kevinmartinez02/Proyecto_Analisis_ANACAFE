@extends('layouts.principal')
@include('layouts.navigation')

    <div class="container mt-5">
            <h1 class="mb-4">Lista de Usuarios</h1>

            <!-- Lista de Usuarios -->
            <div class="row">
               
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"><strong>Nombre:</strong>{{$user->nombre }}</p>
                            <p class="card-text"><strong>Apellido:</strong>{{$user->apellido }}</p>
                            <p class="card-text"><strong>DPI:</strong>{{$user->dpi }}</p>
                            <p class="card-text"><strong>No. IGGS:</strong>{{$user->numeroIGSS }}</p>
                            <p class="card-text"><strong>No. NIT:</strong> {{$user->nit}}</p>
                            <p class="card-text"><strong>Direccion:</strong>{{$user->direccion}} </p>
                            <p class="card-text"><strong>Telefono:</strong>{{$user->numeroTelefono}}</p>
                           <!-- <a href="{{ url('/users', $user->id) }}" class="btn btn-info">Ver</a>-->
                        </div>
                    </div>
                </div>
             
            </div>
    </div>