<!-- modulatte.main -->
@extends ("{$namespace}::layouts.facade", [
    'partial' => 'tabs',
])

@section ('actions')
    @include ("{$namespace}::partials.actionBar", [
        'buttons' => $module->tab()->actionBar(),
    ])
@endsection
<!-- / modulatte.main -->
