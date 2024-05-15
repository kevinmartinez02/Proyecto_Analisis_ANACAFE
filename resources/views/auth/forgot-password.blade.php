@extends('layouts.BasePage')

    @section('bodyPage')

    <div class="mb-4 text-sm text-gray-800 dark:text-gray-100" style="text-align: justify; font-family: Arial, sans-serif;">
        {{ __('¿Olvidaste tu contraseña? Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-floating mb-3 ">
            <input type="email"
                name="email" 
                class="form-control focus-ring border " style="--bs-focus-ring-color: rgba(var(--bs-success-rgb), .25)" 
                id="email" 
                placeholder="name@example.com"
                :value="old('email')" 
                required autofocus>
                <label for="floatingInput">Correo Electronico</label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div style="text-align: center;" >
            <button type="submit" class="btn btn-primary" style="background-color: #7DAF49; border: 2px solid #7DAF49;">Generar enlace para restablecer contraseña de correo electrónico</button>
        </div>
    </form>

@endsection


