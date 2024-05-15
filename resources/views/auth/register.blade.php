
@extends('layouts.BasePage')

@section('bodyPage')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div class="form-floating mb-3 " >
        <input type="text" 
            name="name"
            class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
            id="floatingName" 
            placeholder="Name"
            required autocomplete="name"
            >
        <label for="floatingName">Nombre de usuario</label>
        <x-input-error :messages="$errors->get('name')" class="" />
    </div>

        <!-- Email Address -->
        <div class="form-floating mb-3 ">
            <input type="email"
                name="email" 
                class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
                id="floatingInput" 
                placeholder="name@example.com"
                name="email" 
                :value="old('email')" 
                required autocomplete="username">
            <label for="floatingInput">Correo Electronico</label>
            <x-input-error :messages="$errors->get('email')" class="" />
        </div>
   

        <!-- Password -->

        <div class="form-floating mb-3 " >
            <input type="password" 
                name="password"
                class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
                id="password" 
                placeholder="Password"
                required autocomplete="new-password">
            <label for="floatingPassword">Contraseña</label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <!-- Confirm Password -->

        <div class="form-floating mb-3 " >
            <input type="password" 
                name="password_confirmation"
                class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
                id="password_confirmation" 
                placeholder="Password"
                required autocomplete="new-password">
            <label for="floatingPassword">Confirmar Contraseña</label>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Tienes una cuenta?') }}
            </a>

            
            <div style="text-align: center;" >
                <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Registrarse</button>
             </div>
        </div>
    </form>
@endsection
