<x-modal name="user-action-{{$user->id}}" :show="$errors->any()" focusable>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            
            <!-- Profile Information Section -->
            <section>
                <header>
                    <h2 class="text-lg font-medium">{{ __('Profile Information') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </header>
                <form wire:submit.prevent="update" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Name') }}
                            </label>
                            <input id="name" 
                                   name="name" 
                                   type="text" 
                                   wire:model="name" 
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Email') }}
                            </label>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   wire:model="email" 
                                   required 
                                   autocomplete="username" 
                                   readonly
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" />
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                
                    <div class="flex items-center justify-end mt-6">
                        <button type="submit"
                                wire:click.prevent="update"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:active:bg-gray-300 dark:focus:ring-offset-gray-800">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </section>

            <!-- Ban User Section -->
            <section class="mt-12 space-y-6">
                <header>
                    <h2 class="text-lg font-medium">{{ __('Ban User') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Manage user bans. You can set the duration for how long a user will be banned.') }}
                    </p>
                </header>
                <form wire:submit.prevent="banUser" class="mt-6 space-y-6">
                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="banned_until">
                            {{ __('Ban Until (Date)') }}
                        </label>
                        <input id="banned_until" name="banned_until" type="date"
                               class="block w-full mt-1 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                               wire:model="banned_until" required />
                        @error('banned_until')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="banned_reason">
                            {{ __('Reason for Ban') }}
                        </label>
                        <textarea id="banned_reason" name="banned_reason" rows="3"
                                  class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                  wire:model="banned_reason" required></textarea>
                        @error('banned_reason')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" 
                                type="submit" wire:click.prevent="banUser">{{ __('Ban User') }}</button>
                        <button class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" 
                                type="button" wire:click="unbanUser">{{ __('Unban User') }}</button>
                    </div>
                </form>
            </section>

            <!-- Assign Role Section -->
            <section class="mt-12 space-y-6">
                <header>
                    <h2 class="text-lg font-semibold">{{ __('Assign Roles') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Assign or remove roles for this user. Select roles from the options below.') }}
                    </p>
                </header>
                <form wire:submit.prevent="assignRoles" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Roles') }}</label>
                        @foreach ($roles as $role)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="role_{{ $role->id }}" wire:model="selectedRoles"
                                       value="{{ $role->name }}"
                                       class="mr-2 border-gray-300 rounded focus:border-indigo-500 focus:ring-indigo-500">
                                <label for="role_{{ $role->id }}" class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('selectedRoles')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" 
                        type="submit"
                        wire:click.prevent="assignRoles"
                        >{{ __('Save Roles') }}</button>
                    </div>
                </form>
            </section>

            <!-- Delete User Account Section -->
            <section class="mt-12 space-y-6">
                <header>
                    <h2 class="text-lg font-medium">{{ __('Delete User Account') }}</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('As an administrator, you have the ability to permanently delete a user account. Once deleted, all associated data and resources will be irrecoverable. Ensure that any important data is backed up before proceeding.') }}
                    </p>
                </header>
                <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" 
                        x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                    {{ __('Delete User Account') }}
                </button>
                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Are you sure you want to delete this user account?') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('This action is irreversible. Please confirm your decision to permanently delete this user account.') }}
                        </p>
                        <div class="flex justify-end mt-6">
                            <button class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150" 
                                    x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </button>
                            <button class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" 
                                    wire:click="destroy({{ $user->id }})">
                                {{ __('Delete User Account') }}
                            </button>
                        </div>
                    </div>
                </x-modal>
            </section>

            <div class="flex justify-end mt-6">
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" 
                        x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>
    </div>
</x-modal>