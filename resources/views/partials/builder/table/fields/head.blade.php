<!-- modulatte.partials.builder.table.fields.head -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $order = strtolower((isset($order) ? $order : 'none'));
@endphp

<th class="tableHeader {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    @if (!empty($title))
        <span class="order">
            {{ $title }}
            <i class="fa fa-solid fa-sort{{ ($order !== 'asc' ? ($order !== 'desc' ? '' : '-down text-success') : '-up text-success') }}"></i>
        </span>

        <input type="hidden" name="order[{{ $name }}]" value="{{ $order }}" />
    @endif
</th>
<!-- / modulatte.partials.builder.table.fields.head -->
