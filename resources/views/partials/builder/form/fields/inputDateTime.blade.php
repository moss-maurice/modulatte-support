<!-- modulatte.partials.builder.form.fields.inputDateTime -->
@php
    $placeholder = (isset($placeholder) ? $placeholder : 'dd-mm-YYYY HH:MM:SS');
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $class = (isset($class) ? " {$class}" : '');
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td>
        <input type="date" name="{{ $name }}" id="date-from" class="form-control DatePicker unstyled date-datepicker date-from-datepicker{{ $class }}" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" />

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputDateTime -->
