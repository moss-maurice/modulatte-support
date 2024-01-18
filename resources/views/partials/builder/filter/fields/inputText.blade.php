<!-- modulatte.partials.builder.filter.fields.inputText -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $value = (isset($value) ? $value : '');
@endphp

<div class="px-2{{ $class }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <br />
    <input type="text" name="filter[{{ $name }}]" class="form-control form-control-sm" id="{{ $name }}" value="{{ $value }}" style="width: 100% !important;" />
    <small class="form-text text-muted comment">{{ $comment }}</small>
</div>
<!-- / modulatte.partials.builder.filter.fields.inputText -->
