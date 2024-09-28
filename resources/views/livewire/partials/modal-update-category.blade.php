<!-- Modal Blade Component -->
<x-modal name="category-update-{{ $categories->id }}" focusable>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ __('Update Category') }}</h2>

        <form wire:submit.prevent="updateCategory" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Category Name') }}
                </label>
                <input id="title" name="title" type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white transition duration-150 ease-in-out"
                       wire:model="title" required />
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