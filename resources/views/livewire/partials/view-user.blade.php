<div>
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
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                wire:model="name" required autofocus autocomplete="name" />

                            <!-- Error message for name -->
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="block w-full mt-1"
                                wire:model="email" required autocomplete="username" readonly />
                            <!-- Error message for email -->
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            <x-primary-button
                                class='inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'
                                wire:click.prevent="update">{{ __('Save') }}</x-primary-button>
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
                        <!-- Ban Until (Date) -->
                        <div>
                            <x-input-label for="banned_until" :value="__('Ban Until (Date)')" class="text-gray-900 dark:text-gray-100" />
                            <input id="banned_until" name="banned_until" type="date"
                            class="block w-full mt-1 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            wire:model="banned_until" required />
                        
                            @error('banned_until')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Ban Reason -->
                        <div>
                            <x-input-label for="banned_reason" :value="__('Reason for Ban')" class="text-gray-900 dark:text-gray-100" />
                            <textarea id="banned_reason" name="banned_reason" rows="3"
                                      class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      wire:model="banned_reason" required></textarea>
                            @error('banned_reason')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Submit Button -->
                        <div class="flex justify-end mt-6">
                            <x-primary-button type="submit" wire:click="banUser">{{ __('Ban User') }}</x-primary-button>
                            <x-primary-button type="button" class="ml-2" wire:click="unbanUser">{{ __('Unban User') }}</x-primary-button>
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

                    <form wire:submit.prevent="assignRoles" class="mt-6 space-y-6">
                        @csrf
                    
                        <!-- Role Selection -->
                        <div>
                            <x-input-label :value="__('Roles')" />
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
                    
                        <!-- Submit Button -->
                        <div class="flex justify-end mt-6">
                            <x-primary-button type="submit">{{ __('Save Roles') }}</x-primary-button>
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
                    <x-danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete User Account') }}</x-danger-button>
                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete this user account?') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('This action is irreversible. Please confirm your decision to permanently delete this user account.') }}
                                </p>
                                <div class="flex justify-end mt-6">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                    <x-danger-button class="ms-3" wire:click="destroy({{ $user->id }})">
                                        {{ __('Delete User Account') }}
                                    </x-danger-button>
                                </div>
                            </div>
                        </x-modal>
                </section>
                <div class="flex justify-end mt-6">
                    <x-primary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-primary-button>
                </div>
               
            </div>
        </div>
        
    </x-modal>
</div>
