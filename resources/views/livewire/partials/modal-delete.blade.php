<x-modal name="confirm-blog-deletion-{{ $post->id }}" :show="$errors->blogDeletion->isNotEmpty()" focusable>
    <div class="p-6">
        <form method="POST" action="{{ route('blog.delete', $post->id) }}">
            @csrf
            @method('DELETE')

            {{-- Header --}}
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200">
                {{ __('Confirm Blog Deletion') }}
            </h2>

            {{-- Body --}}
            <p class="mt-4 text-sm text-gray-700 dark:text-gray-400">
                {{ __('Are you sure you want to delete the blog with the slug:') }} 
                <strong class="font-medium">{{ $post->slug }}</strong>?
                {{ __('This action is irreversible. Once deleted, all related data will be permanently removed.') }}
            </p>

            {{-- Input for blog slug confirmation --}}
            <div class="mt-6">
                <x-input-label for="blog_slug" value="{{ __('Blog Slug') }}" class="sr-only" />
                <input
                    id="blog_slug"
                    name="blog_slug"
                    type="text"
                    placeholder="Enter Blog Slug to confirm"
                    class="w-full px-3 py-2 text-sm border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500"
                    required
                />
            </div>

            {{-- Action buttons --}}
            <div class="mt-8 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-700 dark:hover:bg-red-800">
                    {{ __('Delete Blog') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>
