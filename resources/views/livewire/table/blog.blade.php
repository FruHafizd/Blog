<div class="py-12 bg-gray-100 dark:bg-gray-900">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:p-8">
              <div class="flex flex-col">
                  <div class="mb-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                      <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Your Blog Posts</h2>
                      <div class="flex items-center space-x-4">
                          <div class="relative">
                              <input type="text" 
                                  name="search" 
                                  id="search" 
                                  class="w-full sm:w-64 py-2 px-4 pr-10 text-sm bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                  placeholder="Search blogs..." 
                                  wire:model.live.debounce.300ms="search">
                              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                  <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                  </svg>
                              </div>
                          </div>
                          <a href="{{ route('blog.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                              New Blog
                          </a>
                      </div>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                      @forelse ($posts as $post)
                          <div class="bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                              <div class="relative pb-48 overflow-hidden">
                                  <img class="absolute inset-0 h-full w-full object-cover" src="{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/800x600.png?text=No+Image' }}" alt="{{ $post->title }}">
                                  @if($post->pin_blog)
                                      <div class="absolute top-0 right-0 mt-4 mr-4 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10">PINNED</div>
                                  @endif
                              </div>
                              <div class="p-6">
                                  <div class="flex justify-between items-start mb-4">
                                      <h3 class="text-xl font-semibold text-gray-900 dark:text-white truncate">{{ $post->title }}</h3>
                                      <span class="{{ $post->archived ? 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900' : 'bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900' }} text-xs font-medium px-2.5 py-1 rounded-full">
                                          {{ $post->archived ? 'Archived' : 'Active' }}
                                      </span>
                                  </div>
                                  <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ Str::limit($post->content, 120) }}</p>
                                  <div class="flex justify-between items-center">
                                      <div class="flex items-center">
                                          
                                          <span class="text-sm text-gray-600 dark:text-gray-400">{{ $post->user->name }}</span>
                                      </div>
                                      <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                          {{ $post->categories->title }}
                                      </span>
                                  </div>
                              </div>
                              <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                  <div class="flex justify-between items-center">
                                      <div class="text-sm text-gray-600 dark:text-gray-400">
                                          <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                          </svg>
                                          {{ $post->created_at->diffForHumans() }}
                                      </div>
                                      <div class="flex space-x-2">
                                          <button type="button" x-data @click.prevent="$dispatch('open-modal', 'view-blog-{{$post->id}}')" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition duration-150 ease-in-out">
                                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                          </button>
                                          <button type="button" x-data @click.prevent="$dispatch('open-modal', 'confirm-blog-deletion-{{$post->id}}')" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition duration-150 ease-in-out">
                                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @empty
                          <div class="col-span-full flex items-center justify-center bg-white dark:bg-gray-700 rounded-xl p-8 shadow-md">
                              <div class="text-center">
                                  <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                  </svg>
                                  <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No blogs found</h3>
                                  <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Get started by creating your first blog post.</p>
                                  <div class="mt-6">
                                      <a href="{{ route('blog.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                          <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                          Create New Blog
                                      </a>
                                  </div>
                              </div>
                          </div>
                      @endforelse
                  </div>

                  <div class="mt-8">
                        {{ $posts->links('livewire.partials.pagination') }}
                  </div>
              </div>
          </div>
      </div>
  </div>

  @foreach ($posts as $post)
      {{-- Blog Information Modal --}}
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

                  <div class="prose dark:prose-invert max-w-none mb-6 text-gray-900 dark:text-gray-100">
                    Short Description:
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
                          <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $post->categories->title ?? 'Uncategorized' }}</dd>
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

      {{-- Confirm Blog Deletion Modal --}}
      <x-modal name="confirm-blog-deletion-{{$post->id}}" :show="$errors->blogDeletion->isNotEmpty()" focusable>
              <form method="post" action="{{ route('your-blog.delete', $post->id) }}" class="p-6 bg-white rounded-lg shadow-md">
              @csrf
              @method('DELETE')
      
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-900">
                  {{ __('Confirm Deletion') }}
              </h2>
      
              <p class="mt-1 text-sm text-gray-700 dark:text-gray-600">
                  {{ __('Are you sure you want to delete the blog with the slug:') }} 
                  <strong class="font-medium">{{ $post->slug }}</strong>?
                  {{ __('This action is irreversible. Once deleted, all related data will be permanently removed.') }}
              </p>
      
              <div class="mt-6">
                  <x-input-label for="blog-title" value="{{ __('Blog Title') }}" class="sr-only" />
      
                  <input
                      id="blog_slug"
                      name="blog_slug"
                      type="text"
                      placeholder="Enter Blog Slug to confirm"
                      class="mt-1 block w-full md:w-3/4 border border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                      required
                  />
              </div>
      
              <div class="mt-6 flex justify-end">
                  <x-secondary-button x-on:click="$dispatch('close')">
                      {{ __('Cancel') }}
                  </x-secondary-button>
      
                  <x-danger-button class="ms-3">
                      {{ __('Delete This Blog') }}
                  </x-danger-button>
              </div>
          </form>
      </x-modal>
  @endforeach
</div>