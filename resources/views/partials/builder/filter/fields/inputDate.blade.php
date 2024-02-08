<!-- modulatte.partials.builder.filter.fields.inputDate -->
@php
    $placeholder = (isset($placeholder) ? $placeholder : 'dd.mm.YYYY');
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<div class="px-2{{ $class }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <br />
    <input type="date" id="date-from" name="filter[{{ $name }}]" class="form-control DatePicker unstyled date-datepicker date-from-datepicker{{ $class }}" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" />
    <small class="form-text text-muted comment">{{ $comment }}</small>
</div>
<!-- / modulatte.partials.builder.filter.fields.inputDate -->
