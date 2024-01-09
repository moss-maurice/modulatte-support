<!-- modulatte.partials.builder.form.fields.inputHidden -->
@php
    $value = (isset($value) ? $value : '');
@endphp

<tr class="hide">
    <td colspan="2">
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputHidden -->
