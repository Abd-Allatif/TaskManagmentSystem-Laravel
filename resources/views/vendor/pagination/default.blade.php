@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="previous disabled" aria-disabled="true"><span>&lsaquo;</span></li>
            @else
                <li class="previous"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="dots disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="links active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="links"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
            @else
                <li class="next disabled" aria-disabled="true"><span>&rsaquo;</span></li>
            @endif
        </ul>
    </nav>
@endif


<style>
    .pagination {
        align-self: center;
        justify-self: center;

        align-content: center;
        justify-items: center;

        width: 550px;
        background: #f8f9fd;
        background: linear-gradient(0deg,
                rgb(255, 255, 255) 0%,
                rgb(244, 247, 251) 100%);
        border-radius: 20px;
        padding: 25px 35px;
        border: 5px solid rgb(255, 255, 255);
        box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
        margin: 20px;
        list-style: none;

        display: flex;
        flex-direction: row;
    }

    .previous {
        margin-right: 20px;
        justify-self: flex-start;
        font-size: 20px;
    }

    ul.pagination {
        display: flex;
        flex-wrap: nowrap;
        /* prevents wrapping */
        overflow-x: auto;
        /* allows horizontal scroll */
        gap: 6px;
        padding-left: 0;
        list-style: none;
        white-space: nowrap;
    }

    ul.pagination li a,
    ul.pagination li span {
        display: inline-block;
        padding: 6px 12px;
        font-size: 16px;
        border-radius: 6px;
        text-decoration: none;
    }

    ul.pagination li.active span {
        background: linear-gradient(45deg,
                rgb(16, 137, 211) 0%,
                rgb(18, 177, 209) 100%);
        color: #fff;
    }

    li.disabled span,
    li.dots span {
        color: #999;
    }

    .next {
        margin-left: 20px;
        justify-self: flex-end;
        font-size: 20px;
    }
</style>
