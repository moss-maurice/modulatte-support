<!-- modulatte.partials.builder.table.fields.body.text -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $symbol = (isset($symbol) ? $symbol : '');
    $decimals  = (isset($decimals ) ? $decimals : 2);
    $decimalSeparator = (isset($decimalSeparator ) ? $decimalSeparator : '.');
    $thousandsSeparator  = (isset($thousandsSeparator ) ? $thousandsSeparator : ' ');
    $symbolBefore = (isset($symbolBefore ) ? $symbolBefore : true);
    $value = (!is_null($value) && ($value !== '') ? trim(($symbolBefore ? "{$symbol} " : "") . number_format($value, $decimals , $decimalSeparator, $thousandsSeparator) . (!$symbolBefore ? " {$symbol}" : "")) : '—');
@endphp

<td class="tableItem {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    {!! $value !!}
</td>
<!-- / modulatte.partials.builder.table.fields.body.text -->
