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
                            <a class="btn btn-success ml-4" id="create_translation"> Create New Translation</a>
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
                                        <th>Arabic Title</th>
                                        <th>Arabic Description</th>
                                        <th>English Title</th>
                                        <th>English Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($translations as $key => $translation)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        @foreach ($translation->text as $key => $data)
                                            <td>{{ $data }}</td>
                                        @endforeach
                                        <td>
                                            <a class="btn btn-primary mb-2" onclick="edit_translation('{{$translation->id}}')">Edit</a>
                                            <a class="btn btn-danger mb-2" onclick="delete_translation('{{$translation->id}}')">Delete</a>
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


<div class="modal fade" id="translation_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Translations Info</h5>
                <a onclick="close_model()" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <input type="hidden" class="form-control" id="edit_id" required>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="title_en">English Title</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="title_en" id="title_en" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description_en">English Description</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control"  name="description_en"  id="description_en"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="title_ar">Arabic Title</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control" name="title_ar" id="title_ar" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description_ar">Arabic Description</label>
                    <div class="form-control-wrap">
                        <textarea class="form-control"  name="description_ar"  id="description_ar"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" id="save_button" onclick="translation_information(0)" class="btn btn-lg btn-primary hidden">Save Informations</button>
                    <button type="button" id="update_button" onclick="translation_information(1)" class="btn btn-lg btn-primary hidden">Update Informations</button>
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
                <h5 class="modal-title">Translations Info</h5>
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
    $(document).on("click", "#create_translation", function(event) { 
        $("#user").val("");
        $("#title_en").val("");
        $("#title_ar").val("");
        $("#edit_id").val("");
        $("#description_en").val("");
        $("#description_ar").val("");
        $("#save_button").removeClass("hidden");
        $("#update_button").addClass("hidden");
        $("#translation_model").modal('show');
    });
    function translation_information(value){
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
                ajax_url = APP_URL + "/translations";
                ajax_type = "POST";
            }else{
                id = $("#edit_id").val();
                ajax_url = APP_URL + "/translations/"+id;
                ajax_type = "GET";
            }
            jQuery.ajax({
                type: ajax_type,
                url: ajax_url,
                data: {
                      description_en : description_en, description_ar: description_ar, title_en : title_en, title_ar: title_ar,
                },
                success: function (response) {
                    
                    $("#translation_model").modal('hide');
                    if(value == 0){
                        swal("Translation Alert", "Translation Successfully Created", "success").then((value) => {
                            location.reload();
                        });
                    }else{
                        swal("Translation Alert", "Translation Successfully Updated", "success").then((value) => {
                            location.reload();
                        });
                    }
                  
                },
                error: function (response) {
                    swal("Translation Alert", "Something Wents Wrong", "error").then((value) => {
                        // location.reload();
                    });
                }
            });     
            $("#user").val("");
            $("#title_en").val("");
            $("#title_ar").val("");
            $("#edit_id").val("");
            $("#description_en").val("");
            $("#description_ar").val("");
        }
        
    }
    function close_model(){

        $("#user").val("");
        $("#title_en").val("");
        $("#title_ar").val("");
        $("#description_en").val("");
        $("#description_ar").val("");
        $("#translation_model").modal('hide');
    }
    function close_msg_model(){
        location.reload();
        $("#message_model").modal('hide');
    }
    function edit_translation(id){
        jQuery.ajax({
            type: "GET",
            url: APP_URL + "/translations/"+id+"/edit",
            data: {
            },
            success: function (response) {
                $("#title_en").val(response.text.title_en);
                $("#title_ar").val(response.text.title_ar);
                $("#edit_id").val(response.id);
                $("#description_en").val(response.text.description_en);
                $("#description_ar").val(response.text.description_ar);
                $("#translation_model").modal('show');
                $("#save_button").addClass("hidden");
                $("#update_button").removeClass("hidden");
                
            },
            error: function (response) {
            }
        });     
    }
    function delete_translation(id){
        jQuery.ajax({
            type: "DELETE",
            url: APP_URL + "/translations/"+id,
            data: {
            },
            success: function (response) {
                
                $("#msg").html("Traslation Successfully Deleted");
                $("#message_model").modal('show');
                
            },
            error: function (response) {
            }
        });     
    }
   
</script>

@endsection