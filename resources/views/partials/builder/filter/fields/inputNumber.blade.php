<!-- modulatte.partials.builder.filter.fields.inputNumber -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $value = (isset($value) ? $value : '');
    $min = (isset($min) ? $min : '');
    $max = (isset($max) ? $max : '');
@endphp

<div class="px-2{{ $class }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <br />
    <input type="number" name="filter[{{ $name }}]" class="form-control form-control-sm"{!! (!is_null($min) ? ' min="' . $min . '"' : '') !!}{!! (!is_null($max) ? ' max="' . $max . '"' : '') !!} id="{{ $name }}" value="{{ $value }}" style="width: 100% !important;" />
    <small class="form-text text-muted comment">{{ $comment }}</small>
</div>
<!-- / modulatte.partials.builder.filter.fields.inputNumber -->
