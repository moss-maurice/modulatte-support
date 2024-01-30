<!-- modulatte.partials.builder.form.fields.inputText -->
@php
    $required = (isset($required) ? $required : false);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<input type="text" class="form-control{{ $class }}" name="{{ $name }}" value="{{ $value }}"{!! ($required ? ' required' : '') !!} />

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputText -->
