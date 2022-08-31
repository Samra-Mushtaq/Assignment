
@php
    $isEdit = isset($product) ? true : false;
    $url = $isEdit ? route('products.update', $product->id) : route('products.store');
@endphp
<form action="{{ $url }}"  data-form="ajax-form" method="post" data-modal="#ajax_general_model" data-datatable="#products-table"  enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <div class="modal-body">
        <div class="form-group">
            <label class="form-label" for="en_name"> Name (en)</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control input" name="en_name" id="en_name" value="{{ $isEdit ? $product->en_name : '' }}" required>
                <span class="text-danger" id="en_name_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="ar_name"> Name (ar)</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control input" name="ar_name" id="ar_name" value="{{ $isEdit ? $product->ar_name : '' }}" required>
                <span class="text-danger" id="ar_name_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="category"> Category</label>
            <div class="form-control-wrap">
                <select class="form-select form-select-solid input" name="category" id="category" required>
                    <option value="0" selected disabled>Select Category</option>
                    @foreach ($categories as $key => $category)
                        <option value="{{$category->id}}" @if($isEdit && $product->category->id == $category->id) selected @endif >{{$category->en_name}} | {{$category->ar_name}}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="category_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="en_description">Description (en)</label>
            <div class="form-control-wrap">
                <textarea class="form-control input"  name="en_description"  id="en_description" required>{{ $isEdit ? $product->en_description : '' }}</textarea>
                <span class="text-danger" id="en_description_error"></span>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label" for="ar_description">Description (ar)</label>
            <div class="form-control-wrap">
                <textarea class="form-control input"  name="ar_description"  id="ar_description" required>{{ $isEdit ? $product->ar_description : '' }}</textarea>
                <span class="text-danger" id="ar_description_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="price">Price</label>
            <div class="form-control-wrap">
                <input type="number" class="form-control input" name="price"  id="price"  value="{{ $isEdit ? $product->price : '' }}" required>
                <span class="text-danger" id="price_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <div class="form-control-wrap">
                <select class="form-select form-select-solid input" name="status" id="status" >
                    <option value="0" selected disabled>Select Status</option>
                    <option value="Active" @if($isEdit && $product->status == "Active") selected @endif>Active</option>
                    <option value="Pending" @if($isEdit && $product->status == "Pending") selected @endif>Pending</option>
                </select>
                <span class="text-danger" id="status_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="image">Image</label>
            <div class="form-control-wrap">
                <input type="file" id="image"  name="image" class="form-control">
            </div>
        </div>   
        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-button="submit">Submit</button>
        </div>
    </div>
</form>