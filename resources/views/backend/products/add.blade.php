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
                            <form action="{{ route('products.store') }}"  data-form="ajax-form" method="post" data-modal="#ajax_general_model" data-datatable="#products-table"  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="en_name"> Name (en)</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control input" name="en_name" id="en_name"  required>
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
                                                <option value="0" selected disabled>Select Category</option>
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
    $("#image-dropzone").dropzone({
        url: "hn_SimpeFileUploader.ashx",
        addRemoveLinks: true,
        success: function (file, response) {
            var imgName = response;
            file.previewElement.classList.add("dz-success");
            console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });
    $("#select_category").select2();
    $("#status").select2();
   
</script>

@endsection
