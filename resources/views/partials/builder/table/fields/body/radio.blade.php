<!-- modulatte.partials.builder.table.fields.body.radio -->
@php
    $colspan = (isset($colspan) ? $colspan : 1);
    $rowspan = (isset($rowspan) ? $rowspan : 1);
@endphp

<td class="tableItem {{ $name }} {{ $class }}" data-field="{{ $name }}" {{ ($colspan > 1 ? " colspan=\"{$colspan}\"" : '') }} {{ ($rowspan > 1 ? " rowspan=\"{$rowspan}\"" : '') }}>
    <div class="row">
        <label class="switch mx-auto col-auto" id="{{$item->id}}">
            <input type="checkbox" name="{{$name}}" value="{{$value}}" @if ($value) checked @endif data-link="/manager/?a=112&id={{request()['id']}}&tab={{$tab->alias}}&method=changeEnable&itemId={{$item->id}}" />
            <span class="slider round"></span>
        </label>
        <div class="spinner-grow text-primary d-none" role="status"></div>
    </div>
</td>
<!-- modulatte.partials.builder.table.fields.body.radio -->
