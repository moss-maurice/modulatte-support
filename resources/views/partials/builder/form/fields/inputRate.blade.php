<!-- modulatte.partials.builder.form.fields.inputRate -->
@php
    $required = (isset($required) ? $required : false);
    $emptyStar = $value - 5;
@endphp

<tr>
    @include("{$namespace}::partials.builder.form.fieldName")

    <td data-type="text">
        <div class="starWrapper row mt-2">
            @if ($value)
                @for ($i = 1; $i <= 5; $i++)
                    @if ($value >= $i)
                        <div class="col-auto">
                            <i id="star-{{ $i }}" class="fa fa-star star" aria-hidden="true"></i>
                        </div>
                    @else
                        <div class="col-auto">
                            <i id="star-{{ $i }}" class="fa fa-star-o star" aria-hidden="true"></i>
                        </div>
                    @endif
                @endfor
            @else
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i == 1)
                        <i id="star-{{ $i }}" class="fa fa-star star col-auto" aria-hidden="true"></i>
                    @else
                        <i id="star-{{ $i }}" class="fa fa-star-o star col-auto" aria-hidden="true"></i>
                    @endif
                @endfor
            @endif

            <input type="hidden" name="{{ $name }}" value="{{ $value ?? 1 }}"/>
        </div>

        <div class="form-text text-muted comment">{{ $comment }}</div>
    </td>
</tr>
<!-- / modulatte.partials.builder.form.fields.inputRate -->
