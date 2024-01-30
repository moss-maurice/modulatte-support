<!-- modulatte.partials.tabs -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
@endphp

@if ($module->tabs()->isNotEmpty())
    @foreach ($module->tabs() as $currentTab)
        <div class="tab-page" id="tab_{{ $currentTab->slug() }}">
            <h2 class="tab">
                <a href="{{ ModuleHelper::makeUrl(['tab' => $currentTab->slug()]) }}">{{ $currentTab->name() }}</a>
            </h2>

            <script type="text/javascript">
                tpSettings.addTabPage(document.getElementById('tab_{{ $currentTab->slug() }}'));
            </script>

        @if ($currentTab->slug() === $module->tab()->slug())
            {!! $currentTab->content() !!}
        @endif

        </div>
    @endforeach
@endif

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(document).find('h2').filter('.tab ').each(function() {
            var dataTarget = '#tab_{{ $module->tab()->slug() }}';
            var currentDataTarget = jQuery(this).attr('data-target');

            if (currentDataTarget === dataTarget) {
                jQuery(this).addClass('selected');

                jQuery(document).find('.tab-page' + currentDataTarget).show();
            } else {
                jQuery(this).removeClass('selected');

                jQuery(document).find('.tab-page' + currentDataTarget).hide();
            }
        });
    });
</script>
<!-- / modulatte.partials.tabs -->
