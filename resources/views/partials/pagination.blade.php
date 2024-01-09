<!-- modulatte.partials.pagination -->
@php
    $distance = isset($distance) ? intval($distance) : 3;
@endphp

@if ($list->lastPage() > 1)
    <div class="pagination d-flex justify-content-center align-items-baseline">
        @if ($list->currentPage() > 1)
            <a class="btn first" href="{{ $list->url(1) }}" aria-label="First">
                <span aria-hidden="true">Первая</span>
            </a>
            <a class="btn prev" href="{{ $list->url($list->currentPage() - 1) }}" aria-label="Previous">
                <span aria-hidden="true">Назад</span>
            </a>
        @endif

        @for ($i = max(($list->currentPage() - $distance), 1); $i <= min(($list->currentPage() + $distance), $list->lastPage()); $i++)
            @if ($list->currentPage() == $i)
                <span class="page-item num active bg-secondary">{{ $i }}</span>
            @else
                <a class="page-item num" href="{{ $list->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        @if ($list->currentPage() < $list->lastPage())
            <a class="btn" href="{{ $list->url($list->currentPage() + 1) }}" aria-label="Next">
                <span aria-hidden="true">Вперёд</span>
            </a>
            <a class="btn" href="{{ $list->url($list->lastPage()) }}" aria-label="Last">
                <span aria-hidden="true">Последняя</span>
            </a>
        @endif
    </div>
@endif
<!-- / modulatte.partials.pagination -->
