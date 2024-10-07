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