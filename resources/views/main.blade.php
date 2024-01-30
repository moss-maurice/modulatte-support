<!-- modulatte.main -->
@extends ("{$namespace}::layouts.facade", [
    'partial' => 'tabs',
])

@section ('actions')
    @include ("{$namespace}::partials.actionBar", [
        'buttons' => $tab->actionBar(),
    ])
@endsection
<!-- / modulatte.main -->
