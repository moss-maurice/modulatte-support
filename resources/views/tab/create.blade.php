<!-- modulatte.tab.create -->
@extends ("{$namespace}::layouts.tab")

@include ("{$namespace}::partials.builder.container.create", [
    'fields' => $module->tab()->model()->mappedEditorFields(),
])
<!-- / modulatte.tab.create -->
