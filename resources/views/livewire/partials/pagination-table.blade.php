<div>
    <!-- Pagination -->
    <div class="py-1 px-4">
        <nav class="flex items-center space-x-1" aria-label="Pagination">
            <button wire:click="previousPage" class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-label="Previous" @if(!$posts->hasPreviousPage()) disabled @endif>
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </button>
            
            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                <button wire:click="gotoPage({{ $page }})" class="min-w-[40px] flex justify-center items-center {{ $page === $posts->currentPage() ? 'text-gray-800' : 'text-gray-600 hover:bg-gray-100' }} focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700" aria-current="{{ $page === $posts->currentPage() ? 'page' : '' }}">
                    {{ $page }}
                </button>
            @endforeach

            <button wire:click="nextPage" class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-label="Next" @if(!$posts->hasMorePages()) disabled @endif>
                <span aria-hidden="true">»</span>
                <span class="sr-only">Next</span>
            </button>
        </nav>
    </div>
</div>
