<div>
    <x-modal name="view-blog-{{$post->id}}" :show="$errors->userBannedError->isNotEmpty()" focusable>
        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:w-full">
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $post->title }}</h2>
                    <button type="button" x-on:click="$dispatch('close')" 
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg mb-4">
                        @else
                            <div class="bg-gray-100 dark:bg-gray-700 h-64 flex items-center justify-center rounded-lg mb-4">
                                <span class="text-gray-400 dark:text-gray-500 text-lg">No image available</span>
                            </div>
                        @endif

                        <div class="prose dark:prose-invert max-w-none mb-6">
                            Short Description :
                            {{ $post->short_description ?? 'No content available' }}
                        </div>

                        <div class="flex justify-start">
                            <a href="{{ route('blog.detail', $post->slug) }}" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                View Public Blog
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Post Details</h3>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Author</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $post->user->name ?? 'Unknown Author' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $post->category->name ?? 'Uncategorized' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Published Date</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d F Y') : 'Not published' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">View Count</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $post->view_count ?? 0 }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white break-all">{{ $post->slug }}</dd>
                            </div>
                            @if($post->pin_blog)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                    <dd class="mt-1">
                                        <span class="bg-yellow-100 text-yellow-800 dark:bg-yellow-200 dark:text-yellow-900 text-xs font-medium px-2.5 py-0.5 rounded">Pinned</span>
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>
</div>