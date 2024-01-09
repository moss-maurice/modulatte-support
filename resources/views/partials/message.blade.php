<!-- modulatte.partials.message -->
@php
    use mmaurice\modulatte\Support\Helpers\ModuleHelper;
@endphp

<div class="alert alert-{{ $messageType }} align-middle text-center mb-0 py-3" style="font-size: 20px;" role="alert">
    <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
</div>

@if ($buttons and $buttons->isNotEmpty())
    <div class="d-flex pt-4 justify-content-center">
        @include ("{$namespace}::partials.actionBar", [
            'buttons' => $buttons,
        ])
    </div>
@endif
<!-- / modulatte.partials.message -->
