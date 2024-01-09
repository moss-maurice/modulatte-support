<!-- modulatte.partials.builder.filter.fields.submit -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $caption = (isset($caption) ? $caption : 'Найти');
@endphp

<div class="px-2{{ $class }}">
    <label>&nbsp;</label>
    <br />
    <button type="submit" class="btn btn-success btn-sm">
        <i class="fa fa fa-search"></i>
        <span>{{ $caption }}</span>
    </button>
</div>
<!-- / modulatte.partials.builder.filter.fields.submit -->
