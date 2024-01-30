<!-- modulatte.partials.builder.form.fields.date -->
@php
    use Carbon\Carbon;

    $comment = (isset($comment) ? $comment : '');
    $value = (isset($value) ? $value : null);
@endphp

<strong>
    @if (!empty($value))
        {{ Carbon::parse($value)->format('d.m.Y, H:i') }}
    @endif
</strong>

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.date -->
