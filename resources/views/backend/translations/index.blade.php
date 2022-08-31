@extends('layouts.backend.datatable_app')

@section('content')
<div class="nk-content p-0">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Translations
                            @can('translation-create')
                                <button type="button" class="btn btn-success ml-4" data-act="ajax-modal" data-method="get" data-action-url="{{ route('translations.create') }}" data-title="Create New Translation">Create New Translation</button>
                            @endcan
                            </h4>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table data-table" id="translations-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>English Title</th>
                                        <th>Arabic Title</th>
                                        <th>English Description</th>
                                        <th>Arabic Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(function () {
        var table = $('#translations-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            scrollX: false,
            columnDefs: [
                { width: '5%', targets: 0 }
            ],
            ajax:  '{{ route("translations-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'title_en', name: 'title_en'},
                {data: 'title_ar', name: 'title_ar'},
                {data: 'description_en', name: 'description_en'},
                {data: 'description_ar', name: 'description_ar'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
        
    }); 
</script>

@endsection