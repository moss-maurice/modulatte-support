<!-- modulatte.partials.pagination -->
@php
    $distance = isset($distance) ? intval($distance) : 3;
@endphp

@if ($list->lastPage() > 1)
    <div class="pagination d-flex justify-content-center align-items-baseline">
        @if ($list->currentPage() > 1)
            <a class="btn btn-sm border-0 rounded page-item first px-3" href="{{ $list->url(1) }}" aria-label="First">
                <span aria-hidden="true">В начало</span>
            </a>
            <a class="btn btn-sm border-0 rounded page-item prev px-3" href="{{ $list->url($list->currentPage() - 1) }}" aria-label="Previous">
                <span aria-hidden="true">Назад</span>
            </a>
        @endif

        @for ($i = max(($list->currentPage() - $distance), 1); $i <= min(($list->currentPage() + $distance), $list->lastPage()); $i++)
            @if ($list->currentPage() == $i)
                <span class="btn btn-sm px-3 border-0 rounded page-item num active bg-success text-white">{{ $i }}</span>
            @else
                <a class="btn btn-sm px-3 border-0 rounded page-item num" href="{{ $list->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        @if ($list->currentPage() < $list->lastPage())
            <a class="btn btn-sm border-0 rounded page-item next px-3" href="{{ $list->url($list->currentPage() + 1) }}" aria-label="Next">
                <span aria-hidden="true">Вперёд</span>
            </a>
            <a class="btn btn-sm border-0 rounded page-item last px-3" href="{{ $list->url($list->lastPage()) }}" aria-label="Last">
                <span aria-hidden="true">В конец</span>
            </a>
        @endif
    </div>
@endif
<!-- / modulatte.partials.pagination -->
