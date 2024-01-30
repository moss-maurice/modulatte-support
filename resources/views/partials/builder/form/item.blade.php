<!-- modulatte.partials.builder.form.item -->
<tr>
    <tr>
        <td class="warning py-2" nowrap="">
            @include("{$namespace}::partials.builder.form.fieldName", $attributes)
        </td>

        <td class="py-2" data-type="text">
            @include ("{$namespace}::{$template}", $attributes)
        </td>
    </tr>
</tr>
<!-- / modulatte.partials.builder.form.item -->
