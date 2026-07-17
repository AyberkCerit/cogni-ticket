<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-error">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-on-surface-variant font-mono">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-error/10 text-error hover:bg-error hover:text-on-error font-medium rounded-xl text-sm px-6 py-2.5 text-center transition-all duration-300 border border-error/30 hover:shadow-lg hover:shadow-error/30"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-surface border border-outline-variant rounded-2xl relative overflow-hidden">
            <!-- Decorative Glow inside modal -->
            <div class="absolute top-[-50%] right-[-10%] w-64 h-64 bg-error-container rounded-full blur-[80px] opacity-20 pointer-events-none"></div>

            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-on-surface">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-on-surface-variant font-mono">
                {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full md:w-3/4 bg-surface-container/50 border border-outline-variant text-on-surface text-sm rounded-xl focus:ring-error focus:border-error block p-2.5 transition-colors"
                    placeholder="{{ __('Your Password') }}"
                />
                @error('password', 'userDeletion') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-surface-container text-on-surface hover:bg-surface-container-high font-medium rounded-xl text-sm px-6 py-2.5 transition-colors border border-outline-variant">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-error text-on-error hover:bg-error/90 font-medium rounded-xl text-sm px-6 py-2.5 transition-all duration-300 shadow-lg shadow-error/30">
                    {{ __('Permanently Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
