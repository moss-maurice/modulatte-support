<!-- modulatte.tab.filter -->
@if ($fields and $fields->isNotEmpty())
    <div class="actions pb-3">
        <div class="input-group input-group-sm">
            @foreach ($fields as $field)
                @include ("{$namespace}::partials.builder.filter.item", $tab->model()->getFilterField($field))
            @endforeach

            @include ("{$namespace}::partials.builder.filter.fields.submit", [
                'class' => 'col-1',
                'name' => 'filter-run',
                'caption' => 'Фильтровать',
            ])
        </div>
    </div>
@endif
<!-- / modulatte.tab.filter -->
