<!-- modulatte.partials.header -->
<link rel="stylesheet" type="text/css" href="{{ $module->webSourcePath('resources/styles/style.css', ['v' => time()]) }}">
<link rel="stylesheet" type="text/css" href="{{ $module->webPath('resources/styles/style.css', ['v' => time()]) }}">

<h1>
    <i class="fa {{ $module->icon() }}"></i>{{ $module->name() }}
</h1>

<div id="actions">
    <!-- section.actions -->
    @yield ('actions')
    <!-- / section.actions -->
</div>

<div class="sectionBody" id="settingsPane">
    <div class="tab-pane" id="documentPane">
        <script type="text/javascript">
            var tpSettings = new WebFXTabPane(document.getElementById('documentPane'), {{ $modx->getConfig('remember_last_tab') == '1' ? 'true' : 'false' }} );
        </script>
<!--  / modulatte.partials.header -->
