<section>
    <header>
        <h2 class="text-xl font-bold text-on-surface">
            {{ __('Change Password') }}
        </h2>
        <p class="mt-1 text-sm text-on-surface-variant font-mono">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-on-surface mb-1">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-surface-container/50 border border-outline-variant text-on-surface text-sm rounded-xl focus:ring-primary focus:border-primary block p-2.5 transition-colors" autocomplete="current-password" />
            @error('current_password', 'updatePassword') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-on-surface mb-1">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-surface-container/50 border border-outline-variant text-on-surface text-sm rounded-xl focus:ring-primary focus:border-primary block p-2.5 transition-colors" autocomplete="new-password" />
            @error('password', 'updatePassword') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-on-surface mb-1">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-surface-container/50 border border-outline-variant text-on-surface text-sm rounded-xl focus:ring-primary focus:border-primary block p-2.5 transition-colors" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-primary text-on-primary hover:bg-primary/90 font-medium rounded-xl text-sm px-6 py-2.5 text-center transition-all duration-300 shadow-lg shadow-primary/30">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-tertiary font-medium">{{ __('Password successfully updated.') }}</p>
            @endif
        </div>
    </form>
</section>
