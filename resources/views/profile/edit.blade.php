@extends('layouts.app')
@section('title', __('Profil Ayarları'))

@section('content')
<main class="flex-1 rounded-[32px] glass-panel p-8 overflow-y-auto relative">
    <div class="mb-8">
        <h2 class="font-display-lg text-3xl md:text-4xl text-on-surface tracking-tight font-bold neon-glow-bg"><span class="neon-text">{{ __('Profile') }}</span> {{ __('Settings') }}</h2>
        <p class="text-on-surface-variant mt-2 text-sm font-mono">{{ __('Manage your account settings and security.') }}</p>
    </div>

    <div class="grid grid-cols-1 gap-8 max-w-4xl">
        <div class="glass-panel rounded-2xl p-6 border border-outline-variant/30 relative overflow-hidden">
            <!-- Decorative Glow -->
            <div class="absolute top-[-50%] right-[-10%] w-64 h-64 bg-primary-container rounded-full blur-[80px] opacity-20 pointer-events-none"></div>
            
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="glass-panel rounded-2xl p-6 border border-outline-variant/30 relative overflow-hidden">
            @include('profile.partials.update-password-form')
        </div>

        <div class="glass-panel rounded-2xl p-6 border border-error/30 bg-error/5">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</main>
@endsection
