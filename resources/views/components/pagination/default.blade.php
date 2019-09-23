@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}"
           rel="prev" @if($paginator->onFirstPage()) disabled aria-disabled @endif>@lang('pagination.previous')</a>

        <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next"
           @if(!$paginator->hasMorePages()) disabled aria-disabled @endif>@lang('pagination.next')</a>

        <ul class="pagination-list">

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true"><span class="pagination-ellipsis">&hellip;</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li aria-current="page">
                            <a href="{{ $url }}"
                               class="pagination-link @if($page == $paginator->currentPage()) is-current @endif"
                               aria-label="Goto page {{ $page }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

        </ul>
    </nav>

@endif
