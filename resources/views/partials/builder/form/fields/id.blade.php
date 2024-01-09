<!-- modulatte.partials.builder.form.fields.id -->
@php
    $comment = (isset($comment) ? $comment : '');
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="text">
        <strong>{{ $value }}</strong>

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.id -->
