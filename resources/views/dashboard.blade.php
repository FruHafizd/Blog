<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                                <div class="relative max-w-xs">
                                  <label class="sr-only">Search</label>
                                  <input type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Search for items">
                                  <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                    <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                      <circle cx="11" cy="11" r="8"></circle>
                                      <path d="m21 21-4.3-4.3"></path>
                                    </svg>
                                  </div>
                                </div>
                              </div>
                              <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                  <thead class="bg-gray-50 dark:bg-neutral-700">
                                    <tr>
                                      <th scope="col" class="py-3 px-4 pe-0">
                                        <div class="flex items-center h-5">
                                          <input id="hs-table-pagination-checkbox-all" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                          <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                        </div>
                                      </th>
                                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
                                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Title</th>
                                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Content</th>
                                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                                    @foreach (\App\Models\Posts::all() as $post)
                                    <tr>
                                        <td class="py-3 ps-4">
                                            <div class="flex items-center h-5">
                                                <input id="hs-table-pagination-checkbox-{{ $post->id }}" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                <label for="hs-table-pagination-checkbox-{{ $post->id }}" class="sr-only">Checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $post->user->name ?? 'Unknown' }}</td> <!-- Menampilkan nama pengguna -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $post->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Str::limit($post->content, 30) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                          <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">View</button> |
                                          <button type="button" x-data @click.prevent="$dispatch('open-modal', 'confirm-blog-update-{{$post->id}}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-500 dark:hover:text-gray-400 dark:focus:text-gray-400">Update</button> |
                                          <button type="button" x-data @click.prevent="$dispatch('open-modal', 'confirm-blog-deletion-{{$post->id}}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400">Delete</button>

                                          
                                              

                                        </td>
                                    </tr>
                                  @endforeach

                                  </tbody>
                                </table>
                              </div>
                              <div class="py-1 px-4">
                                <nav class="flex items-center space-x-1" aria-label="Pagination">
                                  <button type="button" class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                    <span class="sr-only">Previous</span>
                                  </button>
                                  <button type="button" class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700" aria-current="page">1</button>
                                  <button type="button" class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700">2</button>
                                  <button type="button" class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:focus:bg-neutral-700 dark:hover:bg-neutral-700">3</button>
                                  <button type="button" class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-label="Next">
                                    <span class="sr-only">Next</span>
                                    <span aria-hidden="true">»</span>
                                  </button>
                                </nav>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    @foreach (\App\Models\Posts::all() as $post)

        {{-- Modal delete blog --}}
        <x-modal name="confirm-blog-deletion-{{$post->id}}" :show="$errors->blogDeletion->isNotEmpty()" focusable>
          <form method="post" action="{{ route('blog.delete', $post->id) }}" class="p-6 bg-white rounded-lg shadow-md">
              @csrf
              @method('DELETE')
      
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-900">
                  {{ __('Confirm Deletion') }}
              </h2>
      
              <p class="mt-1 text-sm text-gray-700 dark:text-gray-600">
                  {{ __('Are you sure you want to delete the blog titled:') }} <strong>{{ $post->title }}</strong>?
                  {{ __('This action cannot be undone. Once deleted, all of its resources and data will be permanently removed.') }}
              </p>
      
              <div class="mt-6">
                  <x-input-label for="blog-title" value="{{ __('Blog Title') }}" class="sr-only" />
      
                  <input
                      id="blog_title"
                      name="blog_title"
                      type="text"
                      placeholder="Enter Blog Title"
                      class="mt-1 block w-3/4 border border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
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

      @livewire('partials.update-post-admin', ['post' => $post->id])


    @endforeach
    



</x-app-layout>
