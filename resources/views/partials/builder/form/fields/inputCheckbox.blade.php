<!-- modulatte.partials.builder.form.fields.inputCheckbox -->
@php
    $required = (isset($required) ? $required : false);
    $label = (isset($label) ? $label : 'Да');
@endphp

<input id="enable" type="checkbox" name="{{ $name }}" value="1" @if ($value) checked @endif />
<label for="enable">{{ $label }}</label>
<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputCheckbox -->
