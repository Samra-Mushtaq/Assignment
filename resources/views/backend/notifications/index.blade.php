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
                                @can('product-create')
                                <a class="btn btn-success ml-4" id="create_notification"> Create New Notification</a>
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
                                        <th>Title (en)</th>
                                        <th>Title (ar)</th>
                                        <th>Description (en)</th>
                                        <th>Description (ar)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->notifications as $key => $notification)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        @foreach ($notification->data as $key => $data)
                                            <td>{{ $data }}</td>
                                        @endforeach
                                        <td>
                                            <a class="btn btn-primary mb-2" onclick="edit_notification('{{$notification->id}}')">Edit</a>
                                            <a class="btn btn-danger mb-2" onclick="delete_notification('{{$notification->id}}')">Delete</a>
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

<div class="modal fade" id="notification_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification Info</h5>
                <a onclick="close_model()" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <input type="hidden" class="form-control" id="edit_id" required>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="title_en">Title (en)</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="title_en" id="title_en" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="title_ar"> Title (ar)</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="title_ar" id="title_ar" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description_en">Description (en)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control"  name="description_en"  id="description_en"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="description_ar"> Description (ar)</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control"  name="description_ar"  id="description_ar"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" id="save_button" onclick="notification_information(0)" class="btn btn-lg btn-primary hidden">Save Informations</button>
                    <button type="button" id="update_button" onclick="notification_information(1)" class="btn btn-lg btn-primary hidden">Update Informations</button>
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
                <h5 class="modal-title">Notification Info</h5>
            </div>
            <div class="modal-body">
                <p id="msg"></p>
            </div>
            <div class="modal-footer bg-light">
                
            </div>
        </div>
    </div>
</div>

<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).on("click", "#create_notification", function(event) { 
        $("#user").val("");
        $("#title_en").val("");
        $("#title_ar").val("");
        $("#edit_id").val("");
        $("#description_en").val("");
        $("#description_ar").val("");
        $("#save_button").removeClass("hidden");
        $("#update_button").addClass("hidden");
        $("#notification_model").modal('show');
    });
    function notification_information(value){
        err_res = 0;
        var title_en = $("#title_en").val();
        var title_ar = $("#title_ar").val();
        var description_en = $("#description_en").val();
        var description_ar = $("#description_ar").val();

       
        if ((title_ar == '' || title_ar == null) && (title_en == '' || title_en == null)) {
            err_res = 1;
            if(title_ar == '' || title_ar == null){
                $('#title_ar').css("border-color", "red");
            }else{
                $('#title_en').css("border-color", "red");
            }
        }
        else{
            $('#title_en').css("border-color", "#dfdfdf");
            $('#title_ar').css("border-color", "#dfdfdf");
        }
        if ((description_ar == '' || description_ar == null) && (description_en == '' || description_en == null)) {
            err_res = 1;
            if(description_ar == '' || description_ar == null){
                $('#description_ar').css("border-color", "red");
            }else{
                $('#description_en').css("border-color", "red");
            }
        }
        else{
            $('#description_en').css("border-color", "#dfdfdf");
            $('#description_ar').css("border-color", "#dfdfdf");
        }
        if(err_res == 0){
            if(value == 0){
                ajax_url = APP_URL + "/notifications";
                ajax_type = "POST";
            }else{
                id = $("#edit_id").val();
                ajax_url = APP_URL + "/notifications/"+id;
                ajax_type = "GET";
            }
            jQuery.ajax({
                type: ajax_type,
                url: ajax_url,
                data: {
                      description_en : description_en, description_ar: description_ar, title_en : title_en, title_ar: title_ar,
                },
                success: function (response) {
                    $("#notification_model").modal('hide');
                    if(value == 0){
                        swal("Notification Alert", "Notification Successfully Added", "success").then((value) => {
                            location.reload();
                        });
                        // $("#msg").html("Notification Successfully Added");
                        // $("#message_model").modal('show');
                    }else{
                        swal("Notification Alert", "Notification Successfully Updated", "success").then((value) => {
                            location.reload();
                        });
                        // $("#msg").html("Notification Successfully Updated");
                        // $("#message_model").modal('show');
                    }
                  
                },
                error: function (response) {
                    $('#email').css("border-color", "red");
                    $("#msg").html("Something Went wrong");
                    $("#message_model").modal('show');
                }
            });     
        }
        
    }
    function close_model(){

        $("#user").val("");
        $("#title_en").val("");
        $("#title_ar").val("");
        $("#description_en").val("");
        $("#description_ar").val("");
        $("#notification_model").modal('hide');
    }
    function close_msg_model(){
        location.reload();
        $("#message_model").modal('hide');
    }
    function edit_notification(id){
        jQuery.ajax({
            type: "GET",
            url: APP_URL + "/notifications/"+id+"/edit",
            data: {
            },
            success: function (response) {
                $("#title_en").val(response.data.title_en);
                $("#title_ar").val(response.data.title_ar);
                $("#edit_id").val(response.id);
                $("#description_en").val(response.data.description_en);
                $("#description_ar").val(response.data.description_ar);
                $("#notification_model").modal('show');
                $("#save_button").addClass("hidden");
                $("#update_button").removeClass("hidden");
                
            },
            error: function (response) {
            }
        });     
    }
    function delete_notification(id){
        jQuery.ajax({
            type: "DELETE",
            url: APP_URL + "/notifications/"+id,
            data: {
            },
            success: function (response) {
                
                $("#msg").html("Notification Successfully Deleted");
                $("#message_model").modal('show');
                
            },
            error: function (response) {
            }
        });     
    }
   
</script>

@endsection