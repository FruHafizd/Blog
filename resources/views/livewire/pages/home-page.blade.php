<div  class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <h1 class="text-4xl mb-7"><strong>Pin Blog</strong></h1>

        <!-- Grid -->
        <div class="grid lg:grid-cols-2 gap-6">

        <!-- Card -->
        <a class="group relative block rounded-xl focus:outline-none" href="#">
            <div class="shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">
            <img class="size-full absolute top-0 start-0 object-cover" src="https://images.unsplash.com/photo-1669828230990-9b8583a877ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Blog Image">
            </div>

            <div class="absolute bottom-0 inset-x-0 z-10">
            <div class="flex flex-col h-full p-4 sm:p-6">
                <h3 class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/80 group-focus:text-white/80">
                Facebook is creating a news section in Watch to feature breaking news
                </h3>
            </div>
            </div>
        </a>
        <!-- End Card -->
        </div>
        <!-- End Grid -->
    </div>

    <hr>
    
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <h1 class="text-4xl mb-7"><strong>The latest</strong></h1>
        
        <!-- Grid dengan postingan -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($post as $posts)
            <a class="p-4 transition border border-gray-200 shadow-md group hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-xl" href="/{{ $posts->slug }}">
                <div class="w-full h-40 overflow-hidden sm:h-52 lg:h-64 rounded-xl">
                    <img class="object-cover w-full h-full rounded-xl" src="{{ asset('storage/' . $posts->image) }}" alt="Event Image">
                    {{-- <img class="object-cover w-full h-full rounded-xl" src="{{ $posts->image }}" alt="Event Image"> --}}
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
        
        <!-- Tombol "View All" di pojok kanan bawah -->
        <div class="relative mt-6">
            <a  href="{{ route('blog') }}" class="absolute right-0 inline-flex items-center text-sm font-semibold text-gray-800 gap-x-1 hover:text-blue-600 transition ease-in-out duration-300">
                View All
                <svg class="transition-transform ease-in-out duration-300 shrink-0 group-hover:translate-x-1 group-focus:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>
    </div>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <h1 class="text-4xl mb-7"><strong>Most Read</strong></h1>
        
        <!-- Grid dengan postingan -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($mostReadPosts as $posts)
            <a class="p-4 transition border border-gray-200 shadow-md group hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-xl" href="{{ route('blog.detail', $posts->slug) }}">
                <div class="w-full h-40 overflow-hidden sm:h-52 lg:h-64 rounded-xl">
                    <img class="object-cover w-full h-full rounded-xl" src="{{ asset('storage/' . $posts->image) }}" alt="Event Image">
                    {{-- <img class="object-cover w-full h-full rounded-xl" src="{{ $posts->image }}" alt="Event Image"> --}}
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
        
        <!-- Tombol "View All" di pojok kanan bawah -->
        <div class="relative mt-6">
            <a  href="{{ route('blog') }}" class="absolute right-0 inline-flex items-center text-sm font-semibold text-gray-800 gap-x-1 hover:text-blue-600 transition ease-in-out duration-300">
                View All
                <svg class="transition-transform ease-in-out duration-300 shrink-0 group-hover:translate-x-1 group-focus:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>
    </div>
    
  
   









</div>