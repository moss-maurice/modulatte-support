<!-- modulatte.partials.builder.form.fields.inputNumber -->
@php
    $required = (isset($required) ? $required : false);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $min = (isset($min) ? $min : '');
    $max = (isset($max) ? $max : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="text">
        <input type="number" class="form-control{{ $class }}"  name="{{ $name }}"{!! ($required ? ' min="' . $min . '"' : '') !!}{!! ($required ? ' max="' . $max . '"' : '') !!} value="{{ $value }}"{!! ($required ? ' required' : '') !!} />

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputNumber -->
