<!-- modulatte.partials.builder.table.fields.body.price -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $symbol = (isset($symbol) ? $symbol : '');
    $decimals  = (isset($decimals ) ? $decimals : 2);
    $decimalSeparator = (isset($decimalSeparator ) ? $decimalSeparator : '.');
    $thousandsSeparator  = (isset($thousandsSeparator ) ? $thousandsSeparator : ' ');
@endphp

@include ("{$namespace}::partials.builder.table.fields.body.numFormat", [
    'name' => $name,
    'class' => $class,
    'value' => $value,
    'leftSymbol' => $symbol,
    'decimals' => $decimals,
    'decimalSeparator' => $decimalSeparator,
    'thousandsSeparator' => $thousandsSeparator,
    'colspan' => $colspan,
    'rowspan' => $rowspan,
])
<!-- / modulatte.partials.builder.table.fields.body.price -->
