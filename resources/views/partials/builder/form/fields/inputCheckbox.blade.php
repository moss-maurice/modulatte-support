<!-- modulatte.partials.builder.form.fields.inputCheckbox -->
@php
    $required = (isset($required) ? $required : false);
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="text">
        <input id="enable" type="checkbox" name="enable" value="1" @if ($value) checked @endif />
        <label for="enable">Да</label>
        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputCheckbox -->
