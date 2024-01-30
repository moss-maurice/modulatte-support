<!-- modulatte.partials.builder.form.fields.id -->
@php
    $comment = (isset($comment) ? $comment : '');
@endphp

<strong>{{ $value }}</strong>

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.id -->
