<!-- modulatte.partials.builder.form.fields.inputDate -->
@php
    $placeholder = (isset($placeholder) ? $placeholder : 'dd.mm.YYYY');
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td>
        <input type="date" name="{{ $name }}" id="date-from" class="form-control DatePicker unstyled date-datepicker date-from-datepicker" value="{{ $value }}" placeholder="{{ $placeholder }}" autocomplete="off" />

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputDate -->
