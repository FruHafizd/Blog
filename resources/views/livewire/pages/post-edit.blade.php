<div class="flex items-center justify-center min-h-screen">
    <div class="max-w-3xl w-full p-5">
        <h1 class="text-4xl font-bold mb-5 text-center">Ubah Blog Baru</h1>

        @if (session()->has('message'))
            <div class="mb-4 text-green-600">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="update" class="space-y-5">
         
                <!-- Floating Input -->
                <div class="relative">
                  <input type="text" id="hs-floating-input-email" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                  focus:pt-6
                  focus:pb-2
                  [&:not(:placeholder-shown)]:pt-6
                  [&:not(:placeholder-shown)]:pb-2
                  autofill:pt-6
                  autofill:pb-2" placeholder="you@email.com" wire:model="title" required    >
                  <label for="hs-floating-input-email" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] peer-disabled:opacity-50 peer-disabled:pointer-events-none
                    peer-focus:scale-90
                    peer-focus:translate-x-0.5
                    peer-focus:-translate-y-1.5
                    peer-focus:text-gray-500
                    peer-[:not(:placeholder-shown)]:scale-90
                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                    peer-[:not(:placeholder-shown)]:text-gray-500">Title Blog</label>
                @error('title')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                </div>
                <!-- End Floating Input -->

                <!-- Floating Textarea -->
                <div class="relative">
                    <textarea id="hs-floating-textarea" rows="4" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                    focus:pt-6
                    focus:pb-2
                    [&:not(:placeholder-shown)]:pt-6
                    [&:not(:placeholder-shown)]:pb-2
                    autofill:pt-6
                    autofill:pb-2" placeholder="" wire:model="content" required></textarea>
                    <label for="hs-floating-textarea" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] peer-disabled:opacity-50 peer-disabled:pointer-events-none
                        peer-focus:scale-90
                        peer-focus:translate-x-0.5
                        peer-focus:-translate-y-1.5
                        peer-focus:text-gray-500
                        peer-[:not(:placeholder-shown)]:scale-90
                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                        peer-[:not(:placeholder-shown)]:text-gray-500">Konten Blog</label>
                    @error('content')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Floating Textarea -->

                <div>
                    <label for="file-input" class="sr-only">Choose file</label>
                    <input type="file" name="file-input" id="file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                    file:bg-gray-50 file:border-0
                    file:me-4
                    file:py-3 file:px-4"
                    wire:model="image" 
                    required>
                    @error('image')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    @if ($image)
                    {{-- <div class="grid grid-cols-4 gap-4">
                        @foreach ($image as $images)
                            <img src="{{ $images->temporaryUrl() }}" class="w-full h-auto rounded-lg shadow-lg" alt="Preview Image">
                        @endforeach
                    </div> --}}
                    @endif
                </div>
               

                <div class="flex items-center gap-x-2">
                    <button type="button" class="text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200" data-hs-file-upload-remove="">
                      <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18"></path>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                        <line x1="10" x2="10" y1="11" y2="17"></line>
                        <line x1="14" x2="14" y1="11" y2="17"></line>
                      </svg>
                    </button>
                  </div>    

                <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">Ubah Blog</button>
            </div>
            
                
        </form>
    </div>
</div>
