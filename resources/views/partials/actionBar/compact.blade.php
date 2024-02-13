<!-- modulatte.partials.actionBar.compact -->
@if ($buttons and $buttons->isNotEmpty())
    <div class="btn-group">
        @foreach ($buttons as $index => $button)
            @if ($button->hasDropdown())
                <div class="btn-group dropdown">
                    <a id="Button{{ ($index + 1) }}" class="px-3 py-2 btn btn-{{ $button->getStyle() }}" href="{{ $button->getTarget() }}"{!! $button->getPropsToLine() !!}>
                        @if ($button->hasIcon())
                            <i class="{{ $button->getIcon() }} fa-lg"></i>
                        @endif
                    </a>

                    <span class="btn btn-success plus dropdown-toggle"></span>

                    <select id="stay" name="stay">
                        @foreach ($button->getDropdown() as $key => $item)
                            <option id="stay{{ ($key + 1) }}" value="{{ ($key + 1) }}">{{ $item->getCaption() }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <a id="Button{{ ($index + 1) }}" class="px-3 py-2 btn btn-{{ $button->getStyle() }}" href="{{ $button->getTarget() }}"{!! $button->getPropsToLine() !!}>
                    @if ($button->hasIcon())
                        <i class="{{ $button->getIcon() }} fa-lg"></i>
                    @endif
                </a>
            @endif
        @endforeach
    </div>
@endif
<!-- / modulatte.partials.actionBar.compact -->
