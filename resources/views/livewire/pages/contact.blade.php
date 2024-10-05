<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-4xl font-bold text-gray-900 text-center mb-6">Contact Admin</h1>

                @if (session()->has('message'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-lg">
                        <p class="font-medium">{{ session('message') }}</p>
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-8">
                    <!-- Problem Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Select Issue Category</label>
                        <select id="category" wire:model="category"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3" required>
                            <option value="">-- Choose a category --</option>
                            <option value="bug_report">Bug Report</option>
                            <option value="content_suggestion">Content Suggestion</option>
                            <option value="technical_issue">Technical Issue</option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Input -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                        <textarea id="message" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3"
                            placeholder="Write your message here" wire:model="message" required></textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="reset"
                            class="mr-2 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-100">
                            Reset
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
