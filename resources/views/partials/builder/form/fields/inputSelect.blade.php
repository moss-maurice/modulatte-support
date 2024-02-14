<!-- modulatte.partials.builder.form.fields.inputSelect -->
@php
    $required = (isset($required) && ($required == true) ? " required" : '');
    $noValue = (isset($noValue) ? $noValue : true);
    $value = (isset($value) ? $value : '');
    $comment = (isset($comment) ? $comment : '');
    $list = (isset($list) ? $list : collect([]));
    $class = (isset($class) ? " {$class}" : '');
    $disabled = (isset($disabled) && ($disabled == true) ? " disabled" : '');
@endphp

<div class="clearfix">
    <select class="form-control{{ $class }}" name="{{ $name }}" size="1"{{ $required }}{{ $disabled }}>
        @if ($noValue)
            <option>Нет</option>
        @endif

        @if ($list and $list->isNotEmpty())
            @foreach ($list as $key => $item)
                <option value="{{ $key }}"{!! ($key == $value) ? ' selected' : '' !!}>{{ $item }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.inputSelect -->
