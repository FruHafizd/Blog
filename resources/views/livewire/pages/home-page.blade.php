<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <!-- Pin Blog Section -->
  <section class="mb-20">
      <h2 class="text-4xl font-bold text-gray-900 mb-10">Featured Posts</h2>
      <div class="grid md:grid-cols-2 gap-10">
          @foreach ($pinBlog as $blog)
          <a href="/{{ $blog->slug }}" class="group">
              <div class="relative overflow-hidden rounded-3xl shadow-lg transition-all duration-300 hover:shadow-2xl">
                  <div class="aspect-w-16 aspect-h-9">
                      <img class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110" src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                  </div>
                  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/50 to-transparent opacity-80 transition-opacity duration-300 group-hover:opacity-90"></div>
                  <div class="absolute bottom-0 left-0 p-8">
                      <h3 class="text-3xl font-bold text-white mb-2 transition-all duration-300 group-hover:translate-y-[-5px]">{{ $blog->title }}</h3>
                      <p class="text-gray-200 text-sm hidden md:block">Read article</p>
                  </div>
              </div>
          </a>
          @endforeach
      </div>
  </section>

  <!-- Latest Posts Section -->
  <section class="mb-20">
      <h2 class="text-4xl font-bold text-gray-900 mb-10">Latest Articles</h2>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
          @foreach ($post as $posts)
          <article class="group">
              <div class="overflow-hidden rounded-3xl shadow-md transition-all duration-300 group-hover:shadow-xl">
                  <div class="aspect-w-16 aspect-h-9">
                      <img class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110" src="{{ asset('storage/' . $posts->image) }}" alt="{{ $posts->title }}">
                  </div>
              </div>
              <div class="mt-6">
                  <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full mb-4">
                      {{ $posts->categories->title }}
                  </span>
                  <h3 class="text-xl font-bold text-gray-900 mb-3 transition-colors duration-300 group-hover:text-blue-600">{{ $posts->title }}</h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">{{ $posts->short_description }}</p>
                  <a href="/{{ $posts->slug }}" class="inline-flex items-center text-blue-600 font-semibold transition-all duration-300 group-hover:translate-x-1">
                      Read more
                      <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                  </a>
              </div>
          </article>
          @endforeach
      </div>
      <div class="text-right mt-10">
          <a href="{{ route('blog') }}" class="inline-flex items-center text-blue-600 font-semibold group transition-all duration-300 hover:translate-x-1">
              View All Articles
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
          </a>
      </div>
  </section>

  <!-- Most Read Section -->
  <section>
      <h2 class="text-4xl font-bold text-gray-900 mb-10">Most Popular</h2>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
          @foreach ($mostReadPosts as $posts)
          <article class="group">
              <div class="overflow-hidden rounded-3xl shadow-md transition-all duration-300 group-hover:shadow-xl">
                  <div class="aspect-w-16 aspect-h-9">
                      <img class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110" src="{{ asset('storage/' . $posts->image) }}" alt="{{ $posts->title }}">
                  </div>
              </div>
              <div class="mt-6">
                  <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full mb-4">
                      {{ $posts->categories->title }}
                  </span>
                  <h3 class="text-xl font-bold text-gray-900 mb-3 transition-colors duration-300 group-hover:text-blue-600">{{ $posts->title }}</h3>
                  <p class="text-gray-600 mb-4 line-clamp-2">{{ $posts->short_description }}</p>
                  <a href="{{ route('blog.detail', $posts->slug) }}" class="inline-flex items-center text-blue-600 font-semibold transition-all duration-300 group-hover:translate-x-1">
                      Read more
                      <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                  </a>
              </div>
          </article>
          @endforeach
      </div>
      <div class="text-right mt-10">
          <a href="{{ route('blog') }}" class="inline-flex items-center text-blue-600 font-semibold group transition-all duration-300 hover:translate-x-1">
              View All Popular Articles
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
          </a>
      </div>
  </section>
</div>
