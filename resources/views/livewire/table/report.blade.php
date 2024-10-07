<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border rounded-lg divide-y divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                                <div class="py-3 px-4 flex items-center justify-between">
                                    <div class="relative max-w-xs flex-grow">
                                        <label for="hs-table-search" class="sr-only">Search</label>
                                        <input type="text" 
                                            name="hs-table-with-pagination-search" 
                                            id="hs-table-with-pagination-search" 
                                            class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                            placeholder="Search for items" 
                                            wire:model.live.debounce.300ms="search">

                                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                            <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead class="bg-gray-50 dark:bg-neutral-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">No</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name User</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Category</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Message</th>
                                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @foreach ($report as $reports)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $reports->user->name}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $reports->category}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Str::limit($reports->message,30)}}</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <button type="button" x-data @click.prevent="$dispatch('open-modal', 'report-view-{{ $reports->id }}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">View Report</button>
                                                </td>
                                            </tr>
                                           
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-1 px-4">
                                    <nav class="flex items-center space-x-1" aria-label="Pagination">
                                        {{ $report->links('livewire.partials.posts-pagination') }}  
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($report as $reports)
    
    <x-modal name="report-view-{{$reports->id}}" :show="$errors->userBannedError->isNotEmpty()" focusable>
        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6 border-b border-gray-200 dark:border-neutral-700 pb-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Report</h2>
                    <button type="button" x-on:click="$dispatch('close')" 
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Name User:</strong>
                    <p class="text-gray-900 dark:text-white">{{ $reports->user->name }}</p>
                </div>
                
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Category:</strong>
                    <p class="text-gray-900 dark:text-white">{{ $reports->category }}</p>
                </div>
                
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Message:</strong>
                    <p class="text-gray-900 dark:text-white">{!! nl2br(e($reports->message)) !!}</p>
                </div>
                

                <div class="flex justify-between mt-6">
                    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-red-600 border border-red-600 rounded-lg hover:bg-red-600 hover:text-white dark:hover:bg-red-700"
                    x-on:click="$wire.deleteReport({{ $reports->id }})" 
                    >
                        Delete Report
                    </button>
                    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600" 
                            x-on:click="$dispatch('close')">
                        Close
                    </button>
                </div>
            </div>
        </div>  
    </x-modal>

@endforeach



</div>