<section>
    <header>
        <h2 class="text-xl font-bold text-on-surface">
            {{ __('Kişisel Bilgiler') }}
        </h2>
        <p class="mt-1 text-sm text-on-surface-variant font-mono">
            {{ __('Update your accounts profile information and email address.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profil Fotoğrafı -->
        <div>
            <label for="profile_photo" class="block text-sm font-medium text-on-surface mb-1">{{ __('Profile Photo') }}</label>
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full border border-outline-variant overflow-hidden shrink-0">
                    @if($user->profile_photo)
                        <img id="photo-preview" src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profil" class="w-full h-full object-cover">
                    @else
                        <img id="photo-preview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f9ebe3&color=7e553b" alt="Profil" class="w-full h-full object-cover">
                    @endif
                </div>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-primary hover:file:bg-primary-container/80 transition-colors cursor-pointer" onchange="document.getElementById('photo-preview').src = window.URL.createObjectURL(this.files[0])">
            </div>
            @error('profile_photo') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-on-surface mb-1">{{ __('Full Name') }}</label>
            <input id="name" name="name" type="text" class="w-full bg-surface-container/50 border border-outline-variant text-on-surface text-sm rounded-xl focus:ring-primary focus:border-primary block p-2.5 transition-colors" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-on-surface mb-1">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="w-full bg-surface-container/50 border border-outline-variant text-on-surface text-sm rounded-xl focus:ring-primary focus:border-primary block p-2.5 transition-colors" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-warning">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-on-surface hover:text-primary rounded-md focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-tertiary">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-primary text-on-primary hover:bg-primary/90 font-medium rounded-xl text-sm px-6 py-2.5 text-center transition-all duration-300 shadow-lg shadow-primary/30">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-tertiary font-medium">{{ __('Changes saved.') }}</p>
            @endif
        </div>
    </form>
</section>
