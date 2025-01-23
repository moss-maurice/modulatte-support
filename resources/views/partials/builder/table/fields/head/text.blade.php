<!-- modulatte.partials.builder.table.fields.head.text -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $order = strtolower((isset($order) ? $order : 'none'));
@endphp

<th class="tableHeader align-middle {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    @if (!empty($title))
        @if ($tab->orderForm() and (!in_array($name, $tab->model()->orderIgnoreFields())))
            <span class="order">
                {{ $title }}
                <i class="fa fa-solid fa-sort{{ ($order !== 'asc' ? ($order !== 'desc' ? '' : '-down text-success') : '-up text-success') }}"></i>
            </span>

            <input type="hidden" name="order[{{ $name }}]" value="{{ $order }}" />
        @else
            {{ $title }}
        @endif
    @endif
</th>
<!-- / modulatte.partials.builder.table.fields.head.text -->
