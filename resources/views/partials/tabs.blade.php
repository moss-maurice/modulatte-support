<!-- modulatte.partials.tabs -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
@endphp

@if ($module->tabs()->isNotEmpty())
    @foreach ($module->tabs() as $tab)
        <div class="tab-page" id="tab_{{ $tab->slug() }}">
            <h2 class="tab">
                <a href="{{ ModuleHelper::makeUrl(['tab' => $tab->slug()]) }}">{{ $tab->name() }}</a>
            </h2>

            <script type="text/javascript">
                tpSettings.addTabPage(document.getElementById('tab_{{ $tab->slug() }}'));
            </script>

        @if ($tab->slug() === $module->tab()->slug())
            {!! $tab->content() !!}
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
