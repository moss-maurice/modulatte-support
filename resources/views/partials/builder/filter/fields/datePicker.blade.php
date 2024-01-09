<!-- modulatte.partials.builder.filter.fields.datePicker -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $value = (isset($value) ? $value : '');
    $placeholder = (isset($placeholder) ? $placeholder : 'dd-mm-YYYY HH:MM:SS');
@endphp

<div class="px-2{{ $class }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <br />
    <input type="date" class="form-control form-control-sm DatePicker" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" style="width: 100% !important;" />
    <small class="form-text text-muted comment">{{ $comment }}</small>
</div>
<!-- / modulatte.partials.builder.filter.fields.datePicker -->
