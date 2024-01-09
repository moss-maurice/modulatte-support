<!-- modulatte.layouts.facade -->
<form id="{{ $module->slug() }}" enctype="multipart/form-data" name="mutate" method="post" action="{{ $path }}">
    @include ("{$namespace}::partials.header")
    @include ("{$namespace}::partials.tabs")
    @include ("{$namespace}::partials.footer")
</form>
<!-- / modulatte.layouts.facade -->
