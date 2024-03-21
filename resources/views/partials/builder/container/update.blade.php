<!-- modulatte.partials.builder.container.update -->
<h3 class="pt-4 pb-4 font-weight-bold text-center">Форма редактирования сущности "{{ $tab->name() }}"{{ $item->pk() ? " [{$item->pk()}]" : '' }}</h3>

<table border="0" cellspacing="0" cellpadding="3" style="font-size: inherit; line-height: inherit;">
    <tbody>
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
    </tbody>
</table>
<!-- / modulatte.partials.builder.container.update -->
