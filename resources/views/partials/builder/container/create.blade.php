<!-- modulatte.partials.builder.container.create -->
<h3 class="pt-4 pb-4 font-weight-bold text-center">Форма создания сущности "{{ $tab->name() }}"</h3>

<table border="0" cellspacing="0" cellpadding="3" style="font-size: inherit; line-height: inherit;">
    <tbody>
        @if ($fields->isNotEmpty())
            @foreach ($fields as $index => $name)
                @php
                    $properties = $item->getEditorField($name);
                @endphp

                @if (!in_array($properties->get('template'), ['partials.builder.form.fields.inputHidden']))
                    @include ("{$namespace}::partials.builder.form.split")
                @endif

                @include ("{$namespace}::partials.builder.form.item", $item->getEditorField($name))
            @endforeach
        @endif
    </tbody>
</table>
<!-- / modulatte.partials.builder.container.create -->
