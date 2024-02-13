<!-- modulatte.main -->
@extends ("{$namespace}::layouts.facade", [
    'partial' => 'simpleTab',
])

@section ('actions')
    @include ("{$namespace}::partials.actionBar.normal", [
        'buttons' => $tab->actionBar(),
    ])
@endsection
<!-- / modulatte.main -->
