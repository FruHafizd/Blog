<div class="max-w-screen-lg mx-auto">
    <main class="mt-10">

        <div class="mb-4 md:mb-0 w-full relative">
            <div class="px-4 lg:px-0">
                <div class="flex justify-between items-center">
                    <h2 class="text-4xl font-bold text-gray-800 leading-tight">
                        {{ $post->title }}
                    </h2>

                    {{-- 
                    Auth::check(): Memeriksa apakah pengguna sudah login.

                    Auth::user()->id: Mendapatkan ID pengguna yang sedang login.

                    $post->user_id: ID pengguna yang memiliki postingan.

                    Jika kedua ID sama, maka link untuk mengedit blog akan ditampilkan.
                    --}}
                    
                    @if (Auth::check() && Auth::user()->id === $post->user_id)
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('blog.edit', $post->id) }}" class="text-sm text-blue-600 hover:underline">
                            Update Blog
                        </a>
                
                        <!-- Tombol untuk membuka modal -->
                        <button type="button"  x-on:click.prevent="$dispatch('open-modal', 'confirm-blog-deletion')" class="text-sm text-red-600 hover:underline">
                            Delete This Blog
                        </button>
                    </div>
                @endif
                
                <x-modal name="confirm-blog-deletion" :show="$errors->blogDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('blog.delete', $post->id) }}" class="p-6 bg-white rounded-lg shadow-md">
                        @csrf
                        @method('DELETE')
                
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-900">
                            {{ __('Confirm Deletion') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-600">
                            {{ __('Are you sure you want to delete the blog titled:') }} <strong>{{ $post->title }}</strong>?
                            {{ __('This action cannot be undone. Once deleted, all of its resources and data will be permanently removed.') }}
                        </p>
                
                        <div class="mt-6">
                            <x-input-label for="blog-title" value="{{ __('Blog Title') }}" class="sr-only" />
                
                            <input
                                id="blog_title"
                                name="blog_title"
                                type="text"
                                placeholder="Enter Blog Title"
                                class="mt-1 block w-3/4 border border-gray-300 rounded-md p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"
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
                
                
                
                </div>
                <a 
                    class="py-2 text-gray-400 inline-flex items-center justify-center mb-2"
                >
                    Last Updated At {{ \Carbon\Carbon::parse($post->updated_at)->format('d F Y') }}, By {{ $post->user->name ?? 'Unknown' }}
                </a>
            </div>

            <img src="{{ asset('storage/' . $post->image) }}" alt="" class="mt-12 aspect-[2/1] w-full overflow-hidden rounded-xl object-cover shadow-card">
        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-12">

            <div class="px-4 lg:px-0 mt-12 text-gray-700 text-lg leading-relaxed w-full lg:w-3/4 mx-auto">
                <p class="pb-6">Advantage old had otherwise sincerity dependent additions. It in adapted natural hastily is justice. Six draw you him full not mean evil...</p>

                <p class="pb-6">Difficulty on insensible reasonable in. From as went he they. Preference themselves me as thoroughly partiality considered on in estimating...</p>

                <p class="pb-6">Adieus except say barton put feebly favour him. Entreaties unpleasant sufficient few pianoforte discovered uncommonly ask...</p>

                <div class="border-l-4 border-gray-500 pl-4 mb-6 italic rounded-lg">
                    Sportsman do offending supported extremity breakfast by listening. Decisively advantages nor expression unpleasing she led met...
                </div>

                <p class="pb-6">Exquisite cordially mr happiness of neglected distrusts. Boisterous impossible unaffected he me everything...</p>

                <h2 class="text-2xl text-gray-800 font-bold mb-4 mt-4">Uneasy barton seeing remark happen his has</h2>

                <p class="pb-6">Guest it he tears aware as. Make my no cold of need. He been past in by my hard. Warmly thrown oh he common future...</p>

                <p class="pb-6">Dashwood contempt on mr unlocked resolved provided of of. Stanhill wondered it it welcomed oh. Hundred no prudent he however smiling...</p>

                <p class="pb-6">Breakfast agreeable incommode departure it an. By ignorant at on wondered relation. Enough at tastes really so cousin am of...</p>

                <p class="pb-6">Detract yet delight written farther his general. If in so bred at dare rose lose good. Feel and make two real miss use easy...</p>

            </div>

        </div>
    </main>
</div>
