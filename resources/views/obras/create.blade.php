@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Nueva Obra para {{ $company->nom }}</h2>
        <form action="{{ route('obras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="company_id" value="{{ $company->id }}">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Obra</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>

            <div class="mb-3">
                <label for="presupuesto" class="form-label">Presupuesto</label>
                <input type="number" class="form-control" id="presupuesto" name="presupuesto">
            </div>

            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
            </div>

            <!-- Selección de riesgos -->
            <div class="mb-3">
                <label for="riscos" class="form-label">Riesgos Asociados</label>
                <input type="text" class="form-control mb-2" id="search-riscos" placeholder="Buscar riesgos...">
                <div class="d-flex">
                    <div class="w-50">
                        <h6>Disponibles</h6>
                        <select multiple class="form-select listbox" id="riscos-available">
                            @foreach ($riscos as $risc)
                                <option value="{{ $risc->id }}">{{ $risc->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mx-3">
                        <button type="button" class="btn btn-primary btn-sm" id="add-risc">&gt;</button>
                        <button type="button" class="btn btn-primary btn-sm" id="remove-risc">&lt;</button>
                    </div>
                    <div class="w-50">
                        <h6>Seleccionados</h6>
                        <select multiple class="form-select listbox" id="riscos-selected" name="riscos[]"></select>
                    </div>
                </div>
            </div>

            <!-- Selección de contratas -->
            <div class="mb-3">
                <label for="contratas" class="form-label">Contratas Involucradas</label>
                <input type="text" class="form-control mb-2" id="search-contratas" placeholder="Buscar contratas...">
                <div class="d-flex">
                    <div class="w-50">
                        <h6>Disponibles</h6>
                        <select multiple class="form-select listbox" id="contratas-available">
                            @foreach ($contratas as $contrata)
                                <option value="{{ $contrata->id }}">{{ $contrata->nom_fiscal }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mx-3">
                        <button type="button" class="btn btn-primary btn-sm" id="add-contrata">&gt;</button>
                        <button type="button" class="btn btn-primary btn-sm" id="remove-contrata">&lt;</button>
                    </div>
                    <div class="w-50">
                        <h6>Seleccionadas</h6>
                        <select multiple class="form-select listbox" id="contratas-selected" name="contratas[]"></select>
                    </div>
                </div>
            </div>

            <!-- Trabajadores por contrata -->
            <div id="trabajadores-container"></div>

            <div class="mb-3">
                <label for="documents" class="form-label">Documentos a Leer</label>
                <input type="file" class="form-control" id="documents" name="documents[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Crear Obra</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            console.log("Script cargado correctamente.");

            // Filtrar contratas
            $('#search-contratas').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#contratas-available option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Filtrar riesgos
            $('#search-riscos').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#riscos-available option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Manejar la adición y remoción de riesgos
            $('#add-risc').click(function() {
                $('#riscos-available option:selected').appendTo('#riscos-selected');
            });

            $('#remove-risc').click(function() {
                $('#riscos-selected option:selected').appendTo('#riscos-available');
            });

            // Manejar la adición y remoción de contratas
            $('#add-contrata').click(function() {
                $('#contratas-available option:selected').appendTo('#contratas-selected');
                console.log("Contrata agregada. Actualizando trabajadores.");
                updateTrabajadoresSelects();
            });

            $('#remove-contrata').click(function() {
                $('#contratas-selected option:selected').appendTo('#contratas-available');
                console.log("Contrata removida. Actualizando trabajadores.");
                updateTrabajadoresSelects();
            });

            // Actualizar la selección de trabajadores en función de las contratas seleccionadas
            function updateTrabajadoresSelects() {
                var selectedContratas = $('#contratas-selected option').map(function() {
                    return $(this).val();
                }).get();

                console.log("Contratas seleccionadas: ", selectedContratas);

                var container = $('#trabajadores-container');
                container.empty();

                selectedContratas.forEach(function(contrataId) {
                    console.log("Procesando contrata: ", contrataId);
                    var contrata = {!! json_encode(
                        $contratas->keyBy('id')->map(function ($c) {
                            return ['nom_fiscal' => $c->nom_fiscal, 'treballadors' => $c->treballadors];
                        }),
                    ) !!}[contrataId];

                    if (contrata && contrata.treballadors && contrata.treballadors.length > 0) {
                        var trabajadoresBox = `
                        <div class="mb-3">
                            <h5>${contrata.nom_fiscal}</h5>
                            <div class="d-flex flex-wrap">
                                ${contrata.treballadors.map(treballador => `
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="treballadors[${contrataId}][]" value="${treballador.id}" id="trabajador-${treballador.id}">
                                            <label class="form-check-label" for="trabajador-${treballador.id}">${treballador.nom} ${treballador.cognom}</label>
                                        </div>
                                    `).join('')}
                            </div>
                        </div>
                    `;
                        container.append(trabajadoresBox);
                        console.log("Trabajadores box añadido para la contrata: ", contrata.nom_fiscal);
                    } else {
                        console.log("Contrata sin trabajadores o contrata no encontrada.");
                    }
                });
            }
        });
    </script>
@endpush
