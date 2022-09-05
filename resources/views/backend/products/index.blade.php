@extends('layouts.backend.datatable_app')

@section('content')
<div class="nk-content p-0">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">
                                Products
                                @can('product-create')
                                    <a class="btn btn-success ml-4" href="{{ route('products.create') }}"> Create New Product</a>
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
                            <table class="datatable-init table data-table" id="products-table">
                                <thead>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Name (en)</th>
                                        <th>Name (ar)</th>
                                        <th>Description (en)</th>
                                        <th>Description (ar)</th>
                                        <th>Category</th>
                                        <th>price</th>
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
        var table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            scrollX: false,
            columnDefs: [
                { width: '5%', targets: 0 }
            ],
            ajax:  '{{ route("products-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'en_name', name: 'en_name'},
                {data: 'ar_name', name: 'ar_name'},
                {data: 'en_description', name: 'en_description'},
                {data: 'ar_description', name: 'ar_description'},
                {data: 'category', name: 'category'},
                {data: 'price', name: 'price'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });
        
    });
</script>

@endsection
