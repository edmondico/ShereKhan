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

        <div class="row mb-4">
            <div class="col-12">
                <h3>Lista de Obras (Mostrando 10)</h3>
                <table class="table table-bordered" id="obrasTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Ubicación</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Presupuesto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Ubicación</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Presupuesto</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                <a href="{{ route('obras.index') }}" class="btn btn-primary mt-3">Ver Todas las Obras</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3>Compañías y sus Obras</h3>
                <div class="list-group">
                    @foreach ($companies as $company)
                        <a href="{{ route('company.obras.index', $company) }}"
                            class="list-group-item list-group-item-action">
                            <h5 class="mb-1">{{ $company->nom }}</h5>
                            <p class="mb-1">Obras Asociadas: {{ $company->obras_count }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var languageUrl;
                switch ("{{ app()->getLocale() }}") {
                    case 'es':
                        languageUrl = "{{ asset('lang/es-ES.json') }}";
                        break;
                    case 'ca':
                        languageUrl = "{{ asset('lang/ca-ES.json') }}";
                        break;
                    default:
                        languageUrl = "{{ asset('lang/en-GB.json') }}";
                }

                var table = $('#obrasTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('dashboard.obras.data') }}",
                    columns: [{
                            data: 'nom',
                            name: 'nom'
                        },
                        {
                            data: 'estado',
                            name: 'estado'
                        },
                        {
                            data: 'ubicacio',
                            name: 'ubicacio'
                        },
                        {
                            data: 'data_inici',
                            name: 'data_inici'
                        },
                        {
                            data: 'data_fi',
                            name: 'data_fi'
                        },
                        {
                            data: 'presupost',
                            name: 'presupost'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    language: {
                        url: languageUrl,
                    }
                });
            });
        </script>
    @endpush
@endsection
