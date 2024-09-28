<div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="flex items-center justify-between mb-7">
            <h1 class="text-4xl"><strong>Blog</strong></h1>
            
            <div class="relative inline-block text-left w-64">
                <div class="group">
                    <select wire:model.live="selectedCategory" class="appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
        </div>

        <!-- Grid dengan postingan -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($post as $posts)
            <a class="p-4 transition border border-gray-200 shadow-md group hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-xl" href="{{ route('blog.detail', $posts->slug) }}">
                <div class="w-full h-40 overflow-hidden sm:h-52 lg:h-64 rounded-xl">
                    <img class="object-cover w-full h-full rounded-xl" src="{{ asset('storage/' . $posts->image) }}" alt="Event Image">
                </div>
                <div class="flex justify-end items-center mt-4">
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <span class="size-1.5 inline-block rounded-full bg-blue-800"></span>
                        {{ $posts->categories->title }}
                    </span>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">
                    <strong>{{ $posts->title }}</strong>
                </h3>
                <p class="mt-2 text-gray-600">
                    {{ Str::limit( $posts->content, 180) }}                 
                </p>
                <p class="inline-flex items-center mt-3 text-sm font-semibold text-gray-800 gap-x-1">
                    Learn more
                    <svg class="transition ease-in-out shrink-0 group-hover:translate-x-1 group-focus:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </p>
            </a>
            @endforeach  
        </div>
        <div class="mt-4">
            {{ $post->links('livewire.partials.pagination') }}
        </div>
    </div>
</div>