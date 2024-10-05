<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-4xl font-bold text-gray-900 text-center mb-6">Update Blog</h1>

                @if (session()->has('message'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-lg">
                        <p class="font-medium">{{ session('message') }}</p>
                    </div>
                @endif

                <form wire:submit.prevent="update" class="space-y-8">
                    <!-- Title Input -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Blog Title</label>
                        <input type="text" id="title"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3"
                            placeholder="Enter blog title" wire:model="title" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                   <!-- Content Textarea -->
                   <div>
                       <label for="content" class="block text-sm font-medium text-gray-700">Blog Content</label>
                       <p class="mt-2 text-sm text-gray-600">
                           Tips for writing blog content neatly:
                           <ul class="list-disc list-inside mt-1">
                               <li>Use <strong>**bold text**</strong> to make text bold.</li>
                               <li>Use <strong>*italic text*</strong> to italicize text.</li>
                               <li>Use <strong>1.</strong> for ordered lists and <strong>-</strong> for unordered lists.</li>
                               <li>To insert an image, use the format: <code>![alt text](image URL)</code>.</li>
                               <li>Use <strong>[link text](URL)</strong> to insert hyperlinks.</li>
                           </ul>
                           You can see an example of Markdown format below:
                           <pre class="mt-2 bg-gray-100 p-2 rounded">
This is a paragraph with **bold text** and *italic text*.

- Item 1
- Item 2

[Link to source](http://example.com)
                           </pre>
                       </p>

                       <textarea id="content" rows="4"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3"
                           placeholder="Write your blog content here" wire:model="content" required></textarea>
                       @error('content')
                           <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                       @enderror
                   </div>

                    <!-- Short Description -->
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700">Short
                            Description</label>
                        <textarea id="short_description" rows="2"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3"
                            placeholder="Brief description of your blog" wire:model="short_description" required></textarea>
                        @error('short_description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category" wire:model="category_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug Input -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" id="slug"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3"
                            placeholder="Enter slug" wire:model="slug" wire:keyup="generateSlug" required>
                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Generated Slug: <span
                                class="font-medium">{{ $slug }}</span></p>
                    </div>

                    <!-- File Input -->
                    <div x-data="{ imageUploaded: true }">
                        <label for="file-upload" class="block text-sm font-medium text-gray-700">Cover Image</label>
                        <div x-show="!imageUploaded"
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only"
                                            wire:model="image" x-on:change="imageUploaded = true">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">AVIF, JPG, PNG, JPEG, GIF up to 10MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div x-show="imageUploaded" class="mt-4">
                            @if ($image)
                                <div class="relative">
                                    <img src="{{ $image->temporaryUrl()  }}" class="max-w-full h-auto rounded-md shadow-sm" alt="Preview Image">
                                    <button type="button" class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100" x-on:click="imageUploaded = false; $wire.removeImage()">
                                        <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @elseif ($dbphoto)
                                <div class="relative">
                                    <img src="{{ $dbphoto }}" class="max-w-full h-auto rounded-md shadow-sm" alt="Preview Image">
                                    <button type="button" class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100" x-on:click="imageUploaded = false; $wire.removeImage()">
                                        <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <button type="button" class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" x-on:click="imageUploaded = false; $wire.removeImage()">
                                Upload New Image
                            </button>
                        </div>
                        
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Blog Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
