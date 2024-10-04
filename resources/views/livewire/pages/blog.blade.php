<div class="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 md:mb-0 relative">
                Blog
                <span class="absolute bottom-0 left-0 w-1/2 h-1 bg-blue-500"></span>
            </h1>
            
            <div class="w-full md:w-64">
                <select wire:model.live="selectedCategory" class="w-full bg-white border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 shadow-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($post as $posts)
            <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                <a href="{{ route('blog.detail', $posts->slug) }}" class="block">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $posts->image) }}" alt="{{ $posts->title }}">
                        <div class="absolute top-0 right-0 m-2">
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full shadow-md">
                                {{ $posts->categories->title }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm text-gray-500">{{ $posts->created_at->format('M d, Y') }}</span>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2 hover:text-blue-600 transition-colors duration-200">{{ $posts->title }}</h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($posts->content, 100) }}</p>
                        <span class="text-blue-600 font-medium hover:underline">Read more &rarr;</span>
                    </div>
                </a>
            </article>
            @endforeach  
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $post->links('livewire.partials.pagination') }}
        </div>
    </div>
</div>