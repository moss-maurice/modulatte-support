<!-- modulatte.partials.builder.form.fields.inputDate -->
@php
    $placeholder = (isset($placeholder) ? $placeholder : 'dd.mm.YYYY');
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<input type="date" name="{{ $name }}" id="date-from" class="form-control DatePicker unstyled date-datepicker date-from-datepicker{{ $class }}" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" />

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputDate -->
