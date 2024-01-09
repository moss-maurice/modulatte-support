<!-- modulatte.partials.builder.form.fields.date -->
@php
    use EvolutionCMS\Main\Helpers\FormatsHelper;

    $comment = (isset($comment) ? $comment : '');
    $value = (isset($value) ? $value : '');
@endphp

<tr>
    <tr>
        @include("{$namespace}::partials.builder.form.fieldName")

        <td data-type="text">
            <strong>{{ FormatsHelper::timestampToDateConvert($value, 'd.m.Y, H:i') }}</strong>

            <div class="form-text text-muted comment">{{ $comment }}</div>
        </td>
    </tr>
</tr>
<!-- / modulatte.partials.builder.form.fields.date -->
