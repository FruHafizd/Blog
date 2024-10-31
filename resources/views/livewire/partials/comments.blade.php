<div class="max-w-3xl mx-auto p-6">
    <div class="bg-gradient-to-b from-white/80 to-white/40 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Discussion</h2>
            </div>
    
            <!-- Comment Form -->
            <form wire:submit.prevent="addComment" class="mb-8">
                <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm p-6 transition duration-200 hover:shadow-md border border-gray-100">
                    <label for="newComment" class="block text-sm font-medium text-gray-700 mb-2">Start a discussion</label>
                    <textarea
                        id="newComment"
                        rows="4"
                        wire:model="newComment"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200 resize-none placeholder-gray-400"
                        placeholder="Share your thoughts..."
                    ></textarea>
                    @error('newComment') 
                        <span class="mt-1 text-red-500 text-sm font-medium">{{ $message }}</span> 
                    @enderror
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition duration-200 group shadow-sm hover:shadow">
                            <span>Post Comment</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
    
            <!-- Comments List -->
            <div class="space-y-6">
                @foreach($comments as $comment)
                    <div class="group bg-white rounded-xl shadow-sm hover:shadow-md transition duration-200 border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1">
                                    <div class="flex items-start gap-3">
                                       
                                        <div>
                                            <p class="text-gray-800 leading-relaxed">{{ $comment->body }}</p>
                                            <div class="mt-2 flex items-center gap-3 text-sm">
                                                <span class="font-medium text-gray-700">{{ $comment->user->name }}</span>
                                                <span class="text-gray-400">•</span>
                                                <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if (auth()->check())
                                        <button 
                                            wire:click="$set('replyingTo', {{ $comment->id }})"
                                            class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition duration-200"
                                            title="Reply to this comment"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                            </svg>
                                        </button>
                                    @endif
                                    @if(auth()->check() && (auth()->id() == $comment->user_id || auth()->user()->hasRole('Admin')))
                                        <button 
                                            {{-- wire:click="deleteComment({{ $comment->id }})" --}}
                                            {{-- onclick="return confirm('Are you sure you want to delete this comment?')" --}}
                                            class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-full transition duration-200"
                                            title="Delete comment"
                                            x-data @click="$dispatch('open-modal', 'confirm-comment-deletion-{{ $comment->id }}')"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Reply Form -->
                        @if($replyingTo === $comment->id)
                            <div class="px-6 pb-6">
                                <form wire:submit.prevent="addReply({{ $comment->id }})" class="bg-gray-50 rounded-xl p-4">
                                    <textarea
                                        rows="3"
                                        wire:model="replyComment"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200 resize-none"
                                        placeholder="Write your reply..."
                                    ></textarea>
                                    @error('replyComment') 
                                        <span class="mt-1 text-red-500 text-sm font-medium">{{ $message }}</span> 
                                    @enderror
                                    <div class="mt-3 flex justify-end gap-3">
                                        <button 
                                            type="button" 
                                            wire:click="$set('replyingTo', null)"
                                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium rounded-full transition duration-200"
                                        >
                                            Cancel
                                        </button>
                                        <button 
                                            type="submit"
                                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full transition duration-200 shadow-sm hover:shadow"
                                        >
                                            Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <!-- Replies List -->
                        @if($comment->replies->count() > 0)
                            <div class="border-t border-gray-100">
                                <div class="p-6 space-y-4">
                                    @foreach($comment->replies as $reply)
                                        <div class="flex items-start gap-3 bg-gray-50 rounded-xl p-4">
                                            <div class="flex-1">
                                                <p class="text-gray-800">{{ $reply->body }}</p>
                                                <div class="mt-2 flex items-center gap-3 text-sm">
                                                    <span class="font-medium text-gray-700">{{ $reply->user->name }}</span>
                                                    <span class="text-gray-400">•</span>
                                                    <span class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    

                @endforeach
            </div>
        </div>
    </div>

    @foreach ($comments as $comment)
    <x-modal name="confirm-comment-deletion-{{ $comment->id }}" :show="$errors->commentDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            {{-- Header --}}
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-200">
                {{ __('Confirm Comment Deletion') }}
            </h2>
        
            {{-- Body --}}
            <p class="mt-4 text-sm text-gray-700 dark:text-gray-400">
                {{ __('You are about to delete the following comment:') }} 
                <strong class="font-medium">{{ $comment->content }}</strong>
            </p>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">
                {{ __('This action is permanent and cannot be undone. The comment will be permanently removed from the system.') }}
            </p>
            <p class="mt-2 text-sm font-semibold text-gray-700 dark:text-gray-400">
                {{ __('Are you sure you want to proceed?') }}
            </p>
            
            {{-- Action Buttons --}}
            <div class="mt-8 flex justify-end space-x-3">
                <button x-on:click="$dispatch('close')" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
                    {{ __('Cancel') }}
                </button>
  
                <button type="button" 
                x-on:click="$wire.deleteComment({{ $comment->id }})" 
                  class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 ease-in-out">
                  Delete Comment
                </button>
          
            </div>
        </div>
    </x-modal>
    @endforeach


    
    

</div>