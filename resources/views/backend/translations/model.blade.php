@php
    $isEdit = isset($translation) ? true : false;
    $url = $isEdit ? route('translations.update', $translation->id) : route('translations.store');
@endphp
<form action="{{ $url }}"  data-form="ajax-form" method="post" data-modal="#ajax_general_model" data-datatable="#translations-table">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <div class="form-group">
        <label class="form-label" for="title_en">Title (en)</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control input" name="title_en" id="title_en" value="{{ $isEdit ? $translation->text['title_en'] : '' }}" required>
            <span class="text-danger" id="title_en_error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="title_ar">Title (ar)</label>
        <div class="form-control-wrap">
            <input type="text" class="form-control input" name="title_ar" id="title_ar" value="{{ $isEdit ? $translation->text['title_ar'] : '' }}" required>
            <span class="text-danger" id="title_ar_error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="description_en"> Description (en)</label>
        <div class="form-control-wrap">
            <textarea class="form-control input"  name="description_en"  id="description_en" required>{{ $isEdit ? $translation->text['description_en'] : '' }}</textarea>
            <span class="text-danger" id="description_en_error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="description_ar"> Description (ar)</label>
        <div class="form-control-wrap">
            <textarea class="form-control input"  name="description_ar"  id="description_ar" required>{{ $isEdit ? $translation->text['description_ar'] : '' }}</textarea>
            <span class="text-danger" id="description_ar_error"></span>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" data-button="submit">Submit</button>
    </div>
</form>