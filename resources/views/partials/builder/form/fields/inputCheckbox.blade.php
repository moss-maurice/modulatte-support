<!-- modulatte.partials.builder.form.fields.inputCheckbox -->
@php
    $required = (isset($required) ? $required : false);
@endphp

<input id="enable" type="checkbox" name="enable" value="1" @if ($value) checked @endif />
<label for="enable">Да</label>
<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputCheckbox -->
