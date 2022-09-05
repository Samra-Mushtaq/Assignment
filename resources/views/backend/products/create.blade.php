@extends('layouts.backend.datatable_app')

@section('content')
<style>
    .wrapper {
    background: #39E2B6;
    height: 100%;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 9999;
    text-align: center;
    left: 0;
    font-size: 100px;
    font-family: calibri;
    color: white;
    line-height: 100vh;
}

.dropzone {
  margin: 1%;
  border: 2px dashed #3498db !important;
  border-radius: 5px;
}
</style>
<div class="nk-content p-0">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">
                                Products
                            </h4>
                        </div>
                    </div>

                    <div class="card card-preview">
                        <div class="card-inner">
                            <form action="{{ route('products.store') }}" name="product_form"  id="product_form" method="post"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id" value="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="en_name"> Name (en)</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control input" name="en_name" id="en_name" required >
                                            <span class="text-danger" id="en_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="ar_name"> Name (ar)</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control input" name="ar_name" id="ar_name" required>
                                            <span class="text-danger" id="ar_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="category"> Category</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select form-select-solid input "  name="categories[]" id="select_category" multiple="multiple" required>
                                                <option value="0" disabled>Select Category</option>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{$category->id}}" >{{$category->en_name}} | {{$category->ar_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="select_category_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="en_description">Description (en)</label>
                                        <div class="form-control-wrap">
                                            <textarea class="form-control input"  name="en_description"  id="en_description" required></textarea>
                                            <span class="text-danger" id="en_description_error"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="ar_description">Description (ar)</label>
                                        <div class="form-control-wrap">
                                            <textarea class="form-control input"  name="ar_description"  id="ar_description" required></textarea>
                                            <span class="text-danger" id="ar_description_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="price">Price</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control input" name="price"  id="price"  required>
                                            <span class="text-danger" id="price_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="lat">Lat</label>
                                        <div class="form-control-wrap">
                                            <input type="number" step="any" class="form-control input" name="lat"  id="lat"  required>
                                            <span class="text-danger" id="lat_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="long">Long</label>
                                        <div class="form-control-wrap">
                                            <input type="number" step="any" class="form-control input" name="long"  id="long"  required>
                                            <span class="text-danger" id="long_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="status">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select form-select-solid input" name="status" id="status" >
                                                <option value="0" selected disabled>Select Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Pending">Pending</option>
                                            </select>
                                            <span class="text-danger" id="status_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="image">Image</label>
                                        <div id="image-dropzone" name="image[]" class="dropzone">
                                            <div class="dz-default dz-message"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Dropzone.autoDiscover = false;
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function() {
        var myDropzone = new Dropzone("div #image-dropzone", { 
       
            paramName: "file",
            url: "{{ url('/storeimgae') }}",
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 5,
            maxFiles: 5,
            params: {
                _token: token
            },
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;
                //form submission code goes here
                $("form[name='product_form']").submit(function(event) {
                    //Make sure that the form isn't actully being sent.
                    event.preventDefault();

                    URL = $("#product_form").attr('action');
                    formData = $('#product_form').serialize();
                    $.ajax({
                        type: 'POST',
                        url: URL,
                        data: formData,
                        success: function(result){
                            if(result.status == "success"){
                                // fetch the useid 
                                var product_id = result.product_id;
                                $("#product_id").val(product_id); // inseting product_id into hidden input field
                                //process the queue
                                myDropzone.processQueue();
                            }else{
                                console.log("error");
                            }
                        },
                        error: function (error) {
                            $('#en_name_error').text(error.responseJSON.errors.en_name);
                            $('#ar_name_error').text(error.responseJSON.errors.ar_name);
                            $('#select_category_error').text(error.responseJSON.errors.categories);
                            $('#en_description_error').text(error.responseJSON.errors.en_description);
                            $('#ar_description_error').text(error.responseJSON.errors.ar_description);
                            $('#price_error').text(error.responseJSON.errors.price);
                            $('#status_error').text(error.responseJSON.errors.status);
                        }
                    });
                });

                this.on("removedfile", function (file) {
                    let product_id = document.getElementById('product_id').value;
                    $.post({
                        url: '/images-delete',
                        data: {product_id: product_id, filename: file.name, _token: $('[name="_token"]').val()},
                        dataType: 'json',
                        success: function (data) {
                            swal("Image Alert", "Image Successfully Removed", "success").then((value) => {
                            });
                        }
                    });
                });

                //Gets triggered when we submit the image.
                this.on('sending', function(file, xhr, formData){
                    // alert("");
                    //fetch the user id from hidden input field and send that product_id with our image
                    let product_id = document.getElementById('product_id').value;
                    formData.append('product_id', product_id);
                });
                
                this.on("success", function (file, response) {
                    $('#product_form')[0].reset();
                    swal("Product Alert", "Product Successfully Created", "success").then((value) => {
                        location.reload();
                    });
                });

                this.on("queuecomplete", function () {
                
                });
                
                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                // Gets triggered when the form is actually being sent.
                // Hide the success button or the complete form.
                });
                
                this.on("successmultiple", function(files, response) {
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
                });
                
                this.on("errormultiple", function(files, response) {
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
                });
            }
        });
    });
    
    $("#select_category").select2();
    $("#status").select2();
</script>
@endsection
