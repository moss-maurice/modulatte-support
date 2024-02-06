<!-- modulatte.partials.builder.form.fields.inputTime -->
@php
    $placeholder = (isset($placeholder) ? $placeholder : 'HH:MM');
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<input type="time" id="date-from" name="{{ $name }}" class="form-control DatePicker unstyled date-datepicker date-from-datepicker{{ $class }}" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" />

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputTime -->
