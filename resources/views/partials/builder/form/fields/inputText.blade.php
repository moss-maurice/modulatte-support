<!-- modulatte.partials.builder.form.fields.inputText -->
@php
    $required = (isset($required) ? $required : false);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="text">
        <input type="text" name="{{ $name }}" value="{{ $value }}"{!! ($required ? ' required' : '') !!} />

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputText -->
