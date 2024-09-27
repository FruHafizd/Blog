<div>
    <!-- Pagination -->
    @if ($paginator->hasPages())
        <div class="py-1 px-4">
            <nav class="flex items-center justify-between" aria-label="Pagination">
                <!-- Previous Page Link -->
                <button wire:click="previousPage" class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" @if ($paginator->onFirstPage()) disabled @endif aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">Previous</span>
                </button>

                <!-- Pagination Elements -->
                @foreach ($elements as $element)
                    <!-- "Three Dots" Separator -->
                    @if (is_string($element))
                        <span class="text-sm text-gray-800 dark:text-white">{{ $element }}</span>
                    @endif

                    <!-- Array Of Links -->
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <button wire:click="gotoPage({{ $page }})" class="min-w-[40px] flex justify-center items-center {{ $page === $paginator->currentPage() ? 'text-gray-800 font-bold' : 'text-gray-600 hover:bg-gray-100' }} focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700" aria-current="{{ $page === $paginator->currentPage() ? 'page' : '' }}">
                                {{ $page }}
                            </button>
                        @endforeach
                    @endif
                @endforeach

                <!-- Next Page Link -->
                <button wire:click="nextPage" class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" @if (!$paginator->hasMorePages()) disabled @endif aria-label="Next">
                    <span aria-hidden="true">»</span>
                    <span class="sr-only">Next</span>
                </button>
            </nav>
        </div>
    @endif
</div>
