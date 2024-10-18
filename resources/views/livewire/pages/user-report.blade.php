<!-- user-reports-list.blade.php -->
<div class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold mb-8 text-gray-800 dark:text-white text-center">Your Reports</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($reports as $report)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $report->category }}</h3>
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $report->is_read ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ $report->is_read_user ? 'Unread' : 'Read' }}
                        </span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ $report->message }}</p>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $report->created_at->format('M d, Y') }}
                        </span>
                        <button x-data @click.prevent="$dispatch('open-modal', 'report-view-{{$report->id}}')"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-gray-100 dark:bg-gray-700 rounded-lg">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-2xl font-semibold">You haven't submitted any reports yet.</p>
                <p class="mt-2 text-gray-400 dark:text-gray-500">When you do, they'll appear here.</p>
            </div>
        @endforelse
    </div>

    @foreach ($reports as $report)
    <x-modal name="report-view-{{$report->id}}" focusable>
        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:w-full">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Report Details</h2>
                    <button type="button" x-on:click="$dispatch('close')" 
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <div class="mb-6">
                            <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Name:</strong>
                            <p class="text-gray-900 dark:text-white text-xl">{{ $report->user->name }}</p>
                        </div>
        
                        <div class="mb-6">
                            <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Email:</strong>
                            <p class="text-gray-900 dark:text-white text-xl">{{ $report->user->email }}</p>
                        </div>
                        
                        <div class="mb-6">
                            <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Category:</strong>
                            <p class="text-gray-900 dark:text-white text-xl">{{ $report->category }}</p>
                        </div>
                        
                        <div class="mb-6">
                            <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Status:</strong>
                            <span class="px-3 py-1 text-sm font-bold rounded-full {{ $report->is_read_user ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $report->is_read_user ? 'Read' : 'Unread' }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-6">
                            <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Your Message:</strong>
                            <p class="text-gray-900 dark:text-white whitespace-pre-wrap text-lg">{!! nl2br(e($report->message)) !!}</p>
                        </div>
                        
                        <div class="mb-6">
                            <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Image:</strong>
                            @if($report->image)
                                <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" class="mt-2 rounded-lg max-w-full h-auto shadow-lg">
                            @else
                                <p class="text-gray-500 dark:text-gray-400 italic text-lg">No image attached</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <strong class="text-gray-700 dark:text-gray-300 block mb-2 text-lg">Response:</strong>
                    <p class="text-gray-900 dark:text-white text-lg">
                        @if ($report->admin_response)
                            {{ $report->admin_response }}
                        @else
                            <p class="text-gray-500 dark:text-gray-400 italic">Your report has not been responded to by the admin yet.</p>
                        @endif
                    </p>
                </div>
    
                <div class="flex justify-end mt-8 space-x-4">
                    <button type="button" 
                    class="flex-1 inline-flex items-center justify-center px-6 py-3 text-lg font-semibold text-green-600 border-2 border-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors duration-300"
                    x-on:click="$wire.makeIsRead({{ $report->id }})">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Mark as Read
                    </button>
                    <button type="button" 
                            class="inline-flex items-center px-6 py-3 text-lg font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-300"
                            x-on:click="$wire.deleteReport({{ $report->id }})">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Report
                    </button>
                    <button type="button" 
                            class="inline-flex items-center px-6 py-3 text-lg font-medium text-gray-700 bg-gray-100 border border-transparent rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-300"
                            x-on:click="$dispatch('close')">
                        Close
                    </button>
                </div>
            </div>
        </div>  
    </x-modal>
    @endforeach
    
</div>