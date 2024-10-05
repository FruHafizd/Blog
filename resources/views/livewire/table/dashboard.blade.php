<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{-- {{ __("You're logged in!") }} --}}
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                      <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                          <div class="py-3 px-4">
                            <div class="flex justify-between items-center">
                              <div class="relative max-w-xs">
                                <label class="sr-only">Search</label>
                                <input type="text" 
                                name="hs-table-with-pagination-search" 
                                id="hs-table-with-pagination-search" 
                                class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                placeholder="Search for blogs" 
                                wire:model.live.debounce.300ms="search" >
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                  <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                  </svg>
                                </div>
                              </div>
                              <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" x-data @click.prevent="$dispatch('open-modal', 'add-blog')">
                                Add Blog
                              </button>
                            </div>
                          </div>
                          <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                              <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">No</th>
                                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
                                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Title</th>
                                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Content</th>
                                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Category</th>
                                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                                @foreach ($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{$loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $post->user->name ?? 'Unknown' }}</td> <!-- Menampilkan nama pengguna -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ Str::limit($post->title,15) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Str::limit($post->content, 18) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                      <div class="flex space-x-2">
                                          <span class="{{ $post->pin_blog ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-200 dark:text-yellow-900' : 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900' }} text-xs font-medium px-2.5 py-1 rounded">
                                              {{ $post->pin_blog ? 'Pinned' : 'Not Pinned' }}
                                          </span>
                                          <span class="{{ $post->archived ? 'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900' : 'bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900' }} text-xs font-medium px-2.5 py-1 rounded">
                                              {{ $post->archived ? 'Archived' : 'Active' }}
                                          </span>
                                      </div>
                                    </td>                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                          <span class="inline-flex items-center bg-primary-100 text-primary-800 text-xs font-medium px-2 py-1 rounded-full shadow-md mr-2">
                                              <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                  <circle cx="10" cy="10" r="10" class="text-primary-800" />
                                              </svg>
                                                {{$post->categories->title }}
                                          </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                      <button type="button" x-data @click.prevent="$dispatch('open-modal', 'view-blog-{{$post->id}}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">View</button> |
                                      <button type="button" x-data @click.prevent="$dispatch('open-modal', 'confirm-blog-update-{{$post->id}}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-500 dark:hover:text-gray-400 dark:focus:text-gray-400">Update</button> |
                                      <button type="button" x-data @click.prevent="$dispatch('open-modal', 'confirm-blog-deletion-{{$post->id}}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400">Delete</button>
                                    </td>
                                </tr>

                                  @livewire('modal.update-blog-dashboard', ['post' => $post->id], key($post->id))
                              @endforeach
                                  @livewire('modal.make-blog-dashboard')
                              </tbody>
                            </table>
                          </div>
                          <div class="py-1 px-4">
                            <nav class="flex items-center space-x-1" aria-label="Pagination">
  
                              {{ $posts->links('livewire.partials.posts-pagination') }}  

                            </nav>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    @foreach ($posts as $post)

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


   @endforeach

</div>