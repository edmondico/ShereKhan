@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles de la Obra: {{ $obra->nombre }}</h2>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Ubicación:</strong> {{ $obra->ubicacion }}</p>
            <p><strong>Estado:</strong> {{ $obra->estado }}</p>
            <p><strong>Fecha de Inicio:</strong> {{ $obra->fecha_inicio }}</p>
            <p><strong>Fecha de Finalización:</strong> {{ $obra->fecha_fin }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Presupuesto:</strong> {{ $obra->presupuesto }}</p>
            <p><strong>Cliente:</strong> {{ $obra->cliente }}</p>
            <p><strong>Responsable:</strong> {{ $obra->responsable->name }}</p>
        </div>
    </div>
    <h3>Documentos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre del Documento</th>
                <th>Tipo</th>
                <th>Fecha de Expedición</th>
                <th>Vigencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obra->documents as $document)
            <tr>
                <td>{{ $document->nombre_documento }}</td>
                <td>{{ $document->tipo_documento->nombre }}</td>
                <td>{{ $document->fecha_expedicion }}</td>
                <td>{{ $document->vigencia }}</td>
                <td>
                    <a href="{{ asset('storage/' . $document->ruta_documento) }}" class="btn btn-info" target="_blank">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
