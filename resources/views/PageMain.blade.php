@extends('layouts.BasePage')
@section('bodyPage')
<div>
@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        
                    @auth
                        <a href="{{ route('inicio') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Has iniciado Sesion Regresa al inicio</a>
                    @else
                    <div style="text-align: center;">
                        <button type="button" onclick="window.location.href='{{ route('login') }}'" class="btn btn-primary" style="background-color: #7DAF49;">
                            Login
                            <!--<a href="{{ route('login') }}" class="ml-4 text-sm text-white dark:text-gray-500 underline">Log in</a> -->
                        </button>

                    @if (Route::has('register'))
                        <button type="button" onclick="window.location.href='{{ route('register') }}'" class="btn btn-primary" style="background-color: #7DAF49;">
                            Register
                        </button>
                    @endif
</div>
    
             
        @endauth
    </div>
@endif
    </div>
@endsection