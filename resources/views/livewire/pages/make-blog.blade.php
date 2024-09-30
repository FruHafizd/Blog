<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0 bg-gradient-to-br from-blue-500 to-indigo-600 p-8 md:w-64 flex items-center justify-center">
                    <h1 class="text-3xl font-extrabold text-white text-center">Create New Blog</h1>
                </div>
                <div class="p-8 w-full">
                    @if (session()->has('message'))
                        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                            <p class="font-medium">{{ session('message') }}</p>
                        </div>
                    @endif

                    <form wire:submit.prevent="submit" class="space-y-6">
                        <!-- Title Input -->
                        <div class="relative">
                            <input type="text" id="title" class="peer w-full border-0 border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:ring-0 focus:border-indigo-600 py-2 transition-colors duration-300" placeholder="Blog Title" wire:model="title" required>
                            <label for="title" class="absolute left-0 -top-3.5 text-sm text-gray-600 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-indigo-600">Blog Title</label>
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Content Textarea -->
                        <div class="relative mt-6">
                            <textarea id="content" rows="4" class="peer w-full border-0 border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:ring-0 focus:border-indigo-600 py-2 transition-colors duration-300" placeholder="Blog Content" wire:model="content" required></textarea>
                            <label for="content" class="absolute left-0 -top-3.5 text-sm text-gray-600 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-indigo-600">Blog Content</label>
                        </div>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Category Select -->
                        <div class="relative mt-6">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category" wire:model="category_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg transition-colors duration-300">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Slug Input -->
                        <div class="relative mt-6">
                            <input 
                                type="text" 
                                id="slug" 
                                class="peer w-full border-0 border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:ring-0 focus:border-indigo-600 py-2 transition-colors duration-300" 
                                placeholder="Enter Slug" 
                                wire:model="slug" 
                                wire:keyup="generateSlug" 
                                required
                            >
                            <label 
                                for="slug" 
                                class="absolute left-0 -top-3.5 text-sm text-gray-600 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-indigo-600"
                            >
                                Enter Slug
                            </label>
                        </div>
                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Generated Slug Display -->
                        <div>
                            Generated Slug: <span class="font-medium">{{ $slug }}</span>
                        </div>


                        <!-- File Input -->
                        <div class="mt-6">
                            <label for="file-input" class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 transition-colors duration-300">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only" wire:model="image">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @if ($image)
                            <div class="mt-4">
                                <img src="{{ $image->temporaryUrl() }}" class="max-w-full h-auto rounded-lg shadow-sm" alt="Preview Image">
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-6">
                            <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none mr-4 transition-colors duration-300" data-hs-file-upload-remove="">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                </svg>
                            </button>
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Create Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>