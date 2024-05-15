@extends('layouts.BasePage')
    <!-- Session Status -->

    @section('bodyPage')
     <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="form-floating mb-3 ">
        <input type="email"
        name="email" 
        class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
        id="floatingInput" 
        placeholder="name@example.com">
        <label for="floatingInput">Correo Electronico</label>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
   
    <!-- Password -->
    <div class="form-floating mb-3 " >
        <input type="password" 
            name="password"
            class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
            id="floatingPassword" 
            placeholder="Password"
            required autocomplete="current-password"
            >
        <label for="floatingPassword">Contraseña</label>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuerdame') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Olvidaste tu contraseña?') }}
            </a>
        @endif
        
        <div style="text-align: center;" >
            <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Iniciar Sesion</button>
        </div>
        <!--<x-primary-button class="">
            {{ __('afuera') }}
        </x-primary-button>-->
    </div>
</form>
    @endsection

   @section('styles')
    <link rel="stylesheet" href="/css/stylesViews/StylesViewLogin.css">
   @endsection