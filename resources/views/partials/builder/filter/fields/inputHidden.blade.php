<!-- modulatte.partials.builder.filter.fields.inputHidden -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $value = (isset($value) ? $value : '');
@endphp

<input type="hidden" name="filter[{{ $name }}]" class="form-control form-control-sm" id="{{ $name }}" value="{{ $value }}" />
<!-- / modulatte.partials.builder.filter.fields.inputHidden -->
