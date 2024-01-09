<!-- modulatte.partials.builder.table.fields.bodyWithHtml -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
@endphp

<td class="tableItem {{ $name }} {{ $class }}" data-field="{{ $name }}" {{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }} {{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    {!! (!is_null($value) && ($value !== '') ? $value : '—') !!}
</td>
<!-- / modulatte.partials.builder.table.fields.bodyWithHtml -->
