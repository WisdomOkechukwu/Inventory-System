@if ($paginator->hasPages())
    <div class="row g-0 align-items-center justify-content-between text-center text-sm-start p-3 border-top">
        <div class="col-sm">
            <div class="text-muted">
                Showing <span class="fw-semibold">{{ $paginator->firstItem() }}</span> to 
                <span class="fw-semibold">{{ $paginator->lastItem() }}</span> of 
                <span class="fw-semibold">{{ $paginator->total() }}</span> Results
            </div>
        </div>
        <div class="col-sm-auto mt-3 mt-sm-0">
            <ul class="pagination m-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link"><i class='bx bx-left-arrow-alt'></i></a>
                    </li>
                @else
                    <li class="page-item">
                        <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev"><i class='bx bx-left-arrow-alt'></i></a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active">
                                    <a class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next"><i class='bx bx-right-arrow-alt'></i></a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link"><i class='bx bx-right-arrow-alt'></i></a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
