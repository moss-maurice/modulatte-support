<!-- modulatte.partials.builder.form.fields.inputTextarea -->
@php
    $required = (isset($required) ? $required : false);
    $cols = (isset($cols) ? $cols : 40);
    $rows = (isset($rows) ? $rows : 5);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="textareamini">
        <textarea name="{{ $name }}" class="form-control{{ $class }}" cols="{{ $cols }}" rows="{{ $rows }}"{!! ($required ? ' required' : '') !!}>{{ $value }}</textarea>

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputTextarea -->
