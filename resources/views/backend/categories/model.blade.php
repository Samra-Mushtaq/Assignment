@php
    $isEdit = isset($category) ? true : false;
    $url = $isEdit ? route('categories.update', $category->id) : route('categories.store');
@endphp
<form action="{{ $url }}" data-form="ajax-form" method="post" data-modal="#ajax_general_model" data-datatable="#categories-table">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <div class="modal-body">
        <div class="form-group">
            <label class="form-label" for="en_name"> Name (en)</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control input" id="en_name"  name="en_name" value="{{ $isEdit ? $category->en_name : '' }}"  required>
                <span class="text-danger" id="en_name_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="ar_name"> Name (ar)</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control input" id="ar_name" name="ar_name" value="{{ $isEdit ? $category->ar_name : '' }}"  required>
                <span class="text-danger" id="ar_name_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="en_detail">Detail (en)</label>
            <div class="form-control-wrap">
                <textarea class="form-control input" id="en_detail" name="en_detail" required>{{ $isEdit ? $category->en_detail : '' }}</textarea>
                <span class="text-danger" id="en_detail_error"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="ar_detail">Detail (ar)</label>
            <div class="form-control-wrap">
                <textarea class="form-control input" id="ar_detail"  name="ar_detail" required>{{ $isEdit ? $category->ar_detail : '' }}</textarea>
                <span class="text-danger" id="ar_detail_error"></span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-button="submit">Submit</button>
        </div>
    </div>
</form>