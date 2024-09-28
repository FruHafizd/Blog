<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="border rounded-lg divide-y divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                                <div class="py-3 px-4 flex items-center justify-between">
                                    <div class="relative max-w-xs flex-grow">
                                        <label for="hs-table-search" class="sr-only">Search</label>
                                        <input type="text" name="hs-table-with-pagination-search" id="hs-table-with-pagination-search" class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Search for items" wire:model.live="search">
                                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                            <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                                        </div>
                                    </div>
                                    <button type="button" class="ml-4 inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" x-data @click="$dispatch('open-modal', 'add-category')">
                                        Add Category
                                    </button>
                                </div>
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead class="bg-gray-50 dark:bg-neutral-700">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">No</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Category</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Blogs Using Category</th>
                                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @foreach ($categories as $category)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $category->title}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $category->posts_count }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <button type="button" x-data @click.prevent="$dispatch('open-modal', 'category-update-{{ $category->id }}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</button> |

                                                    <button type="button" x-data @click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400">Delete</button>
                                                </td>
                                            </tr>
                                           
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="py-1 px-4">
                                    <nav class="flex items-center space-x-1" aria-label="Pagination">
                                        {{ $categories->links('livewire.partials.posts-pagination') }}  
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="add-category" focusable>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
                {{ __('Add New Category') }}
            </h2>
            <form wire:submit.prevent="addCategory" class="space-y-6">
                <div>
                    <label for="name_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Category Name') }}
                    </label>
                    <input id="name_category" name="name_category" type="text"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                           wire:model="name_category" required />
                    @error('name_category')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" x-on:click="$dispatch('close')"
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Add Category') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    @foreach ($categories as $category)
    <x-modal name="confirm-category-deletion-{{ $category->id }}" focusable>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Confirm Category Deletion
            </h2>
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                Are you sure you want to delete the category:
                <strong class="font-medium text-gray-900 dark:text-gray-100">{{ $category->title }}</strong>?
                This action cannot be undone. All associated data will be permanently removed.
            </p>
            <div class="flex justify-end space-x-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 ease-in-out dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                    Cancel
                </button>
                @if ($category->posts_count)
                <button type="button" 
                    class="px-4 py-2 text-sm font-medium text-white bg-gray-400 border border-transparent rounded-md shadow-sm cursor-not-allowed" disabled>
                    Cannot Delete: Category In Use
                </button>
            @else
                <button type="button" wire:click="deleteCategory({{ $category->id }})"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 ease-in-out dark:bg-red-700 dark:hover:bg-red-800">
                    Delete Category
                </button>
            @endif
            
                
            </div>
        </div>
    </x-modal>
    
    @livewire('partials.modal-update-category', ['categories' => $category->id], key($category->id))



    @endforeach
</div>