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
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Email</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Category</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Message</th>
                                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @foreach ($report as $reports)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $reports->user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $reports->user->email }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $reports->category }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    <div class="flex items-center">
                                                        {{ Str::limit($reports->message, 30) }}
                                                        @if(!$reports->is_read)
                                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                                New
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <button type="button" 
                                                            x-data 
                                                            @click.prevent="$dispatch('open-modal', 'report-view-{{ $reports->id }}')" 
                                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:bg-blue-900 dark:focus:ring-offset-gray-800">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        View Report
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @if ($report->isEmpty())
                                    <div class="col-span-full text-center py-20 rounded-lg">
                                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400 text-2xl font-semibold">No reports available at the moment.</p>
                                        <p class="mt-2 text-gray-400 dark:text-gray-500">Once reports are submitted, they will be displayed here.</p>
                                    </div>
                                    @endif
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
                    <strong class="text-gray-700 dark:text-gray-300">Email:</strong>
                    <p class="text-gray-900 dark:text-white">{{ $reports->user->email }}</p>
                </div>
                
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Category:</strong>
                    <p class="text-gray-900 dark:text-white">{{ $reports->category }}</p>
                </div>
                
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Message:</strong>
                    <p class="text-gray-900 dark:text-white">{!! nl2br(e($reports->message)) !!}</p>
                </div>
                
                <!-- New Image Section -->
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Image:</strong>
                    @if($reports->image)
                        <img src="{{ asset('storage/' . $reports->image) }}" alt="Report Image" class="mt-2 rounded-lg max-w-full h-auto">
                    @else
                        <p class="text-gray-500 dark:text-gray-400 italic">No image attached</p>
                    @endif
                </div>
    
                <!-- Admin Reply Form -->
                <form wire:submit.prevent="sendReply({{ $reports->id }})" class="mb-4">
                    <div>
                        <label for="reply" class="block text-gray-700 dark:text-gray-300 font-semibold">Reply to User:</label>
                        <textarea wire:model.defer="reply" id="reply" rows="4" 
                                  class="mt-2 w-full rounded-lg border border-gray-300 dark:border-neutral-600 
                                         focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 
                                         dark:text-white dark:placeholder-gray-400" 
                                  placeholder="Write your reply here..."></textarea>
                        @error('reply') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 
                                       rounded-lg hover:bg-blue-700 transition-colors duration-300">
                            Send Reply
                        </button>
                    </div>
                </form>
    
                <div class="flex justify-between mt-6 space-x-4">
                    <button type="button" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-red-600 border border-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors duration-300"
                            x-on:click="$wire.deleteReport({{ $reports->id }})">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Report
                    </button>
                    <button type="button" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-green-600 border border-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors duration-300"
                            x-on:click="$wire.makeIsRead({{ $reports->id }})">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Mark as Read
                    </button>
                    <button type="button" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-300"
                            x-on:click="$dispatch('close')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Close
                    </button>
                </div>
            </div>
        </div>  
    </x-modal>
    

@endforeach



</div>