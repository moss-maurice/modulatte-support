<!-- modulatte.partials.groupBar -->
<div class="text-center d-flex justify-content-center align-items-baseline">
    @if ($tab->groupBar()->isNotEmpty())
        @foreach ($tab->groupBar() as $index => $button)
            <button type="submit" name="groupAction" value="{{ $button->getProp('name') }}" rel-tab="{{ $tab->slug() }}" id="group-bar-button-{{ ($index + 1) }}" class="btn btn-{{ $button->getStyle() }} btn-sm inactive styled {{ (!$loop->first && !$loop->last ? (!$loop->first ? (!$loop->last ? "" : "rounded-right rounded-3 ") : "rounded-left rounded-3 ") : "rounded rounded-3") }}px-3 py-2 border-0" href="{{ $button->getTarget() }}"{!! $button->getPropsToLine() !!}>
                @if ($button->hasIcon())
                    <i class="{{ $button->getIcon() }} pr-2"></i>
                @endif
                <span>{{ $button->getCaption() }}</span>
            </button>
        @endforeach
    @endif
</div>
<!-- / modulatte.partials.groupBar -->
