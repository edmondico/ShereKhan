@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('messages.gestio_documentacio') }}</h2>
        <button type="button" class="btn btn-primary mb-3" id="createNewDocument">{{ __('messages.new_document') }} <i
                class="fa fa-plus"></i></button>
        <table class="table table-bordered table-hover" id="documentsTable">
            <thead>
                <tr>
                    <th>{{ __('messages.treballador') }}</th>
                    <th>{{ __('messages.nom_document') }}</th>
                    <th>{{ __('messages.data_expedicio') }}</th>
                    <th>{{ __('messages.tipus_document') }}</th>
                    <th>{{ __('messages.estat') }}</th>
                    <th>{{ __('messages.descripcio') }}</th> <!-- Nueva columna -->
                    <th>{{ __('messages.observacions') }}</th> <!-- Nueva columna -->
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>{{ __('messages.treballador') }}</th>
                    <th>{{ __('messages.nom_document') }}</th>
                    <th>{{ __('messages.data_expedicio') }}</th>
                    <th>{{ __('messages.tipus_document') }}</th>
                    <th>{{ __('messages.estat') }}</th>
                    <th>{{ __('messages.descripcio') }}</th> <!-- Nueva columna -->
                    <th>{{ __('messages.observacions') }}</th> <!-- Nueva columna -->
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </tfoot>

        </table>
    </div>
    <style>

    </style>
    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="documentForm" name="documentForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_treballador" class="form-label">{{ __('messages.treballador') }}</label>
                                <select class="form-select select2" id="id_treballador" name="id_treballador" required>
                                    @foreach ($treballadors as $treballador)
                                        <option value="{{ $treballador->id }}">{{ $treballador->nom }}
                                            {{ $treballador->cognom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nom_document" class="form-label">{{ __('messages.nom_document') }}</label>
                                <input type="text" class="form-control" id="nom_document" name="nom_document" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data_expedicio" class="form-label">{{ __('messages.data_expedicio') }}</label>
                                <input type="date" class="form-control" id="data_expedicio" name="data_expedicio">
                            </div>
                            <div class="col-md-6">
                                <label for="tipus_document" class="form-label">{{ __('messages.tipus_document') }}</label>
                                <select class="form-select" id="tipus_document" name="tipus_document" required>
                                    <option value="identificacio">{{ __('messages.identificacio') }}</option>
                                    <option value="formacio">{{ __('messages.formacio') }}</option>
                                    <option value="contracte">{{ __('messages.contracte') }}</option>
                                    <option value="altre">{{ __('messages.altre') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="descripcio" class="form-label">{{ __('messages.descripcio') }}</label>
                                <textarea class="form-control" id="descripcio" name="descripcio" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observacions" class="form-label">{{ __('messages.observacions') }}</label>
                                <textarea class="form-control" id="observacions" name="observacions" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="estat" class="form-label">{{ __('messages.estat') }}</label>
                                <select class="form-select" id="estat" name="estat" required>
                                    <option value="pendent">{{ __('messages.pendent') }}</option>
                                    <option value="validat">{{ __('messages.validat') }}</option>
                                    <option value="rebutjat">{{ __('messages.rebutjat') }}</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="document_path" class="form-label">{{ __('messages.document') }}</label>
                                <input type="file" class="form-control" id="document_path" name="document_path">
                                <div id="existingDocument" class="mt-2">
                                    <!-- Aquí se mostrará el documento existente si lo hay -->
                                </div>
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

                var table = $('#documentsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    pagingType: 'simple_numbers',
                    ajax: {
                        url: "{{ route('documents.index') }}",
                        type: "GET",
                        error: function(xhr, error, thrown) {
                            console.log('Error en la petición Ajax:', xhr.responseText);
                            alert(
                                'Error al cargar la tabla de documentos. Consulte la consola para obtener más detalles.'
                            );
                        }
                    },
                    columns: [{
                            data: 'treballador_nom',
                            name: 'treballador_nom'
                        },
                        {
                            data: 'nom_document',
                            name: 'nom_document'
                        },
                        {
                            data: 'data_expedicio',
                            name: 'data_expedicio'
                        },
                        {
                            data: 'tipus_document',
                            name: 'tipus_document'
                        },
                        {
                            data: 'estat',
                            name: 'estat'
                        },
                        {
                            data: 'descripcio',
                            name: 'descripcio'
                        }, // Nueva columna para descripcio
                        {
                            data: 'observacions',
                            name: 'observacions'
                        }, // Nueva columna para observacions
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


                $('#ajaxModal').on('shown.bs.modal', function() {
                    $('#id_treballador').select2({
                        dropdownParent: $('#ajaxModal')
                    });
                });

                $('#createNewDocument').click(function() {
                    $('#saveBtn').val("create-document");
                    $('#id').val('');
                    $('#documentForm').trigger("reset");
                    $('#existingDocument').html(''); // Clear previous document preview
                    $('#id_treballador').val(null).trigger('change');
                    $('#modelHeading').html("{{ __('messages.new_document') }}");
                    $('#ajaxModal').modal('show');
                });

                $('body').on('click', '.edit', function() {
                    var document_id = $(this).data('id');
                    $.get("{{ route('documents.index') }}" + '/' + document_id + '/edit', function(data) {
                        $('#modelHeading').html("{{ __('messages.edit_document') }}");
                        $('#saveBtn').val("edit-document");
                        $('#ajaxModal').modal('show');
                        $('#id').val(data.id);
                        $('#id_treballador').val(data.id_treballador).trigger('change');
                        $('#nom_document').val(data.nom_document);
                        $('#data_expedicio').val(data.data_expedicio);
                        $('#tipus_document').val(data.tipus_document);
                        $('#descripcio').val(data.descripcio);
                        $('#observacions').val(data.observacions);
                        $('#estat').val(data.estat);

                        // Mostrar el documento existente si lo hay
                        if (data.document_path) {
                            var filePreview = '<a href="' + data.document_path +
                                '" target="_blank" class="btn btn-info">{{ __('messages.ver_document') }}</a>';
                            $('#existingDocument').html(
                                '<p>{{ __('messages.documento_existente') }}:</p>' + filePreview);
                        } else {
                            $('#existingDocument').html('');
                        }
                    }).fail(function(xhr, status, error) {
                        console.log('Error al obtener los datos:', error);
                    });
                });

                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#documentForm')[0]); // Actualizar para admitir archivos
                    $(this).html('{{ __('messages.sending') }}..');

                    $.ajax({
                        data: formData,
                        url: "{{ route('documents.store') }}", // Asegúrate de que esta ruta sea la correcta
                        type: "POST",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Respuesta de guardado:', data);
                            $('#documentForm').trigger("reset");
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

                $('body').on('click', '.delete', function() {
                    var document_id = $(this).data("id");
                    if (confirm("{{ __('messages.delete_confirmation') }}")) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('documents.destroy', '') }}/" + document_id,
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
