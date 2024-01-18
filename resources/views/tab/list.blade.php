<!-- modulatte.tab.list -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
    use mmaurice\modulatte\Support\Components\ActionElement;
@endphp

@extends ("{$namespace}::layouts.tab")

<div class="">
    @include ("{$namespace}::partials.builder.filter.fields.inputHidden", [
        'name' => 'method',
        'value' => 'index',
    ])

    @include("{$namespace}::partials.filter", [
        'fields' => collect($module->tab()->model()->filterFields()),
    ])

    @if (!empty($list->items()))
        @include ("{$namespace}::partials.builder.container.list", [
            'fields' => $module->tab()->model()->mappedListFields(),
            'columnsCount' => $module->tab()->model()->mappedListFields()->count() + 1,
        ])
    @else
        @include ("{$namespace}::partials.message", [
            'message' => $message ? $message : 'Items is not found! Add new item?',
            'messageType' => $module->tab()::MESSAGE_DANGER,
            'buttons' => collect([
                ActionElement::build('Добавить', ModuleHelper::makeUrl([
                    'tab' => $tab->alias,
                    'method' => 'add',
                ]), 'success', 'plus'),
            ]),
        ])
    @endif
</div>
<!-- / modulatte.tab.list -->
