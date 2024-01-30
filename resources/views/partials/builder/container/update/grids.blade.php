<!-- modulatte.partials.builder.container.update.grids -->
@if ($grids->isNotEmpty())
    @foreach ($grids as $grid)
        @include ("{$namespace}::partials.builder.form.split")

        <h3 class="pt-4 pb-4 font-weight-bold text-center">{{ $grid->name() }}</h3>

        {!! $grid->content('list') !!}
    @endforeach
@endif
<!-- / modulatte.partials.builder.container.update.grids -->
