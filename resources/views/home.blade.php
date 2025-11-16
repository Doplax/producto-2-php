@extends('layouts.app')

@section('title', $title ?? 'Home - Isla Transfers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="jumbotron bg-light p-5 rounded">
                <h1 class="display-4">{{ $title ?? 'Bienvenido a Isla Transfers' }}</h1>
                <p class="lead">{{ $description ?? 'Tu servicio de traslados en la isla' }}</p>
                <hr class="my-4">
                <p>Reserva tu transfer de forma rápida y sencilla. Ofrecemos servicios de traslado desde y hacia el aeropuerto a cualquier hotel de la isla.</p>
                <div class="mt-4">
                    @auth('viajero')
                        <a class="btn btn-primary btn-lg" href="{{ route('reserva.crear') }}" role="button">Nueva Reserva</a>
                        <a class="btn btn-secondary btn-lg" href="{{ route('reserva.misReservas') }}" role="button">Ver Mis Reservas</a>
                    @else
                        <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Registrarse</a>
                        <a class="btn btn-secondary btn-lg" href="{{ route('login') }}" role="button">Iniciar Sesión</a>
                    @endauth
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">🚗 Servicio 24/7</h5>
                            <p class="card-text">Disponibles en cualquier momento para tus traslados.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">✈️ Aeropuerto</h5>
                            <p class="card-text">Servicio directo desde y hacia el aeropuerto.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">🏨 A tu Hotel</h5>
                            <p class="card-text">Te llevamos directamente a tu destino.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
