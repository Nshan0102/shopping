@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            @php
                $before = true;
            @endphp
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @elseif($page == 1)
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @if($paginator->lastPage() > 15 && $paginator->currentPage() > 6 && $before)
                                @php
                                    $before = false;
                                @endphp
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                            @endif
                        @elseif($page == $paginator->lastPage())
                            @if($paginator->lastPage() > 15 && $paginator->currentPage() < $paginator->lastPage() - 5)
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                            @endif
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif($page > ($paginator->currentPage() - 5) && $page < $paginator->currentPage())
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif($page < ($paginator->currentPage() + 5) && $page > $paginator->currentPage())
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
