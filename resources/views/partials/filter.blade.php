<!-- modulatte.tab.filter -->
@if ($fields and $fields->isNotEmpty())
    <div class="filter pb-3">
        <div class="input-group input-group-sm">
            @foreach ($fields as $field)
                @include ("{$namespace}::partials.builder.filter.item", $tab->model()->getFilterField($field))
            @endforeach

            @if ($buttons and $buttons->isNotEmpty())
                @foreach ($buttons as $index => $button)
                    <div class="px-2 pt-4 col-1">
                        <button type="submit" class="btn btn-{{ $button->getStyle() }} btn-sm styled border-0 rounded px-3 py-2"{!! $button->getPropsToLine() !!}>
                            @if ($button->hasIcon())
                                <i class="{{ $button->getIcon() }} pr-2"></i>
                            @endif
                            <span>{{ $button->getCaption() }}</span>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endif
<!-- / modulatte.tab.filter -->
