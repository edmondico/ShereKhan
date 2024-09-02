@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="mb-4 titol"><i class="fa-solid fa-helmet-safety"></i> {{ __('messages.contratas') }}</p>
        <button type="button" class="btn btn-primary mb-4" id="createNewContrata">{{ __('messages.create') }}</button>
        <table class="table table-bordered table-hover" id="contratasTable">
            <thead class="table-light">
                <tr>
                    <th>{{ __('messages.name_fiscal') }}</th>
                    <th>{{ __('messages.name_comercial') }}</th>
                    <th>{{ __('messages.cif') }}</th>
                    <th>{{ __('messages.address') }}</th>
                    <th>{{ __('messages.mail') }}</th>
                    <th>{{ __('messages.logo') }}</th>
                    <th>{{ __('messages.color') }}</th>
                    <th>{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tfoot class="table-light">
                <tr>
                    <th>{{ __('messages.name_fiscal') }}</th>
                    <th>{{ __('messages.name_comercial') }}</th>
                    <th>{{ __('messages.cif') }}</th>
                    <th>{{ __('messages.address') }}</th>
                    <th>{{ __('messages.mail') }}</th>
                    <th>{{ __('messages.logo') }}</th>
                    <th>{{ __('messages.color') }}</th>
                    <th>{{ __('messages.action') }}</th>
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
                    <form id="contrataForm" name="contrataForm" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="contrata_id" id="contrata_id">
                        <input type="hidden" name="logo_hidden" id="logo_hidden">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name_fiscal" class="form-label">{{ __('messages.name_fiscal') }}</label>
                                <input type="text" class="form-control" id="name_fiscal" name="nom_fiscal"
                                    placeholder="{{ __('messages.name_fiscal') }}" value="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name_comercial" class="form-label">{{ __('messages.name_comercial') }}</label>
                                <input type="text" class="form-control" id="name_comercial" name="nom_comercial"
                                    placeholder="{{ __('messages.name_comercial') }}" value="" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cif" class="form-label">{{ __('messages.cif') }}</label>
                                <input type="text" class="form-control" id="cif" name="cif"
                                    placeholder="{{ __('messages.cif') }}" value="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">{{ __('messages.address') }}</label>
                                <input type="text" class="form-control" id="address" name="direccio"
                                    placeholder="{{ __('messages.address') }}" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="mail" class="form-label">{{ __('messages.mail') }}</label>
                                <input type="email" class="form-control" id="mail" name="mail"
                                    placeholder="{{ __('messages.mail') }}" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="logo" class="form-label">{{ __('messages.logo') }}</label>
                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="color" class="form-label">{{ __('messages.color') }}</label>
                                <input type="color" class="form-control form-control-color" id="color" name="color"
                                    value="#ff0000">
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">{{ __('messages.description') }}</label>
                                <textarea id="description" name="descripcio_activitat" class="form-control"
                                    placeholder="{{ __('messages.description') }}" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="saveBtn"
                                value="create">{{ __('messages.save_changes') }}</button>
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

                var table = $('#contratasTable').DataTable({
                    processing: true,
                    serverSide: true,
                    pagingType: 'simple_numbers',
                    ajax: "{{ route('get.contratas') }}",
                    columns: [{
                            data: 'nom_fiscal',
                            name: 'nom_fiscal'
                        },
                        {
                            data: 'nom_comercial',
                            name: 'nom_comercial'
                        },
                        {
                            data: 'cif',
                            name: 'cif'
                        },
                        {
                            data: 'direccio',
                            name: 'direccio'
                        },
                        {
                            data: 'mail',
                            name: 'mail'
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            render: function(data, type, full, meta) {
                                return data ? '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="Logo" width="50" height="50">' : '';
                            }
                        },
                        {
                            data: 'color',
                            name: 'color',
                            render: function(data) {
                                return '<i class="fa-solid fa-square fa-xl" style="color:' + data +
                                    '"></i>';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    language: {
                        url: languageUrl,
                    }
                });

                $('#createNewContrata').click(function() {
                    $('#saveBtn').val("create-contrata");
                    $('#contrata_id').val('');
                    $('#contrataForm').trigger("reset");
                    $('#modelHeading').html("{{ __('messages.create_contrata') }}");
                    $('#ajaxModal').modal('show');
                });

                $('body').on('click', '.edit', function() {
                    var contrata_id = $(this).data('id');
                    $.get("{{ route('contratas.index') }}" + '/' + contrata_id + '/edit', function(data) {
                        $('#modelHeading').html("{{ __('messages.edit_contrata') }}");
                        $('#saveBtn').val("edit-contrata");
                        $('#ajaxModal').modal('show');
                        $('#contrata_id').val(data.id);
                        $('#name_fiscal').val(data.nom_fiscal);
                        $('#name_comercial').val(data.nom_comercial);
                        $('#cif').val(data.cif);
                        $('#address').val(data.direccio);
                        $('#mail').val(data.mail);
                        $('#description').val(data.descripcio_activitat);
                        $('#color').val(data.color);
                        $('#logo_hidden').val(data.logo); // Cargar el logo existente
                    });
                });

                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('{{ __('messages.sending') }}..');

                    var formData = new FormData($('#contrataForm')[0]);

                    $.ajax({
                        data: formData,
                        url: "{{ route('contratas.store') }}",
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#contrataForm').trigger("reset");
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
                    var contrata_id = $(this).data("id");
                    if (confirm("{{ __('messages.delete_confirmation') }}")) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('contratas.store') }}" + '/' + contrata_id,
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
