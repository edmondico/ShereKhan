@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total de Obras</h5>
                    <h3>{{ $totalObras }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Obras en Proceso</h5>
                    <h3>{{ $obrasEnProceso }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Obras Finalizadas</h5>
                    <h3>{{ $obrasFinalizadas }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Obras Pendientes</h5>
                    <h3>{{ $obrasPendientes }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Lista de Obras</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obras as $obra)
                    <tr>
                        <td>{{ $obra->nombre }}</td>
                        <td>{{ $obra->estado }}</td>
                        <td>{{ $obra->cliente }}</td>
                        <td>{{ $obra->responsable->name }}</td>
                        <td>
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
    </div>
</div>
@endsection
