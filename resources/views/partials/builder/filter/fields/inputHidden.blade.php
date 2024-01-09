<!-- modulatte.partials.builder.filter.fields.inputHidden -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $value = (isset($value) ? $value : '');
@endphp

<input type="hidden" class="form-control form-control-sm" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" />
<!-- / modulatte.partials.builder.filter.fields.inputHidden -->
