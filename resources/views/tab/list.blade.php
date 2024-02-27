<!-- modulatte.tab.list -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
    use mmaurice\modulatte\Support\Components\ActionElement;
@endphp

@extends ("{$namespace}::layouts.tab")

<div class="">
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
            'message' => $message ? $message : 'Ничего не найдено! Добавить?',
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
