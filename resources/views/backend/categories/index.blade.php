@extends('layouts.backend.datatable_app')

@section('content')
<div class="nk-content p-0">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Category
                            @can('category-create')
                                <!-- <a class="btn btn-success ml-4" id="create_category"> Create New Category</a> -->
                                <button type="button" class="btn btn-success ml-4" data-act="ajax-modal"
                                    data-method="get" data-action-url="{{ route('categories.create') }}" data-title="Create New Category">Create New Category</button>
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
                            <table class="datatable-init table data-table" id="categories-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name (en)</th>
                                        <th>Name (ar)</th>
                                        <th>Detail (en)</th>
                                        <th>Detail (ar)</th>
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
        var table = $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            scrollX: false,
            columnDefs: [
                { width: '5%', targets: 0 }
            ],
            ajax:  '{{ route("categories-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'en_name', name: 'en_name'},
                {data: 'ar_name', name: 'ar_name'},
                {data: 'en_detail', name: 'en_detail'},
                {data: 'ar_detail', name: 'ar_detail'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
        
    });
   
</script>

@endsection