<!-- modulatte.partials.builder.table.fields.body.text -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $value = (!is_null($value) && ($value !== '') ? trim($value) : '—');
    $class = (isset($class) ? $class : '');
@endphp

<td class="tableItem {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    {!! $value !!}
</td>
<!-- / modulatte.partials.builder.table.fields.body.text -->
