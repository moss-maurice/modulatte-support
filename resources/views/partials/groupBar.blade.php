<!-- modulatte.partials.groupBar -->
<div class="text-center d-flex justify-content-center align-items-baseline">
    <div class="btn-group">
        @if ($tab->groupBar()->isNotEmpty())
            @foreach ($tab->groupBar() as $index => $button)
                <button type="submit" name="groupAction" value="{{ $button->getProp('name') }}"id="group-bar-button-{{ ($index + 1) }}" class="btn btn-{{ $button->getStyle() }} btn-sm inactive px-3 py-2" href="{{ $button->getTarget() }}"{!! $button->getPropsToLine() !!}>
                    @if ($button->hasIcon())
                        <i class="{{ $button->getIcon() }} pr-2"></i>
                    @endif
                    <span>{{ $button->getCaption() }}</span>
                </button>
            @endforeach
        @endif
    </div>
</div>
<!-- / modulatte.partials.groupBar -->
