<div>

    
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($post as $posts)
            <a class="p-4 transition border border-gray-200 shadow-md group hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-xl" href="/{{ $posts->slug }}">
                <div class="w-full h-40 overflow-hidden sm:h-52 lg:h-64 rounded-xl">
                    <img class="object-cover w-full h-full rounded-xl" src="{{ asset('storage/' . $posts->image) }}" alt="Event Image">
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">
                    {{ $posts->title }}
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
    </div>
  










</div>