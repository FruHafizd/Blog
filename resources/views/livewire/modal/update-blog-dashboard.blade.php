<div>
    <x-modal name="confirm-blog-update-{{$post->id}}" :show="$errors->any()" focusable>
        <div class="p-6 max-w-3xl mx-auto">
            <form wire:submit.prevent="updateBlog" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    {!! __("Update Blog <strong>:title</strong>", ['title' => $post->title]) !!}
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('You are about to update the blog titled:') }} 
                    <strong class="font-medium">{{ $post->title }}</strong>.
                    {{ __('Please ensure that all changes are correct. Once updated, the changes will be visible to your audience.') }}
                </p>

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input wire:model="title" type="text" id="title" required
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('title') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                        <textarea wire:model="content" id="content" rows="5" required
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        @error('content') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Short Description</label>
                        <textarea wire:model="short_description" id="short_description" rows="5" required
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        @error('short_description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                   <!-- Slug Input -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                        <input 
                            wire:model="slug" 
                            type="text" 
                            id="slug" 
                            required  
                            wire:keyup="generateSlug" 
                            class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors duration-300 ease-in-out cursor-not-allowed"
                        >
                        @error('slug') 
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Generated Slug Display -->
                    <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                        Generated Slug: <span class="font-medium text-indigo-600 dark:text-indigo-400">{{ $slug }}</span>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                        <input type="file" name="file-input" id="file-input"
                            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                dark:file:bg-indigo-900 dark:file:text-indigo-300
                                dark:hover:file:bg-indigo-800"
                            wire:model="image">
                        @error('image') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        
                        <!-- Existing image -->
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mt-4 w-full max-w-md h-auto rounded-lg shadow-md">
                        @endif

                        <!-- Image preview -->
                        @if ($image)
                            <div class="mt-4">
                                <img src="{{ $image->temporaryUrl() }}" class="w-full max-w-md h-auto rounded-lg shadow-lg" alt="Preview Image">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <select id="category" wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    
    
                   <!-- Pin Blog -->
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input wire:model="pin_blog" type="checkbox" id="pin_blog"
                                class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="pin_blog" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pin this blog</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="archived" type="checkbox" id="archived"
                                class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="archived" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Archive this blog</label>
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button  x-on:click="$wire.updateBlog()"  class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Update This Blog') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</div>