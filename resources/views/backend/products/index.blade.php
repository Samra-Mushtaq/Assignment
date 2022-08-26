@extends('layouts.backend.datatable_app')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Products List</h4>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="pull-right pb-3">
                        <a class="btn btn-success" id="create_product"> Create New Product</a>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>price</th>
                                        <th>Language</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="tb-product">
                                                            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="thumb">
                                                        </span>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->language }}</td>
                                        <td>
                                            <a class="btn btn-primary" onclick="edit_product('{{$product->id}}')">Edit</a>
                                            <a class="btn btn-danger" onclick="delete_product('{{$product->id}}')">Delete</a>
                                        
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
                        <label class="form-label" for="name"> Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="category"> Category</label>
                        <div class="form-control-wrap">
                            <select class="form-select form-select-solid" name="category" id="category">
                                <option value="0" selected disabled>Select Category</option>
                                @foreach ($categories as $key => $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="language">Language</label>
                        <div class="form-control-wrap">
                            <select class="form-select form-select-solid" name="language" id="language">
                                <option value="0" selected disabled>Select Language</option>
                                <option value="English">English</option>
                                <option value="Arabic">Arabic</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Price</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="price"  id="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description">Description</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control"  name="description"  id="description"></textarea>
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
      
        $("#save_button").removeClass("hidden");
        $("#update_button").addClass("hidden");
        $("#product_model").modal('show');
    });
    $('#form_data').on('submit',(function(e) {
        err_res = 0;
        var name = $("#name").val();
        var description = $("#description").val();
        var language = $("#language").val();
        var category = $("#category").val();
        var price = $("#price").val();

        if (name == '' || name == null) {
            $('#name').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#name').css("border-color", "#dfdfdf");
        }
        if (language == '' || language == null) {
            $('#language').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#language').css("border-color", "#dfdfdf");
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
        if (description == '' || description == null) {
            $('#description').css("border-color", "red");
            err_res = 1;
        }
        else{
            $('#description').css("border-color", "#dfdfdf");
        }
        if(err_res == 0){
            event.preventDefault();
            var formData = new FormData(this);
            id = $("#edit_id").val();
            if(id == ""){
                ajax_url = APP_URL + "/products";
                ajax_type = "POST";
            }else{
                ajax_url = APP_URL + "/products_update";
                ajax_type = "POST";
            }
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
                    if(id == ""){
                        $("#msg").html("Product Successfully Created");
                        $("#message_model").modal('show');
                    }else{
                        $("#msg").html("Product Successfully Updated");
                        $("#message_model").modal('show');
                    }
                },
                error: function(data)
                {
                    $("#msg").html("Something Went wrong");
                    $("#message_model").modal('show');
                }
            });
            $("#name").val("");
            $("#description").val("");
  		    $("#language").val("");
            $("#category").val("");
            $("#price").val("");
            $("#edit_id").val("");
            $("#product_model").modal('hide');
        }
    }));
   
    function close_model(){
        $("#name").val("");
        $("#description").val("");
        $("#language").val("");
        $("#category").val("");
        $("#price").val("");
        $("#edit_id").val("");
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
                
                $("#name").val(response.name);
                $("#description").val(response.description);               
 		        $("#language").val(response.language);
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
