<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-10">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-4 sm:mb-0 transition duration-300 hover:text-blue-600">Blog</h1>
        
        <div class="relative w-full sm:w-64">
            <select wire:model.live="selectedCategory" class="w-full bg-white border border-gray-300 rounded-lg py-3 px-4 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out text-gray-700 shadow-lg">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($post as $posts)
        <article class="bg-white rounded-3xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105 group">
            <a href="{{ route('blog.detail', $posts->slug) }}" class="block">
                <div class="relative w-full h-0" style="padding-top: 56.25%;"> <!-- Aspect ratio 16:9 -->
                    <img class="absolute top-0 left-0 object-cover w-full h-full transition-transform duration-300 group-hover:scale-110" src="{{ asset('storage/' . $posts->image) }}" alt="{{ $posts->title }}">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-200 text-blue-800 shadow-md">
                            {{ $posts->categories->title }}
                        </span>
                        <span class="text-sm text-gray-500">{{ $posts->created_at->format('M d, Y') }}</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">{{ $posts->title }}</h2>
                    <p class="text-gray-700 mb-4 line-clamp-3">{{ Str::limit($posts->content, 150) }}</p>
                    <div class="flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform duration-300">
                        Read more
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </article>
        @endforeach  
    </div>

    <div class="mt-10">
        {{ $post->links('livewire.partials.pagination') }}
    </div>
</div>
