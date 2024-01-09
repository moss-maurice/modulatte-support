<!-- modulatte.partials.builder.form.split -->
@php
    $columns = (isset($columns) ? $columns : 2);
@endphp

<tr>
    <td colspan="{{ $columns }}">
        <div class="split"></div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.split -->
