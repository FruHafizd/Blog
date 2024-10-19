<div class="py-12 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 min-h-screen">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-8">
              <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Blog Management</h2>
              
              <div class="mb-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                  <div class="relative w-full sm:w-64">
                      <input type="text" 
                          wire:model.live.debounce.300ms="search"
                          class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm dark:bg-gray-700 dark:text-white"
                          placeholder="Search blogs">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                          </svg>
                      </div>
                  </div>
                  <button 
                      type="button" 
                      x-data 
                      @click="$dispatch('open-modal', 'add-blog')"
                      class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                      <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                      </svg>
                      Add New Blog
                  </button>
              </div>

              @if($posts->isEmpty())
                  <div class="text-center py-12">
                      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                      </svg>
                      <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-200">No blogs found</h3>
                      <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new blog post.</p>
                      <div class="mt-6">
                          <button 
                              type="button" 
                              x-data 
                              @click="$dispatch('open-modal', 'add-blog')"
                              class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                              <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                              </svg>
                              Create New Blog
                          </button>
                      </div>
                  </div>
              @else
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                      @foreach ($posts as $post)
                      <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg rounded-lg transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl">
                          <div class="p-6">
                              <div class="flex justify-between items-start mb-4">
                                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ Str::limit($post->title, 30) }}</h3>
                                  <span class="text-sm text-gray-500 dark:text-gray-400">#{{ $loop->iteration }}</span>
                              </div>
                              <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">{{ Str::limit($post->content, 100) }}</p>
                              <div class="flex items-center justify-between mb-4">
                                  <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $post->user->name ?? 'Unknown' }}</span>
                                  <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                      {{ $post->categories->title }}
                                  </span>
                              </div>
                              <div class="flex items-center space-x-2 mb-4">
                                  <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->pin_blog ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' : 'bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-100' }}">
                                      {{ $post->pin_blog ? 'Pinned' : 'Not Pinned' }}
                                  </span>
                                  <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->archived ? 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' : 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' }}">
                                      {{ $post->archived ? 'Archived' : 'Active' }}
                                  </span>
                              </div>
                              <div class="flex justify-end space-x-2">
                                  <button type="button" x-data @click="$dispatch('open-modal', 'view-blog-{{$post->id}}')" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium transition duration-150 ease-in-out">View</button>
                                  <button type="button" x-data @click="$dispatch('open-modal', 'confirm-blog-update-{{$post->id}}')" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium transition duration-150 ease-in-out">Update</button>
                                  <button type="button" x-data @click="$dispatch('open-modal', 'confirm-blog-deletion-{{$post->id}}')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium transition duration-150 ease-in-out">Delete</button>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>

                  <div class="mt-8">
                      {{ $posts->links('livewire.partials.pagination') }}
                  </div>
              @endif
          </div>
      </div>
  </div>

  @livewire('modal.make-blog-dashboard')

  @foreach ($posts as $post)
    @livewire('modal.update-blog-dashboard', ['post' => $post->id], key($post->id))

    {{-- Blog Deletion Confirmation Modal --}}
    <x-modal name="confirm-blog-deletion-{{ $post->id }}" :show="$errors->blogDeletion->isNotEmpty()" focusable>
      <div class="p-6">
          {{-- Header --}}
          <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200">
              {{ __('Confirm Article Deletion') }}
          </h2>
      
          {{-- Body --}}
          <p class="mt-4 text-sm text-gray-700 dark:text-gray-400">
              {{ __('You are about to delete the article titled:') }} 
              <strong class="font-medium">{{ $post->title }}</strong>
          </p>
          <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
              {{ __('This action is permanent and cannot be undone. All data associated with this article will be permanently removed from the system.') }}
          </p>
          <p class="mt-2 text-sm font-semibold text-gray-700 dark:text-gray-400">
              {{ __('Are you sure you want to proceed?') }}
          </p>
          
          {{-- Action Buttons --}}
          <div class="mt-8 flex justify-end space-x-3">
              <button x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                  {{ __('Cancel') }}
              </button>

              <button type="button" 
              x-on:click="$wire.deleteBlog({{ $post->id }})" 
              {{-- Di atas pakai direktif alpine js --}}
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 ease-in-out">
                Delete Blog
              </button>
        
          </div>
      </div>
    </x-modal>
      
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
  @endforeach
  
</div>

