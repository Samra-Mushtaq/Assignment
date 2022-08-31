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
                                Notifications
                                @can('notification-create')
                                    <button type="button" class="btn btn-success ml-4" data-act="ajax-modal" data-method="get" data-action-url="{{ route('notifications.create') }}" data-title="Create New Notification">Create New Notification</button>
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
                            <table class="datatable-init table data-table" id="notifications-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title (en)</th>
                                        <th>Title (ar)</th>
                                        <th>Description (en)</th>
                                        <th>Description (ar)</th>
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
        var table = $('#notifications-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            scrollX: false,
            columnDefs: [
                { width: '5%', targets: 0 }
            ],
            ajax:  '{{ route("notifications-datatable") }}',
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