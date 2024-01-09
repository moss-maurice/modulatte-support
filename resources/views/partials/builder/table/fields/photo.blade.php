<!-- modulatte.partials.builder.table.fields.photo -->
@php
    use Illuminate\Support\Facades\Storage;

    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
    $width = (isset($width) ? $width : 150);
    $height = (isset($height) ? $height : 150);
@endphp

<td class="tableItem {{ $name }} {{ $class }}" data-field="{{ $name }}"{{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }}{{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }} style="width:150px;">
    @if ($value)
        <img src="{{Storage::disk('showplaces')->url($value)}}" alt="" style="max-width: {{ $width }}px; max-height: {{ $height }}px;" />
    @else
        —
    @endif
</td>
<!-- / modulatte.partials.builder.table.fields.photo -->
