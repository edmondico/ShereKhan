@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <p class="mb-4 titol"><i class="fa-solid fa-building "></i> {{ __('messages.companies') }}</p>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-outline-primary btn-sm mb-4"
                    id="createNewCompany">{{ __('messages.create') }}</button>
            </div>
        </div>

        <table class="table table-bordered table-hover table-stripe table-compact" id="Taula">
            <thead class="">
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.NIF') }}</th>
                    <th>{{ __('messages.address') }}</th>
                    <th>{{ __('messages.logo') }}</th>
                    <th>{{ __('messages.color') }}</th>
                    <th>{{ __('messages.description') }}</th>
                    <th>{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tfoot class="">
                <tr>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.NIF') }}</th>
                    <th>{{ __('messages.address') }}</th>
                    <th>{{ __('messages.logo') }}</th>
                    <th>{{ __('messages.color') }}</th>
                    <th>{{ __('messages.description') }}</th>
                    <th>{{ __('messages.action') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="modelHeading" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modal más grande -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="companyForm" name="companyForm" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="company_id" id="company_id">
                        <input type="hidden" name="logo_hidden" id="logo_hidden">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="name" name="nom"
                                    placeholder="{{ __('messages.name') }}" value="" required>
                            </div>

                            <div class="col-md-6">
                                <label for="nif" class="form-label">{{ __('messages.NIF') }}</label>
                                <input type="text" class="form-control" id="nif" name="nif"
                                    placeholder="{{ __('messages.NIF') }}" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ubicacio" class="form-label">{{ __('messages.address') }}</label>
                                <input type="text" class="form-control" id="ubicacio" name="ubicacio"
                                    placeholder="{{ __('messages.address') }}" value="">
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
                                <textarea id="description" name="descripcio" class="form-control" placeholder="{{ __('messages.description') }}"
                                    rows="3"></textarea>
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

                var table = $('#Taula').DataTable({
                    searching: false,
                    filter: true,
                    processing: true,
                    serverSide: true,
                    pagingType: 'simple_numbers',
                    ajax: "{{ route('get.companies') }}",
                    columns: [{
                            data: 'nom',
                            name: 'nom'
                        },
                        {
                            data: 'nif',
                            name: 'nif'
                        },
                        {
                            data: 'ubicacio',
                            name: 'ubicacio'
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
                            data: 'descripcio',
                            name: 'descripcio'
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
                    },
                    columnDefs: [{
                        targets: [0, -1],
                        className: 'dt-body-center'
                    }]
                });

                $('#Taula thead tr').clone(true).prependTo('#Taula thead');
                $('#Taula thead tr:eq(0) th').each(function(i) {
                    var title = $(this).text();
                    if (title != "action") {
                        $(this).html('<input class="input-search" type="text" placeholder=" " />');
                    } else {
                        $(this).html('<p><p/>');
                    }

                    $('input', this).on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table.column(i).search(this.value).draw();
                        }
                    });
                });

                $('#createNewCompany').click(function() {
                    $('#saveBtn').val("create-company");
                    $('#company_id').val('');
                    $('#companyForm').trigger("reset");
                    $('#modelHeading').html("{{ __('messages.create_company') }}");
                    $('#ajaxModal').modal('show');
                });

                $('body').on('click', '.edit', function() {
                    var company_id = $(this).data('id');
                    $.get("{{ route('companies.index') }}" + '/' + company_id + '/edit', function(data) {
                        $('#modelHeading').html("{{ __('messages.edit_company') }}");
                        $('#saveBtn').val("edit-company");
                        $('#ajaxModal').modal('show');
                        $('#company_id').val(data.id);
                        $('#name').val(data.nom);
                        $('#nif').val(data.nif);
                        $('#ubicacio').val(data.ubicacio);
                        $('#description').val(data.descripcio);
                        $('#color').val(data.color);
                        $('#logo_hidden').val(data.logo); // Cargar el logo existente
                    });
                });

                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('{{ __('messages.sending') }}..');

                    var formData = new FormData($('#companyForm')[0]); // Usar FormData para incluir archivos

                    $.ajax({
                        data: formData,
                        url: "{{ route('companies.store') }}",
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#companyForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.draw();
                            $('#saveBtn').html('{{ __('messages.save_changes') }}');
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('{{ __('messages.save_changes') }}');
                        }
                    });
                });

                $('body').on('click', '.delete', function() {
                    var company_id = $(this).data("id");
                    if (confirm("{{ __('messages.delete_confirmation') }}")) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('companies.store') }}" + '/' + company_id,
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
