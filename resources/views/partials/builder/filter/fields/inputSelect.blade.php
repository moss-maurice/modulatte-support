<!-- modulatte.partials.builder.filter.fields.inputSelect -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $value = (isset($value) ? $value : '');
    $noValue = (isset($noValue) ? $noValue : true);
    $noValueCaption = (isset($noValueCaption) ? $noValueCaption : 'Нет');

    $list = (isset($list) ? $list : collect([]));
@endphp

<div class="px-2{{ $class }}">
    <label for="{{ $name }}">{{ $title }}</label>
    <br />
    <select name="filter[{{ $name }}]" class="form-control form-control-sm" id="{{ $name }}" size="1" style="width: 100% !important;">
        @if ($noValue)
            <option value="">{{ $noValueCaption }}</option>
        @endif

        @if ($list and $list->isNotEmpty())
            @foreach ($list as $key => $item)
                <option value="{{ $key }}"{!! ($key == $value) ? ' selected' : '' !!}>{{ $item }}</option>
            @endforeach
        @endif
    </select>
    <small class="form-text text-muted comment">{{ $comment }}</small>
</div>
<!-- / modulatte.partials.builder.filter.fields.inputSelect -->
