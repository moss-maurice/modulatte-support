<!-- modulatte.partials.builder.container.list -->
@php
    $columnsCount = $tab->groupBar()->isNotEmpty() ? ($columnsCount + 1) : $columnsCount;
@endphp

<div class="row">
    <div class="table-responsive">
        <table class="table data" cellpadding="1" cellspacing="1">
            <thead>
                @if ($list->lastPage() > 1)
                    <tr class="paginator">
                        <td class="tableHeader py-2" colspan="{{ $columnsCount }}">
                            @include ("{$namespace}::partials.pagination")
                        </td>
                    </tr>
                @endif

                @if ($tab->groupBar()->isNotEmpty())
                    <tr class="group-bar-controls text-center">
                        <td class="tableHeader py-2" colspan="{{ $columnsCount }}">
                            @include ("{$namespace}::partials.groupBar")
                        </td>
                    </tr>
                @endif

                <tr>
                    @if ($tab->groupBar()->isNotEmpty())
                        <td class="tableItem text-center short">
                            <input type="checkbox" class="group-bar select-all" />
                        </td>
                    @endif

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
                        @if ($tab->groupBar()->isNotEmpty())
                            <td class="tableItem text-center short">
                                <input type="checkbox" name="group[]" class="group-bar select-item" value="{{ $item->pk() }}" />
                            </td>
                        @endif

                        @if ($fields and $fields->isNotEmpty())
                            @foreach ($fields as $field)
                                @include ("{$namespace}::partials.builder.table.item", $item->getListField($field))
                            @endforeach
                        @endif

                        <td class="tableItem controls text-right">
                            @if ($tab->isControlBarCompact())
                                @include ("{$namespace}::partials.actionBar.compact", [
                                    'buttons' => $tab->controlBar($item),
                                ])
                            @else
                                @include ("{$namespace}::partials.actionBar.normal", [
                                    'buttons' => $tab->controlBar($item),
                                ])
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                @if ($tab->groupBar()->isNotEmpty())
                    <tr class="group-bar-controls text-center">
                        <td class="tableHeader py-2" colspan="{{ $columnsCount }}">
                            @include ("{$namespace}::partials.groupBar")
                        </td>
                    </tr>
                @endif

                @if ($list->lastPage() > 1)
                    <tr class="paginator">
                        <td class="tableHeader py-2" colspan="{{ $columnsCount }}">
                            @include ("{$namespace}::partials.pagination")
                        </td>
                    </tr>
                @endif
            </tfoot>
        </table>
    </div>
</div>
<!-- / modulatte.partials.builder.container.list -->
