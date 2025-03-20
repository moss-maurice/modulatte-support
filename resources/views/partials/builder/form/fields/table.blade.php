<!-- modulatte.partials.builder.form.fields.table -->
@php
    $class = (isset($class) ? " {$class}" : '');
    $headers = (isset($headers) && is_array($headers) && !empty($headers) ? $headers : []);
    $rows = (isset($rows) && is_array($rows) && !empty($rows) ? $rows : []);
    $footers = (isset($footers) && is_array($footers) && !empty($footers) ? $footers : []);
    $comment = (isset($comment) ? $comment : '');
@endphp

@if (!empty($rows))
<table class="table table-striped table-bordered{{ $class }}" name="{{ $name }}">
    @if (!empty($headers))
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="font-weight-bold">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
    @endif
    <tbody>
        @foreach ($rows as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </tbody>
    @if (!empty($footers))
        <tfoot>
            <tr>
                @foreach ($footers as $footer)
                    <td>{{ $footer }}</td>
                @endforeach
            </tr>
        </tfoot>
    @endif
</table>
@endif

<div class="form-text text-muted comment">{{ $comment }}</div>
<!-- / modulatte.partials.builder.form.fields.table -->
