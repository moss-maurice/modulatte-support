<!-- modulatte.partials.builder.form.fields.inputUploadFile -->
@php
    $required = (isset($required) ? $required : false);
    $width = (isset($width) ? intval($width) : 300);
    $height = (isset($height) ? intval($height) : 300);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $for = "for" . ucfirst($name);
@endphp

@if ($value)
    <img src="{{Storage::disk('showplaces')->url($value)}}" alt="" style="max-width: {{ $width }}px; max-height: {{ $height }}px;" />
    <br />
    <label for="{{ $for }}">Удалить это фото</label>
    <input type="checkbox" value="1" name="deletePhoto" id="{{ $for }}" />
    <hr />
@endif

<input type="file" id="avatar" name="{{$name}}" accept="image/png, image/jpeg" />

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputUploadFile -->
