<!-- modulatte.tab.list -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
    use mmaurice\modulatte\Support\Components\ActionElement;
@endphp

@extends ("{$namespace}::layouts.tab")

<div class="">
    @include ("{$namespace}::partials.builder.form.fields.inputHidden", [
        'name' => 'method',
        'value' => 'index',
    ])

    @if ($tab->filterForm())
        @include("{$namespace}::partials.filter", [
            'fields' => collect($tab->model()->filterFields()),
        ])
    @endif

    @if (!empty($list->items()))
        @include ("{$namespace}::partials.builder.container.list", [
            'fields' => $tab->model()->mappedListFields(),
            'columnsCount' => $tab->model()->mappedListFields()->count() + 1,
        ])
    @else
        @include ("{$namespace}::partials.message", [
            'message' => $message ? $message : 'Items is not found! Add new item?',
            'messageType' => $tab::MESSAGE_DANGER,
            'buttons' => collect([
                ActionElement::build('Добавить', ModuleHelper::makeUrl([
                    'tab' => $tab->slug(),
                    'method' => 'create',
                    'redirect' => $tab->makeParentRedirect(),
                ]), 'success', 'plus'),
            ]),
        ])
    @endif
</div>
<!-- / modulatte.tab.list -->
