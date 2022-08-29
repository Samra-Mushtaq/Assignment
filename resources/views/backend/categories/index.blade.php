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
                                <a class="btn btn-success ml-4" id="create_category"> Create New Category</a>
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
                            <table class="datatable-init table data-table">
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
                                    @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $category->en_name }}</td>
                                        <td>{{ $category->ar_name }}</td>
                                        <td>{{ $category->en_detail }}</td>
                                        <td>{{ $category->ar_detail }}</td>
                                        <td>
                                        @can('category-edit')
                                            <a class="btn btn-primary" onclick="edit_category('{{$category->id}}')">Edit</a>
                                        @endcan
                                        @can('category-delete')   
                                            <a class="btn btn-danger" onclick="delete_category('{{$category->id}}')">Delete</a>
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


<div class="modal fade" id="category_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Info</h5>
                <a onclick="close_model()" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <input type="hidden" class="form-control" id="edit_id" required>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="en_name"> Name (en)</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="en_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="ar_name"> Name (ar)</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" id="ar_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="en_detail">Detail (en)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control" id="en_detail"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="ar_detail">Detail (ar)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control" id="ar_detail"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" id="save_button" onclick="category_information(0)" class="btn btn-lg btn-primary hidden">Save Informations</button>
                    <button type="button" id="update_button" onclick="category_information(1)" class="btn btn-lg btn-primary hidden">Update Informations</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="message_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a onclick="close_msg_model()" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Category Info</h5>
            </div>
            <div class="modal-body">
                <p id="msg"></p>
            </div>
            <div class="modal-footer bg-light">
                
            </div>
        </div>
    </div>
</div>

{!! $categories->render() !!}
<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).on("click", "#create_category", function(event) { 
        $("#en_name").val("");
        $("#en_detail").val("");
        $("#ar_name").val("");
        $("#ar_detail").val("");
        $("#edit_id").val("");
        $("#save_button").removeClass("hidden");
        $("#update_button").addClass("hidden");
        $("#category_model").modal('show');
    });
    function category_information(value){
        err_res = 0;
        var en_name = $("#en_name").val();
        var en_detail = $("#en_detail").val();
        var ar_name = $("#ar_name").val();
        var ar_detail = $("#ar_detail").val();
        if (en_name == '' || en_name == null) {
            $('#en_name').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#en_name').css("border-color", "#dfdfdf");
        }
        if (ar_name == '' || ar_name == null) {
            $('#ar_name').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#ar_name').css("border-color", "#dfdfdf");
        }
        if (en_detail == '' || en_detail == null) {
            $('#en_detail').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#en_detail').css("border-color", "#dfdfdf");
        }
        if (ar_detail == '' || ar_detail == null) {
            $('#ar_detail').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#ar_detail').css("border-color", "#dfdfdf");
        }
        if(err_res == 0){
            if(value == 0){
                ajax_url = APP_URL + "/categories";
                ajax_type = "POST";
            }else{
                id = $("#edit_id").val();
                ajax_url = APP_URL + "/categories/"+id;
                ajax_type = "GET";
            }
            jQuery.ajax({
                type: ajax_type,
                url: ajax_url,
                data: {
                     en_name : en_name, en_detail : en_detail,  ar_name : ar_name, ar_detail : ar_detail
                },
                success: function (response) {
                    
                     $("#category_model").modal('hide');
                    if(value == 0){
                        // $("#msg").html("Category Successfully Created");
                        // $("#message_model").modal('show');
                        swal("Category Alert", "Category Successfully Created", "success").then((value) => {
                            location.reload();
                        });
                    }else{
                        // $("#msg").html("Category Successfully Updated");
                        // $("#message_model").modal('show');
                        swal("Category Alert", "Category Successfully Updated", "success").then((value) => {
                            location.reload();
                        });
                    }
                  
                },
                error: function (response) {
                    // $('#email').css("border-color", "red");
                    // $("#msg").html("Something Went wrong");
                    // $("#message_model").modal('show');
                    swal("Category Alert", "Something Went Wrong", "error").then((value) => {
                        location.reload();
                    });
                }
            });    
        }
        
    }
    function close_model(){
        $("#en_name").val("");
        $("#en_detail").val("");
        $("#ar_name").val("");
        $("#ar_detail").val("");
        $("#edit_id").val("");
        $("#category_model").modal('hide');
    }
    function close_msg_model(){
        location.reload();
        $("#message_model").modal('hide');
    }
    function edit_category(id){
        jQuery.ajax({
            type: "GET",
            url: APP_URL + "/categories/"+id+"/edit",
            data: {
            },
            success: function (response) {
                
                $("#en_name").val(response.en_name);
                $("#en_detail").val(response.en_detail);
                $("#ar_name").val(response.ar_name);
                $("#ar_detail").val(response.ar_detail);

                $("#edit_id").val(response.id);
                $("#category_model").modal('show');
                $("#save_button").addClass("hidden");
                $("#update_button").removeClass("hidden");
                
            },
            error: function (response) {
            }
        });     
    }
    function delete_category(id){
        jQuery.ajax({
            type: "DELETE",
            url: APP_URL + "/categories/"+id,
            data: {
            },
            success: function (response) {
                
                $("#msg").html("Category Successfully Deleted");
                $("#message_model").modal('show');
                
            },
            error: function (response) {
            }
        });     
    }
   
</script>

@endsection