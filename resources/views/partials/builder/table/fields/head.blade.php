<!-- modulatte.partials.builder.table.fields.head -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
@endphp

<th class="tableHeader {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    {{ $title }}
</th>
<!-- / modulatte.partials.builder.table.fields.head -->
