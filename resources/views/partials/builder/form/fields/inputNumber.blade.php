<!-- modulatte.partials.builder.form.fields.inputNumber -->
@php
    $required = (isset($required) ? $required : false);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $min = (isset($min) ? $min : '');
    $max = (isset($max) ? $max : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<input type="number" class="form-control{{ $class }}"  name="{{ $name }}"{!! ($required ? ' min="' . $min . '"' : '') !!}{!! ($required ? ' max="' . $max . '"' : '') !!} value="{{ $value }}"{!! ($required ? ' required' : '') !!} />

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputNumber -->
