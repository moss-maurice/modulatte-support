<!-- modulatte.tab.update -->
@extends ("{$namespace}::layouts.tab")

@include ("{$namespace}::partials.builder.container.update", [
    'fields' => $item->mappedEditorFields(),
])

@include ("{$namespace}::partials.builder.container.update.grids")
<!-- / modulatte.tab.update -->
