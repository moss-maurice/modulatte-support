<!-- modulatte.partials.builder.filter.fields.submit -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $caption = (isset($caption) ? $caption : 'Найти');
@endphp

<div class="px-2{{ $class }}">
    <label class="p-0 m-0">&nbsp;</label>
    <br />
    <button type="submit" class="btn btn-success btn-sm styled border-0 rounded px-3 py-2">
        <i class="fa fa fa-search pr-2"></i>
        <span>{{ $caption }}</span>
    </button>
</div>
<!-- / modulatte.partials.builder.filter.fields.submit -->
