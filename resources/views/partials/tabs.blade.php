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
                {!! $content !!}
            @endif
        </div>
    @endforeach
@endif

<script type="text/javascript">
    jQuery(document).ready(function() {
        // Открываем контент активного таба
        jQuery(document).find('h2').filter('.tab ').each(function(index, value) {
            var dataTarget = '#tab_{{ $module->tab()->slug() }}';
            var currentDataTarget = jQuery(this).attr('data-target');
            var tabPage = jQuery(document).find('.tab-page' + currentDataTarget);

            if (currentDataTarget === dataTarget) {
                jQuery(this).addClass('selected');

                tabPage.show();
            } else {
                jQuery(this).removeClass('selected');

                tabPage.hide();
            }
        });

        // Скрываем не нужные табы
        var hideTabs = [{!! collect($module->hideTabs())->map(function ($item) {
            return "\"{$item}\"";
        })->implode(', ') !!}];

        jQuery(hideTabs).each(function (index, value) {
            var dataTarget = "#tab_" + value;

            jQuery(document).find('h2').filter('.tab').each(function (index, value) {
                if (jQuery(this).attr('data-target') === dataTarget) {
                    jQuery(this).hide();
                }
            });
        });
    });
</script>
<!-- / modulatte.partials.tabs -->
