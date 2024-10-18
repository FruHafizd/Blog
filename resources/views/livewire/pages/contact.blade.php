<div class="min-h-screen flex items-center justify-center bg-gradient-to-br  py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-10">
        <div class="text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                Contact Admin
            </h2>
            <p class="mt-2 text-lg text-gray-600 font-light">
                We value your insights
            </p>
        </div>
        
        @if (session()->has('message'))
            <div class="rounded-lg bg-white p-4 border-l-4 border-gray-800 shadow-md">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="ml-3 text-sm font-medium text-gray-800">
                        {{ session('message') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-8">
                <form wire:submit.prevent="submit" class="space-y-6">
                    <x-honeypot livewire-model="extraFields" />
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Issue Category</label>
                        <div class="relative group">
                            <select id="category" wire:model="category" class="block w-full pl-3 pr-10 py-2.5 text-sm border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 rounded-md transition duration-150 ease-in-out appearance-none bg-white group-hover:border-gray-400" required>
                                <option value="">Select Category</option>
                                <option value="Bug Report">Bug Report</option>
                                <option value="Content Suggestion">Content Suggestion</option>
                                <option value="Technical Issue">Technical Issue</option>
                            </select>
                           
                        </div>
                        @error('category')
                            <p class="mt-1 text-xs text-gray-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- File Input -->
                    <div x-data="{ imageUploaded: false }">
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
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="max-w-full h-auto rounded-md shadow-sm" alt="Preview Image">
                                    <button type="button"
                                        class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100"
                                        x-on:click="imageUploaded = false; $wire.removeImage()">
                                        <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                            <button type="button"
                                class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                x-on:click="imageUploaded = false; $wire.removeImage()">
                                Upload New Image
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                        <div class="relative group">
                            <textarea id="message" wire:model="message" rows="4" class="block w-full px-3 py-2.5 text-sm border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-150 ease-in-out resize-none group-hover:border-gray-400" placeholder="Share your thoughts..." required></textarea>
                            <div class="absolute bottom-2 right-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                        </div>
                        @error('message')
                            <p class="mt-1 text-xs text-gray-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-3 mt-6">
                        <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-150 ease-in-out">
                            Reset
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 transition-colors duration-150 ease-in-out shadow-sm">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center">
            <p class="text-sm text-gray-500">
                We'll respond within 24 hours.
            </p>
        </div>
    </div>
</div>