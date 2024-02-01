<!-- modulatte.partials.builder.container.list -->
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
                                'buttons' => $tab->controlBar($item),
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
