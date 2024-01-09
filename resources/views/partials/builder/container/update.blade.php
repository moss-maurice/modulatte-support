<!-- modulatte.partials.builder.container.update -->
<table border="0" cellspacing="0" cellpadding="3" style="font-size: inherit; line-height: inherit;">
    <tbody>
        @include ("{$namespace}::partials.builder.form.fields.id", [
            'name' => 'id',
            'title' => 'Идентификатор',
            'value' => $item ? $item->id : '',
            'comment' => '',
        ])

        @if (!empty($fields))
            @foreach ($fields as $index => $name)
                @php
                    $field = $item->getEditorField($name);
                @endphp

                @if (!in_array($field->get('template'), ['partials.builder.form.fields.inputHidden']))
                    @include ("{$namespace}::partials.builder.form.split")
                @endif

                @include ("{$namespace}::partials.builder.form.item", $field)
            @endforeach
        @endif

        @include ("{$namespace}::partials.builder.form.split")
        @include ("{$namespace}::partials.builder.form.fields.date", [
            'name' => 'created_at',
            'title' => 'Дата создания',
            'value' => $item ? $item->created_at : '',
            'comment' => '',
        ])

        @include ("{$namespace}::partials.builder.form.split")
        @include ("{$namespace}::partials.builder.form.fields.date", [
            'name' => 'updated_at',
            'title' => 'Дата последнего изменения',
            'value' => $item ? $item->updated_at : '',
            'comment' => '',
        ])
    </tbody>
</table>
<!-- / modulatte.partials.builder.container.update -->
