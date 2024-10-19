<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <div class="w-full sm:w-64 mb-4 sm:mb-0">
                        <div class="relative">
                            <input type="text" 
                                wire:model.live.debounce.300ms="search"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                                placeholder="Search categories">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <button 
                        @click="$dispatch('open-modal', 'add-category')"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:scale-105"
                    >
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Category
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($categories as $category)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $category->title }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                                    {{ $category->posts_count }} blog{{ $category->posts_count != 1 ? 's' : '' }} using this category
                                </p>
                                <div class="flex justify-end space-x-2">
                                    <button 
                                        @click="$dispatch('open-modal', 'category-update-{{ $category->id }}')"
                                        class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 transition duration-150 ease-in-out"
                                    >
                                        Edit
                                    </button>
                                    <button 
                                        @click="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')"
                                        class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition duration-150 ease-in-out"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $categories->links('livewire.partials.posts-pagination') }}
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
                <form>
                    @csrf
                    <button type="button" wire:click.prevent="deleteCategory({{ $category->id }})"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 ease-in-out dark:bg-red-700 dark:hover:bg-red-800">
                        Delete Category
                    </button>
                </form>
            @endif
                
            </div>
        </div>
    </x-modal>
    
    <!-- Modal Blade Component -->
    <x-modal name="category-update-{{ $category->id }}" focusable>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ __('Update Category') }}</h2>

            <!-- Form action mengarah ke route update dengan ID kategori -->
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH') 

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Category Name') }}
                    </label>
                    <input id="title" name="title" type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                        value="{{ old('title', $category->title) }}" required />

                    @error('title')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 ease-in-out dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        {{ __('Update Category') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>

    @endforeach
</div>