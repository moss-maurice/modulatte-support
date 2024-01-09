<!-- modulatte.partials.builder.container.create -->
<table border="0" cellspacing="0" cellpadding="3" style="font-size: inherit; line-height: inherit;">
    <tbody>
        @if ($fields->isNotEmpty())
            @foreach ($fields as $index => $name)
                @php
                    $properties = $item->getEditorField($name);
                @endphp

                @if ($index > 0 and !in_array($properties->get('template'), ['partials.builder.form.fields.inputHidden']))
                    @include ("{$namespace}::partials.builder.form.split")
                @endif

                @include ("{$namespace}::partials.builder.form.item", $item->getEditorField($name))
            @endforeach
        @endif
    </tbody>
</table>
<!-- / modulatte.partials.builder.container.create -->
