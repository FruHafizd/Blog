<div>
    <x-modal name="confirm-blog-update-{{$post->id}}" :show="$errors->any()" focusable>
        <form wire:submit.prevent="updateBlog" enctype="multipart/form-data" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg space-y-6">
            @csrf

            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
                {!! __("Update Blog <strong>:title</strong>", ['title' => $post->title]) !!}
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('You are about to update the blog titled:') }} 
                <strong>{{ $post->title }}</strong>.
                {{ __('Please ensure that all changes are correct. Once updated, the changes will be visible to your audience.') }}
            </p>

            <div class="grid grid-cols-1 gap-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Title</label>
                    <input wire:model="title" type="text" id="title" required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Content</label>
                    <textarea wire:model="content" id="content" rows="5" required
                              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Slug</label>
                    <input wire:model="slug" type="text" id="slug" required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" readonly>
                    @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="file-input" id="file-input"
                        class="block w-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500
                                file:bg-gray-50 dark:file:bg-gray-700 file:border-0 file:me-4 file:py-3 file:px-4"
                        wire:model="image">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    
                    <!-- Tampilkan gambar yang sudah ada -->
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mt-4 w-full h-auto rounded-lg shadow-md">
                    @endif

                    <!-- Tampilkan prabaca gambar yang diupload -->
                    @if ($image)
                        <div class="grid grid-cols-4 gap-4 mt-4">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-auto rounded-lg shadow-lg" alt="Preview Image">
                        </div>
                    @endif
                </div>

                <!-- Pin Blog -->
                <div class="flex items-center">
                    <input wire:model="pin_blog" type="checkbox" id="pin_blog"
                           class="h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500">
                    <label for="pin_blog" class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Pin this blog</label>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="dark:bg-gray-600 dark:text-gray-200">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button>
                    {{ __('Update This Blog') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
