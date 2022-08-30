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
                                    <a class="btn btn-success ml-4" id="create_product"> Create New Product</a>
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
                                        <th>No</th>
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
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <span class="tb-product">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="thumb">
                                            </span>
                                        {{ $product->en_name }}</td>
                                        <td>{{ $product->ar_name }}</td>
                                        <td>{{ $product->en_description }}</td>
                                        <td>{{ $product->ar_description }}</td>
                                        <td>{{ $product->category->en_name }} | {{ $product->category->ar_name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @can('product-edit')
                                            <a class="btn btn-primary mb-2" onclick="edit_product('{{$product->id}}')">Edit</a>
                                            @endcan
                                            @can('product-delete') 
                                            <a class="btn btn-danger mb-2" onclick="delete_product('{{$product->id}}')">Delete</a>
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



<div class="modal fade" id="product_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="form_data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Products Info</h5>
                    <a onclick="close_model()" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <input type="hidden" class="form-control" name="id" id="edit_id" required>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="en_name"> Name (en)</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="en_name" id="en_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="ar_name"> Name (ar)</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="ar_name" id="ar_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category"> Category</label>
                        <div class="form-control-wrap">
                            <select class="form-select form-select-solid" name="category" id="category">
                                <option value="0" selected disabled>Select Category</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{$category->id}}">{{$category->en_name}} | {{$category->ar_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="en_description">Description (en)</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control"  name="en_description"  id="en_description"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="ar_description">Description (ar)</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control"  name="ar_description"  id="ar_description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Price</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="price"  id="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status">Status</label>
                        <div class="form-control-wrap">
                            <select class="form-select form-select-solid" name="status" id="status">
                                <option value="0" selected disabled>Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="image">Image</label>
                        <div class="form-control-wrap">
                            <input type="file" id="image"  name="image" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group">
                        <button id="save_button"  class="btn btn-lg btn-primary hidden">Save Informations</button>
                        <button id="update_button"  class="btn btn-lg btn-primary hidden">Update Informations</button>
                    </div>
                </div>
            </form>
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
                <h5 class="modal-title">Product Info</h5>
            </div>
            <div class="modal-body">
                <p id="msg"></p>
            </div>
            <div class="modal-footer bg-light">
                
            </div>
        </div>
    </div>
</div>


{!! $products->render() !!}

<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    jQuery(document).ready(function () {
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).on("click", "#create_product", function(event) { 
        $("#en_name").val("");
        $("#en_description").val("");
        $("#ar_name").val("");
        $("#ar_description").val("");
        $("#status").val("");
        $("#category").val("");
        $("#price").val("");
        $("#edit_id").val("");
        $("#save_button").removeClass("hidden");
        $("#update_button").addClass("hidden");
        $("#product_model").modal('show');
    });
    $('#form_data').on('submit',(function(e) {
        err_res = 0;
        var en_name = $("#en_name").val();
        var en_description = $("#en_description").val();
        var ar_name = $("#ar_name").val();
        var ar_description = $("#ar_description").val();
        var status = $("#status").val();
        var category = $("#category").val();
        var price = $("#price").val();

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
        if (en_description == '' || en_description == null) {
            $('#en_description').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#en_description').css("border-color", "#dfdfdf");
        }
        if (ar_description == '' || ar_description == null) {
            $('#ar_description').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#ar_description').css("border-color", "#dfdfdf");
        }
        if (status == '' || status == null) {
            $('#status').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#status').css("border-color", "#dfdfdf");
        }
        if (category == '' || category == null) {
            $('#category').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#category').css("border-color", "#dfdfdf");
        }
       if (price == '' || price == null) {
            $('#price').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#price').css("border-color", "#dfdfdf");
        }
        
        if(err_res == 0){
            event.preventDefault();
            id = $("#edit_id").val();
            $("#form_data").append('<input type="hidden" class="put_field" name="_method" value="PUT">');
            if(id == ""){
                ajax_url = APP_URL + "/products";
                ajax_type = "POST";
                $(".put_field").remove();
            }else{
                ajax_url = APP_URL + "/products/"+id;
                ajax_type = "POST";
            }
            var formData = new FormData(this);
            $.ajax({
                url: ajax_url,
                method:ajax_type,
                data:formData,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    $("#product_model").modal('hide');
                    if(id == ""){
                        // $("#msg").html("Product Successfully Created");
                        // $("#message_model").modal('show');
                        swal("Product Alert", "Product Successfully Created", "success").then((value) => {
                            location.reload();
                        });
                    }else{
                        // $("#msg").html("Product Successfully Updated");
                        // $("#message_model").modal('show');
                        swal("Product Alert", "Product Successfully Updated", "success").then((value) => {
                            location.reload();
                        });
                    }
                },
                error: function(data)
                {
                    // swal("Product Alert", "Something Went Wrong", "error").then((value) => {
                    //     location.reload();
                    // });
                    // console.log(data);
                    // $("#msg").html("Something Went wrong");
                    // $("#message_model").modal('show');
                }
            });
            // $("#product_model").modal('hide');
        }
    }));
   
    function close_model(){
        $("#product_model").modal('hide');
    }
    function close_msg_model(){
        location.reload();
        $("#message_model").modal('hide');
    }
    function edit_product(id){
        jQuery.ajax({
            type: "GET",
            url: APP_URL + "/products/"+id+"/edit",
            data: {
            },
            success: function (response) {
                
                $("#en_name").val(response.en_name);
                $("#en_description").val(response.en_description);   
                
                $("#ar_name").val(response.ar_name);
                $("#ar_description").val(response.ar_description);   

 		        $("#status").val(response.status);
                $("#category").val(response.category.id);
                $("#price").val(response.price);
                $("#edit_id").val(response.id);
                $("#product_model").modal('show');
                $("#save_button").addClass("hidden");
                $("#update_button").removeClass("hidden");
                
            },
            error: function (response) {
            }
        });     
    }
    function delete_product(id){
        jQuery.ajax({
            type: "DELETE",
            url: APP_URL + "/products/"+id,
            data: {
            },
            success: function (response) {
                
                $("#msg").html("Product Successfully Deleted");
                $("#message_model").modal('show');
                
            },
            error: function (response) {
            }
        });     
    }
   
</script>

@endsection
