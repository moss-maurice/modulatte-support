<!-- modulatte.main -->
@extends ("{$namespace}::layouts.facade")

@section ('actions')
    @include ("{$namespace}::partials.actionBar", [
        'buttons' => $module->tab()->actionBar(),
    ])
@endsection
<!-- / modulatte.main -->
