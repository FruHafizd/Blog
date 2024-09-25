<div class="max-w-2xl mx-auto p-4 bg-gray-100 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Comments</h2>
    
    <!-- Form untuk menambahkan komentar -->
    <form wire:submit.prevent="addComment" class="mb-8">
        <div class="mb-4">
            <label for="newComment" class="block text-sm font-medium text-gray-700">Add a comment</label>
            <textarea
                id="newComment"
                rows="3"
                wire:model="newComment"
                class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Type your comment here..."></textarea>
            @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
            Post Comment
        </button>
    </form>
    
    <!-- Daftar komentar -->
    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-800">{{ $comment->body }}</p>
                        <p class="text-sm text-gray-500 mt-1">Posted by {{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    @if(auth()->id() == $comment->user_id)
                        <!-- Tombol hapus dengan konfirmasi -->
                        <button wire:click="deleteComment({{ $comment->id }})"
                                onclick="return confirm('Are you sure you want to delete this comment?')"
                                class="text-red-500 hover:text-red-700"
                                aria-label="Delete Comment">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
