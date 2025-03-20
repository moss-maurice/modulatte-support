<!-- modulatte.partials.builder.table.fields.body.numFormat -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $leftSymbol = (isset($leftSymbol) ? $leftSymbol : '');
    $rightSymbol = (isset($rightSymbol) ? $rightSymbol : '');
    $decimals  = (isset($decimals ) ? $decimals : 0);
    $decimalSeparator = (isset($decimalSeparator ) ? $decimalSeparator : '.');
    $thousandsSeparator  = (isset($thousandsSeparator ) ? $thousandsSeparator : ' ');
    $value = (!is_null($value) && ($value !== '') ? trim(($leftSymbol ? "{$leftSymbol} " : "") . number_format($value, $decimals , $decimalSeparator, $thousandsSeparator) . ($rightSymbol ? " {$rightSymbol}" : "")) : '—');
@endphp

@include ("{$namespace}::partials.builder.table.fields.body.text", [
    'name' => $name,
    'class' => $class,
    'value' => $value,
    'colspan' => $colspan,
    'rowspan' => $rowspan,
])
<!-- / modulatte.partials.builder.table.fields.body.numFormat -->
