<!-- modulatte.partials.builder.container.list -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
    use mmaurice\modulatte\Support\Components\ActionElement;
@endphp

<div class="row">
    <div class="table-responsive">
        <table class="table data" cellpadding="1" cellspacing="1">
            <thead>
                @if ($list->lastPage() > 1)
                    <tr class="paginator">
                        <td class="tableHeader" colspan="{{ $columnsCount }}">
                            @include ("{$namespace}::partials.pagination")
                        </td>
                    </tr>
                @endif

                <tr>
                    @if ($fields and $fields->isNotEmpty())
                        @foreach ($fields as $field)
                            @include ("{$namespace}::partials.builder.table.item", $tab->model()->getListHeadField($field))
                        @endforeach
                    @endif

                    @include ("{$namespace}::partials.builder.table.fields.head.control", [
                        'name' => 'controls',
                        'class' => 'controls',
                    ])
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                    <tr>
                        @if ($fields and $fields->isNotEmpty())
                            @foreach ($fields as $field)
                                @include ("{$namespace}::partials.builder.table.item", $item->getListField($field))
                            @endforeach
                        @endif

                        <td class="tableItem controls text-right">
                            @include ("{$namespace}::partials.actionBar", [
                                'buttons' => collect([
                                    ActionElement::build('Изменить', ModuleHelper::makeUrl(array_filter([
                                        'tab' => $tab->slug(),
                                        'method' => 'update',
                                        'itemId' => $item->id,
                                        'redirect' => $redirect,
                                    ])), 'success btn-sm', 'edit'),
                                    ActionElement::build('Удалить', ModuleHelper::makeUrl(array_filter([
                                        'tab' => $tab->slug(),
                                        'method' => 'delete',
                                        'itemId' => $item->id,
                                        'redirect' => $redirect,
                                    ])), 'danger btn-sm', 'trash-o'),
                                ]),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @if ($list->lastPage() > 1)
                    <tr class="paginator">
                        <td class="tableHeader" colspan="{{ $columnsCount }}">
                            @include ("{$namespace}::partials.pagination")
                        </td>
                    </tr>
                @endif
            </tfoot>
        </table>
    </div>
</div>
<!-- / modulatte.partials.builder.container.list -->
