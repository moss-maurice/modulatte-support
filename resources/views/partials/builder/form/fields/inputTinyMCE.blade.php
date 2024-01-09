<!-- modulatte.partials.builder.form.fields.inputTinyMCE -->
@php
    $required = (isset($required) ? $required : false);
    $cols = (isset($cols) ? $cols : 40);
    $rows = (isset($rows) ? $rows : 5);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? $class : " {$class}");
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="text">
        <textarea id="tinyMCE" class="form-control{{ $class }}" name="{{$name}}" cols="{{ $cols }}" rows="{{ $rows }}" wrap="soft" aria-hidden="true">{{ $value }}</textarea>

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputTinyMCE -->
