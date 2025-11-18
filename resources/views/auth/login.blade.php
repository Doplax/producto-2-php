@extends('layouts.app')

@section('title', 'Iniciar Sesión - Isla Transfers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    @if(session('success') === 'registered')
                        <div class="alert alert-success">
                            ¡Registro exitoso! Ahora puedes iniciar sesión.
                        </div>
                    @endif
                    @if(session('error') === 'invalid')
                        <div class="alert alert-danger">
                            Email o contraseña incorrectos.
                        </div>
                    @endif
                    @if(session('error') === 'inactive')
                        <div class="alert alert-danger">
                            Tu cuenta está inactiva. Contacta con el administrador.
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>

                    <div class="text-center mt-3">
                        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
