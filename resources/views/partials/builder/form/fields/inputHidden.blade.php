<!-- modulatte.partials.builder.form.fields.inputHidden -->
@php
    $value = (isset($value) ? $value : '');
@endphp

<input type="hidden" name="{{ $name }}" value="{{ $value }}" />
<!-- / modulatte.partials.builder.form.fields.inputHidden -->
