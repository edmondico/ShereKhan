@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('messages.gestio_treballadors') }}</h2>
        <button type="button" class="btn btn-primary mb-3" id="createNewTreballador">{{ __('messages.new_treballador') }} <i
                class="fa fa-plus"></i></button>
        <table class="table table-bordered table-hover" id="treballadorsTable">
            <thead>
                <tr>
                    <th>{{ __('messages.contrata') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.surname') }}</th>
                    <th>{{ __('messages.dni') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th>{{ __('messages.birthdate') }}</th>
                    <th>{{ __('messages.gender') }}</th>
                    <th>{{ __('messages.responsible') }}</th>
                    <th>{{ __('messages.company_phone') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>{{ __('messages.contrata') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.surname') }}</th>
                    <th>{{ __('messages.dni') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th>{{ __('messages.birthdate') }}</th>
                    <th>{{ __('messages.gender') }}</th>
                    <th>{{ __('messages.responsible') }}</th>
                    <th>{{ __('messages.company_phone') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="treballadorForm" name="treballadorForm" class="form-horizontal">
                        <input type="hidden" name="treballador_id" id="treballador_id">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_contrata" class="form-label">{{ __('messages.contrata') }}</label>
                                <select class="form-select select2" id="id_contrata" name="id_contrata" required>
                                    @foreach ($contratas as $contrata)
                                        <option value="{{ $contrata->id }}">{{ $contrata->nom_fiscal }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_responsable" class="form-label">{{ __('messages.responsible') }}</label>
                                <select class="form-select select2" id="id_responsable" name="id_responsable">
                                    <option value="">{{ __('messages.select_responsible') }}</option>
                                    @foreach ($treballadors as $treballador)
                                        <option value="{{ $treballador->id }}">{{ $treballador->nom }}
                                            {{ $treballador->cognom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cognom" class="form-label">{{ __('messages.surname') }}</label>
                                <input type="text" class="form-control" id="cognom" name="cognom" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dni" class="form-label">{{ __('messages.dni') }}</label>
                                <input type="text" class="form-control" id="dni" name="dni" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mail" class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="mail" name="mail" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefon" class="form-label">{{ __('messages.phone') }}</label>
                                <input type="text" class="form-control" id="telefon" name="telefon" required>
                            </div>
                            <div class="col-md-6">
                                <label for="data_naixement" class="form-label">{{ __('messages.birthdate') }}</label>
                                <input type="date" class="form-control" id="data_naixement" name="data_naixement"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="genere" class="form-label">{{ __('messages.gender') }}</label>
                                <select class="form-select" id="genere" name="genere" required>
                                    <option value="M">{{ __('messages.male') }}</option>
                                    <option value="F">{{ __('messages.female') }}</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label for="telefon_empresa" class="form-label">{{ __('messages.company_phone') }}</label>
                                <input type="text" class="form-control" id="telefon_empresa" name="telefon_empresa"
                                    required>
                            </div>
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
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Definir languageUrl basado en el idioma actual
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

                // Inicializar DataTable
                var table = $('#treballadorsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    pagingType: 'simple_numbers',
                    ajax: {
                        url: "{{ route('treballadors.index') }}",
                        type: "GET",
                        error: function(xhr, error, thrown) {
                            console.log('Error en la petición Ajax:', xhr.responseText);
                            alert(
                                'Error al cargar la tabla de trabajadores. Consulte la consola para obtener más detalles.');
                        }
                    },
                    columns: [{
                            data: 'contrata_nom',
                            name: 'contrata_nom'
                        },
                        {
                            data: 'nom',
                            name: 'nom'
                        },
                        {
                            data: 'cognom',
                            name: 'cognom'
                        },
                        {
                            data: 'dni',
                            name: 'dni'
                        },
                        {
                            data: 'mail',
                            name: 'mail'
                        },
                        {
                            data: 'telefon',
                            name: 'telefon'
                        },
                        {
                            data: 'data_naixement',
                            name: 'data_naixement'
                        },
                        {
                            data: 'genere',
                            name: 'genere'
                        },
                        {
                            data: 'responsable_nom',
                            name: 'responsable_nom'
                        },
                        {
                            data: 'telefon_empresa',
                            name: 'telefon_empresa'
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

                // Re-inicializar select2 al mostrar el modal
                $('#ajaxModal').on('shown.bs.modal', function() {
                    $('#id_contrata').select2({
                        dropdownParent: $('#ajaxModal')
                    });

                    $('#id_responsable').select2({
                        dropdownParent: $('#ajaxModal')
                    });
                });

                // Crear nuevo trabajador
                $('#createNewTreballador').click(function() {
                    $('#saveBtn').val("create-treballador");
                    $('#treballador_id').val('');
                    $('#treballadorForm').trigger("reset");
                    $('#id_contrata').val(null).trigger('change');
                    $('#id_responsable').val(null).trigger('change');
                    $('#modelHeading').html("{{ __('messages.new_treballador') }}");
                    $('#ajaxModal').modal('show');
                });

                // Editar trabajador
                $('body').on('click', '.edit', function() {
                    var treballador_id = $(this).data('id');
                    $.get("{{ route('treballadors.index') }}" + '/' + treballador_id + '/edit', function(
                    data) {
                        $('#modelHeading').html("{{ __('messages.edit_treballador') }}");
                        $('#saveBtn').val("edit-treballador");
                        $('#ajaxModal').modal('show');
                        $('#treballador_id').val(data.id);
                        $('#id_contrata').val(data.id_contrata).trigger('change');
                        $('#id_responsable').val(data.id_responsable).trigger('change');
                        $('#nom').val(data.nom);
                        $('#cognom').val(data.cognom);
                        $('#dni').val(data.dni);
                        $('#mail').val(data.mail);
                        $('#telefon').val(data.telefon);
                        $('#data_naixement').val(data.data_naixement);
                        $('#genere').val(data.genere);
                        $('#telefon_empresa').val(data.telefon_empresa);
                    }).fail(function(xhr, status, error) {
                        console.log('Error al obtener los datos:', error);
                    });
                });

                // Guardar trabajador
                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('{{ __('messages.sending') }}..');

                    $.ajax({
                        data: $('#treballadorForm').serialize(),
                        url: "{{ route('treballadors.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            console.log('Respuesta de guardado:', data);
                            $('#treballadorForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.draw();
                            $('#saveBtn').html('{{ __('messages.save_changes') }}');
                        },
                        error: function(xhr, status, error) {
                            console.log('Error al guardar:', xhr.responseJSON);
                            $('.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').remove();

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

                // Eliminar trabajador
                $('body').on('click', '.delete', function() {
                    var treballador_id = $(this).data("id");
                    if (confirm("{{ __('messages.delete_confirmation') }}")) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('treballadors.store') }}" + '/' + treballador_id,
                            success: function(data) {
                                console.log('Respuesta de eliminación:', data);
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error al eliminar:', data);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
