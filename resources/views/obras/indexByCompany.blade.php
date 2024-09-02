@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Obras de {{ $company->nom }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Finalización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
            <tr>
                <td>{{ $obra->nom }}</td>
                <td>{{ $obra->estado }}</td>
                <td>{{ $obra->data_inici }}</td>
                <td>{{ $obra->data_fi }}</td>
                <td>
                    <a href="{{ route('obras.show', $obra) }}" class="btn btn-info">Ver Detalles</a>
                    <a href="{{ route('obras.edit', $obra) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('obras.destroy', $obra) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
