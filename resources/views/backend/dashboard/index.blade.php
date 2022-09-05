@extends('layouts.backend.index_app')

@section('content')
<style>
    .col-sm-12 {
        display: contents;
    }
</style>
<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">
                            Dashboard
                        </h4>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-2"></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="col" id='calendar'></div>
                                    </div><!-- .nk-ecwg -->
                                </div><!-- .card -->
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title mb-2">
                                                    <h4 class="title">Users</h4>
                                                </div>
                                            </div>
                                            <div class="card-inner p-1" style="display: contents !important;">
                                                <table class="datatable-init table data-table" id="user-table" style="display: grid !important;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone No</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- .nk-ecwg -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Products</h6>
                                                </div>
                                            </div>
                                            <div class="card-inner p-1" style="display: contents !important;">
                                                <table class="datatable-init table data-table" id="product-table" style="display: grid !important;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Name</th>
                                                            <th>Category</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- .nk-ecwg -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
     $(function () {
        datatable(0, 0); 
    });
    function datatable(val_type, start){
        if(val_type == 1){
            $('#user-table').DataTable().destroy();
            $('#product-table').DataTable().destroy();
        }

        $('#user-table').DataTable({
            processing: true,
            serverSide: false,
            autoWidth: true,
            scrollX: false,
            columnDefs: [
                { width: '5%', targets: 0 }
            ],
            "ajax": {
                "url": '{{ route("user-calendar-data") }}',
                "data": {
                    start: start,
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_no', name: 'phone_no', orderable: false, searchable: false},
            ]
        });

        var table = $('#product-table').DataTable({
            processing: true,
            serverSide: false,
            autoWidth: true,
            scrollX: false,
            columnDefs: [
                { width: '5%', targets: 0 }
            ],
            "ajax": {
                "url": '{{ route("product-calendar-data") }}',
                "data": {
                    start: start,
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'en_name', name: 'en_name'},
                {data: 'category', name: 'category'},
                {data: 'en_description', name: 'en_description', orderable: false, searchable: false},
            ]
        });
        
        if(val_type == 1){
            toastr.options.positionClass = "toast-top-center";
            toastr.success("Data has been fetched");
        }
    }
    $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            displayEventTime: false,
            editable: true,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                datatable(1, start); 
            }

        });
    
    });
  
</script>
@endsection