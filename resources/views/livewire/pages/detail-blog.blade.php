<div class="max-w-screen-lg mx-auto">
    <main class="mt-10">

        <div class="mb-4 md:mb-0 w-full relative">
            <div class="px-4 lg:px-0">
                <div class="space-y-4 sm:space-y-0 sm:flex sm:justify-between sm:items-start">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 leading-tight sm:max-w-[70%]">
                        {{ $post->title }}
                    </h2>
                
                    @if (Auth::check() && (Auth::user()->hasRole('Admin') || Auth::user()->id === $post->user_id))
                        <div class="flex items-center space-x-4 sm:ml-4">
                            <a href="{{ route('blog.edit', $post->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                Edit
                            </a>
                            <button type="button" x-on:click.prevent="$dispatch('open-modal', 'confirm-blog-deletion')" class="text-sm font-medium text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                Delete
                            </button>
                        </div>
                    @endif
                </div>

                <x-modal name="confirm-blog-deletion" :show="$errors->blogDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('blog.delete', $post->id) }}" class="p-6 bg-white rounded-lg shadow-md">
                        @csrf
                        @method('DELETE')
                
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-900">
                            {{ __('Confirm Deletion') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-600">
                            {{ __('Are you sure you want to delete the blog with the slug:') }} 
                            <strong class="font-medium">{{ $post->slug }}</strong>?
                            {{ __('This action is irreversible. Once deleted, all related data will be permanently removed.') }}
                        </p>
                
                        <div class="mt-6">
                            <x-input-label for="blog-title" value="{{ __('Blog Title') }}" class="sr-only" />
                
                            <input
                                id="blog_slug"
                                name="blog_slug"
                                type="text"
                                placeholder="Enter Blog Slug to confirm"
                                class="mt-1 block w-full md:w-3/4 border border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
                                required
                            />
                        </div>
                
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                
                            <x-danger-button class="ms-3">
                                {{ __('Delete This Blog') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
                
                <a class="py-2 text-gray-400 inline-flex items-center justify-center mb-2">
                    Last Updated At {{ \Carbon\Carbon::parse($post->updated_at)->format('d F Y') }}, By {{ $post->user->name ?? 'Unknown' }}
                </a>
                <div>
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                        <span class="size-1.5 inline-block rounded-full bg-blue-800 dark:bg-blue-500"></span>
                        {{ $post->categories->title }}
                    </span>
                </div>
            </div>

            <img src="{{ asset('storage/' . $post->image) }}" alt="" class="mt-12 aspect-[2/1] w-full overflow-hidden rounded-xl object-cover shadow-card">
        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <div class="px-4 lg:px-0 mt-12 text-gray-700 text-lg leading-relaxed w-full lg:w-3/4 mx-auto markdown-content">
                {!! $post->content !!}
            </div>
        </div>
    </main>

    @livewire('partials.comments', ['post' => $post])
</div>
