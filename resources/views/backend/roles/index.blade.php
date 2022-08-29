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
                                Roles
                                @can('role-create')
                                <a class="btn btn-success ml-4" href="{{ route('roles.create') }}"> Create New Role</a>
                                @endcan
                                @if ($message = Session::get('success'))
                                <div aria-live="polite" aria-atomic="true" style="position: relative;bottom: 3rem;">
                                    <div class="toast" style="position: absolute; top: 0; right: 0;">
                                        <div class="toast-body">
                                        {{ $message }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </h4>
                        </div>
                    </div>
                 
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$key}}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @can('role-edit')
                                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                            @endcan
                                            @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
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
$(document).ready(function(){
  $('.toast').toast('show');
});
</script>

@endsection