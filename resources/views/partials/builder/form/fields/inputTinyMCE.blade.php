<!-- modulatte.partials.builder.form.fields.inputTinyMCE -->
@php
    $required = (isset($required) ? $required : false);
    $cols = (isset($cols) ? $cols : 40);
    $rows = (isset($rows) ? $rows : 5);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<textarea name="{{ $name }}" class="tinyMCE form-control{{ $class }}" cols="{{ $cols }}" rows="{{ $rows }}"{!! ($required ? ' required' : '') !!} wrap="soft" aria-hidden="true">{{ $value }}</textarea>

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputTinyMCE -->
