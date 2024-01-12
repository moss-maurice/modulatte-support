<!-- modulatte.layouts.facade -->
@php
    $partial = !empty($partial) ? $partial : 'tabs';
@endphp

<form id="{{ $module->slug() }}" enctype="multipart/form-data" name="mutate" method="post" action="{{ $path }}">
    @include ("{$namespace}::partials.header")
    @include ("{$namespace}::partials.{$partial}")
    @include ("{$namespace}::partials.footer")
</form>
<!-- / modulatte.layouts.facade -->
