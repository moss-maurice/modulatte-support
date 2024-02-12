<!-- modulatte.partials.builder.form.item -->
@if (!in_array($template, ['partials.builder.form.fields.inputHidden']))
    <tr>
        <td class="warning py-2" nowrap="">
            @include("{$namespace}::partials.builder.form.fieldName", $attributes)
        </td>

        <td class="py-2" data-type="text">
            @include ("{$namespace}::{$template}", $attributes)
        </td>
    </tr>
@else
    <tr class="hasHiddenInput">
        <td colspan="2">
            @include ("{$namespace}::{$template}", $attributes)
        </td>
    </tr>
@endif
<!-- / modulatte.partials.builder.form.item -->
