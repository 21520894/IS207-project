@if ($paginator->hasPages())
    <nav>
        <ul class="pagination" style="display: flex;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif
                @php
                    $current_url = request()->category_type;
                    if(!empty($current_url)){
                        $current_url = '&category_type='.$current_url;
                    }
                @endphp
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{$url}}{{$current_url}}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
    <style>
        .pagination {
            margin-top: 10px;
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin-right: 5px;
            font-size: 16px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 5px 10px;
            text-decoration: none;
            border: 2px solid #ccc;
            color: #333;
            border-radius: 3px;
        }

        .pagination li.active span {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination li a:hover {
            background-color: #f0f0f0;
            text-decoration: none;
        }
    </style>
@endif
