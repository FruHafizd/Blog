{{-- https://laravel-livewire.com/docs/1.x/pagination --}}

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-gray-200 text-gray-500 cursor-not-allowed rounded-md">
                Previous
            </span>
        @else
            <button wire:click="previousPage" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Previous
            </button>
        @endif

        {{-- Pagination Elements --}}
        
        {{-- <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center gap-x-2">
            @foreach ($elements as $element)
               
                @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500">{{ $element }}</span>
                @endif

              
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 bg-blue-500 text-white rounded-md">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div> --}}

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                Next
            </button>
        @else
            <span class="px-4 py-2 bg-gray-200 text-gray-500 cursor-not-allowed rounded-md">
                Next
            </span>
        @endif
    </nav>
@endif
