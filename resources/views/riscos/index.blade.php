@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('messages.gestio_riscos') }}</h2>
        <button type="button" class="btn btn-primary mb-3" id="createNewRisc">{{ __('messages.new_risc') }} <i
                class="fa fa-plus"></i></button>
        <table class="table table-bordered table-hover" id="riscosTable">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.description') }}</th>
                    <th>{{ __('messages.risk_degree') }}</th>
                    <th>{{ __('messages.epi') }}</th>
                    <th>{{ __('messages.observations') }}</th>
                    <th>{{ __('messages.requirements') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.description') }}</th>
                    <th>{{ __('messages.risk_degree') }}</th>
                    <th>{{ __('messages.epi') }}</th>
                    <th>{{ __('messages.observations') }}</th>
                    <th>{{ __('messages.requirements') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modal más grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="riscForm" name="riscForm" class="form-horizontal">
                        <input type="hidden" name="risc_id" id="risc_id">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="grau_de_risc" class="form-label">{{ __('messages.risk_degree') }}</label>
                                <select class="form-select" id="grau_de_risc" name="grau_de_risc" required>
                                    <option value="Baix">{{ __('messages.low') }}</option>
                                    <option value="Mitjà">{{ __('messages.medium') }}</option>
                                    <option value="Alt">{{ __('messages.high') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcio" class="form-label">{{ __('messages.description') }}</label>
                            <textarea class="form-control" id="descripcio" name="descripcio" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="epi" class="form-label">{{ __('messages.epi') }}</label>
                            <div>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="epi" id="epi_si"
                                        value="1" required>
                                    {{ __('messages.yes') }}
                                </label>
                                <label class="form-check-label ms-3">
                                    <input class="form-check-input" type="radio" name="epi" id="epi_no"
                                        value="0" required>
                                    {{ __('messages.no') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="observacions" class="form-label">{{ __('messages.observations') }}</label>
                            <textarea class="form-control" id="observacions" name="observacions" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="requisits" class="form-label">{{ __('messages.requirements') }}</label>
                            <textarea class="form-control" id="requisits" name="requisits" rows="2"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"
                                id="saveBtn">{{ __('messages.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

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

                var table = $('#riscosTable').DataTable({
                    processing: true,
                    serverSide: true,
                    pagingType: 'simple_numbers',
                    ajax: "{{ route('riscos.index') }}",
                    columns: [{
                            data: 'nom',
                            name: 'nom'
                        },
                        {
                            data: 'descripcio',
                            name: 'descripcio'
                        },
                        {
                            data: 'grau_de_risc',
                            name: 'grau_de_risc'
                        },
                        {
                            data: 'epi',
                            name: 'epi',
                            render: function(data, type, row) {
                                return data == 1 ? '<i class="fa fa-check text-success"></i>' :
                                    '<i class="fa fa-times text-danger"></i>';
                            }
                        },
                        {
                            data: 'observacions',
                            name: 'observacions'
                        },
                        {
                            data: 'requisits',
                            name: 'requisits'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `<a href="javascript:void(0)" data-id="${row.id}" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" data-id="${row.id}" class="delete btn btn-danger btn-sm ms-2"><i class="fa fa-trash"></i></a>`;
                            }
                        },
                    ],
                    language: {
                        url: languageUrl,
                    }
                });

                $('#createNewRisc').click(function() {
                    $('#saveBtn').val("create-risc");
                    $('#risc_id').val('');
                    $('#riscForm').trigger("reset");
                    $('#modelHeading').html("{{ __('messages.new_risc') }}");
                    $('#ajaxModal').modal('show');
                });

                $('body').on('click', '.edit', function() {
                    var risc_id = $(this).data('id');
                    $.get("{{ route('riscos.index') }}" + '/' + risc_id + '/edit', function(data) {
                            console.log('Datos recibidos para edición:',
                            data); // Log completo de los datos recibidos

                            $('#modelHeading').html("{{ __('messages.edit_risc') }}");
                            $('#saveBtn').val("edit-risc");
                            $('#ajaxModal').modal('show');
                            $('#risc_id').val(data.id);
                            $('#nom').val(data.nom);
                            $('#descripcio').val(data.descripcio);

                            // Popular el campo de epi correctamente
                            if (data.epi == 1) {
                                $('#epi_si').prop('checked', true);
                            } else {
                                $('#epi_no').prop('checked', true);
                            }

                            // Normalizar el valor de grau_de_risc para que coincida con las opciones del select
                            var grauDeRiscNormalizado = data.grau_de_risc.charAt(0).toUpperCase() + data
                                .grau_de_risc.slice(1).toLowerCase();

                            // Corrección específica para Mitja a Mitjà
                            if (grauDeRiscNormalizado === 'Mitja') {
                                grauDeRiscNormalizado = 'Mitjà';
                            }

                            console.log('Grau de Risc Normalizado:', grauDeRiscNormalizado);

                            $('#grau_de_risc').val(grauDeRiscNormalizado);

                            // Log para verificar si el valor se ha aplicado al select
                            console.log('Valor del select después de asignación:', $('#grau_de_risc')
                        .val());

                            $('#observacions').val(data.observacions);
                            $('#requisits').val(data.requisits);
                        })
                        .fail(function(xhr, status, error) {
                            console.log('Error al obtener los datos:', error);
                        });
                });





                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('{{ __('messages.sending') }}..');

                    $.ajax({
                        data: $('#riscForm').serialize(),
                        url: "{{ route('riscos.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#riscForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.draw();
                            $('#saveBtn').html('{{ __('messages.save_changes') }}');
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', xhr.responseJSON);

                            // Limpiar errores anteriores
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').remove();

                            // Mostrar errores en los campos correspondientes
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    var inputField = $('#' + key);
                                    inputField.addClass('is-invalid');
                                    inputField.after('<div class="invalid-feedback">' +
                                        value[0] + '</div>');
                                });
                            }

                            $('#saveBtn').html('{{ __('messages.save_changes') }}');
                        }
                    });
                });

                $('body').on('click', '.delete', function() {
                    var risc_id = $(this).data("id");
                    if (confirm("{{ __('messages.delete_confirmation') }}")) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('riscos.store') }}" + '/' + risc_id,
                            success: function(data) {
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
