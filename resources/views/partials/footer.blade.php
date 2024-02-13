<!-- modulatte.partials.footer -->
    </div>
</div>

<input type="submit" name="save" style="display: none;">

{{--<script type="text/javascript" src="media/calendar/datepicker.js"></script>--}}
<script type="text/javascript" src="/assets/plugins/tinymce5/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="{{ $module->webSourcePath('resources/scripts/features/tinyMCE.js', ['v' => time()]) }}"></script>
<script type="text/javascript" src="{{ $module->webSourcePath('resources/scripts/features/groupBar.js', ['v' => time()]) }}"></script>
<script type="text/javascript" src="{{ $module->webSourcePath('resources/scripts/features/rating.js', ['v' => time()]) }}"></script>
<script type="text/javascript" src="{{ $module->webSourcePath('resources/scripts/features/sorting.js', ['v' => time()]) }}"></script>
{{--<script type="text/javascript" src="{{ $module->webSourcePath('resources/scripts/features/datepicker.js', ['v' => time()]) }}"></script>--}}
<script type="text/javascript" src="{{ $module->webSourcePath('resources/scripts/script.js', ['v' => time()]) }}"></script>
<script type="text/javascript" src="{{ $module->webPath('resources/scripts/script.js', ['v' => time()]) }}"></script>
<!--  / modulatte.partials.footer -->
