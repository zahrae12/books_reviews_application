@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex  my-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded-md">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 bg-gray-600 text-white hover:bg-orange-700 rounded-md">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1  text-yellow-900 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1  text-yellow-900 hover:bg-orange-700 rounded-md">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 bg-orange-600 text-white hover:bg-orange-700 rounded-md">Next</a>
        @else
            <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded-md">Next</span>
        @endif
    </nav>
@endif
