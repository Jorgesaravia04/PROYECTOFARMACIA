{{-- Vista hija: hereda la plantilla padre --}}
@extends('template.administrador')

{{-- Textos que la plantilla muestra en sus huecos --}}
@section('title', 'Dashboard')
@section('name_section', 'Dashboard')
@section('description', 'Resumen de estadísticas')
@section('item_section', 'Inicio')
@section('section', 'Dashboard')
@section('module', 'Principal')

{{-- Contenido del dashboard (vacío por ahora) --}}
@section('content')
<div class="row g-3">
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
            <div class="card-body"><small class="text-muted">Ventas de hoy</small><h4>S/ {{ number_format($salesToday, 2) }}</h4></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
            <div class="card-body"><small class="text-muted">Ventas del mes</small><h4>S/ {{ number_format($salesMonth, 2) }}</h4></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
            <div class="card-body"><small class="text-muted">Clientes</small><h4>{{ $customersCount }}</h4></div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card bg-white border-0 shadow-sm border-5 border-top border-secondary">
            <div class="card-body"><small class="text-muted">Medicamentos</small><h4>{{ $medicinesCount }}</h4></div>
        </div>
    </div>
</div>
@endsection