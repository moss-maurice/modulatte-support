<!-- modulatte.tab.update -->
@extends ("{$namespace}::layouts.tab")

@include ("{$namespace}::partials.builder.container.update", [
    'fields' => $module->tab()->model()->itemFields(),
])
<!-- / modulatte.tab.update -->
