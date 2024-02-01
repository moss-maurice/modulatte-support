<!-- modulatte.partials.builder.table.fields.head.control -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
@endphp

<th class="tableHeader {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    @if ($tab->listActionBar())
        @include ("{$namespace}::partials.actionBar", [
            'buttons' => $tab->actionBar(),
        ])
    @endif
</th>
<!-- / modulatte.partials.builder.table.fields.head.control -->
