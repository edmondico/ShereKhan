@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Obras de {{ $company->nom }}</h1>

    <div class="row">
        @foreach(['Pendiente', 'En Proceso', 'Finalizada'] as $estado)
            <div class="col-md-4">
                <h3>{{ $estado }}</h3>
                <ul class="list-group">
                    @foreach($obras->where('estado', $estado) as $obra)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('obras.show', $obra) }}">{{ $obra->nom }}</a>
                            @if($obra->estado === 'Pendiente')
                                <span class="badge bg-warning">Pendiente</span>
                            @elseif($obra->estado === 'En Proceso')
                                <span class="badge bg-primary">En Proceso</span>
                            @else
                                <span class="badge bg-success">Finalizada</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <a href="{{ route('obras.create', ['company_id' => $company->id]) }}" class="btn btn-primary mt-4">Crear Nueva Obra</a>
</div>
@endsection
