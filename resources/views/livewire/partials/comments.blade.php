<div class="max-w-2xl mx-auto p-6 bg-gray-50 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Comments</h2>
    
    <!-- Form untuk menambahkan komentar -->
    <form wire:submit.prevent="addComment" class="mb-8 bg-white p-4 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="newComment" class="block text-sm font-medium text-gray-700">Add a comment</label>
            <textarea
                id="newComment"
                rows="3"
                wire:model="newComment"
                class="mt-1 block w-full p-3 rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50"
                placeholder="Type your comment here..."></textarea>
            @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-50 transition ease-in-out duration-150">
            Post Comment
        </button>
    </form>
    
    <!-- Daftar komentar -->
    <div class="space-y-6">
        @foreach($comments as $comment)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-800">{{ $comment->body }}</p>
                        <p class="text-sm text-gray-500 mt-1">Posted by {{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex space-x-2">
                        @if (auth()->check())
                            <button wire:click="$set('replyingTo', {{ $comment->id }})" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                Reply
                            </button>
                        @endif
                        @if(auth()->check()  && (auth()->id() == $comment->user_id || auth()->user()->hasRole('Admin')))
                            <button wire:click="deleteComment({{ $comment->id }})"
                                    onclick="return confirm('Are you sure you want to delete this comment?')"
                                    class="text-red-600 hover:text-red-800 transition-colors duration-200"
                                    aria-label="Delete Comment">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
                
                <!-- Form untuk membalas komentar -->
                @if($replyingTo === $comment->id)
                    <form wire:submit.prevent="addReply({{ $comment->id }})" class="mt-4 bg-gray-50 p-3 rounded-lg shadow">
                        <textarea
                            rows="2"
                            wire:model="replyComment"
                            class="w-full p-2 rounded-lg border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50"
                            placeholder="Type your reply here..."></textarea>
                        @error('replyComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <div class="mt-2 flex justify-end space-x-2">
                            <button type="button" wire:click="$set('replyingTo', null)" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Reply
                            </button>
                        </div>
                    </form>
                @endif
                
                <!-- Balasan komentar -->
                @if($comment->replies->count() > 0)
                    <div class="mt-4 ml-4 space-y-4">
                        @foreach($comment->replies as $reply)
                            <div class="bg-gray-50 p-3 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                                <p class="text-gray-800">{{ $reply->body }}</p>
                                <p class="text-sm text-gray-500 mt-1">Replied by {{ $reply->user->name }} {{ $reply->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
