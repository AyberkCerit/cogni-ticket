<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CogniTicket - {{ __('Welcome') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-surface text-on-surface font-sans selection:bg-orange-500/30 min-h-screen flex flex-col overflow-x-hidden relative">
    <!-- Animated Background Spheres -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-[-1]">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[50%] bg-orange-600/20 rounded-full blur-[120px] animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[60%] bg-purple-600/10 rounded-full blur-[150px] animate-pulse" style="animation-duration: 12s;"></div>
        <div class="absolute top-[40%] left-[30%] w-[30%] h-[40%] bg-orange-500/10 rounded-full blur-[100px] animate-pulse" style="animation-duration: 10s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="w-full glass-panel border-b border-outline-variant/30 py-4 px-6 md:px-12 flex justify-between items-center z-50 sticky top-0">
        <a href="{{ route('contact.create') }}" title="{{ __('Contact Us') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
            <div class="w-10 h-10 rounded-full bg-surface-container border border-orange-500/30 flex items-center justify-center shadow-[0_0_15px_rgba(249,115,22,0.3)] relative group">
                <span class="material-symbols-outlined text-orange-500 drop-shadow-[0_0_5px_rgba(249,115,22,0.8)] text-[24px]" style="font-variation-settings: 'FILL' 1;">headset_mic</span>
            </div>
            <span class="font-display font-bold text-xl tracking-wide bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent">CogniTicket</span>
        </a>

        <div class="flex items-center gap-4 md:gap-6">
            <!-- Language Switcher -->
            @php $currentLang = app()->getLocale(); $switchLang = $currentLang === 'en' ? 'tr' : 'en'; @endphp
            <a href="{{ route('lang.switch', $switchLang) }}" class="w-10 h-10 bg-surface-container-high text-on-surface rounded-full border border-outline/50 hover:bg-orange-500/10 hover:text-orange-500 hover:border-orange-500/40 hover:shadow-[0_0_15px_rgba(249,115,22,0.3)] transition-all duration-300 flex items-center justify-center font-display-sm group" title="{{ __('Dil Değiştir') }}">
                <span class="font-bold text-xs tracking-wider group-hover:scale-110 transition-transform">{{ strtoupper($switchLang) }}</span>
            </a>

            <!-- Auth Links -->
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl bg-orange-500/20 text-orange-500 border border-orange-500/40 hover:bg-orange-500 hover:text-on-primary hover:shadow-[0_0_20px_rgba(249,115,22,0.5)] transition-all duration-300 font-semibold text-sm flex items-center gap-2">
                        <span>{{ __('Dashboard') }}</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors hidden md:block">
                        {{ __('Login') }}
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-primary text-on-primary border border-primary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.5)] transition-all duration-300 font-semibold text-sm">
                            {{ __('Register') }}
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-1 flex flex-col items-center justify-center text-center px-4 py-20 z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-400 text-xs font-semibold tracking-wider uppercase mb-8 shadow-[0_0_15px_rgba(249,115,22,0.1)]">
            <span class="material-symbols-outlined text-[16px]">auto_awesome</span>
            AI-Powered v1.0
        </div>
        
        <h1 class="text-5xl md:text-7xl font-display font-bold max-w-4xl leading-tight mb-6 tracking-tight">
            {{ __('Transform Your Support Workflow with AI') }}
        </h1>
        
        <p class="text-lg md:text-xl text-on-surface-variant max-w-2xl mb-12 font-light leading-relaxed">
            {{ __('Elevate customer satisfaction with a modern, asynchronous, and intelligent ticket management system.') }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 rounded-2xl bg-primary text-on-primary font-bold text-lg hover:shadow-[0_0_30px_rgba(249,115,22,0.6)] hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group">
                        {{ __('Dashboard') }}
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl bg-primary text-on-primary font-bold text-lg hover:shadow-[0_0_30px_rgba(249,115,22,0.6)] hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group">
                        {{ __('Get Started') }}
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 rounded-2xl glass-panel text-on-surface font-bold text-lg hover:bg-surface-container-high transition-all duration-300 flex items-center justify-center">
                        {{ __('Login') }}
                    </a>
                @endauth
            @endif
        </div>
    </main>

    <!-- Features Section -->
    <section class="w-full max-w-7xl mx-auto px-4 py-20 z-10 border-t border-outline-variant/20">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold">{{ __('Features') }}</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="glass-panel p-8 rounded-3xl border border-outline-variant/30 hover:border-orange-500/30 hover:shadow-[0_10px_30px_rgba(249,115,22,0.1)] transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-orange-500/10 text-orange-500 flex items-center justify-center mb-6 group-hover:bg-orange-500 group-hover:text-on-primary transition-colors duration-300">
                    <span class="material-symbols-outlined text-[28px]">bolt</span>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ __('Lightning Fast SPA') }}</h3>
                <p class="text-on-surface-variant leading-relaxed">{{ __('No page reloads. Everything updates instantly via Fetch API for a seamless experience.') }}</p>
            </div>

            <!-- Feature 2 -->
            <div class="glass-panel p-8 rounded-3xl border border-outline-variant/30 hover:border-purple-500/30 hover:shadow-[0_10px_30px_rgba(168,85,247,0.1)] transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-purple-500/10 text-purple-400 flex items-center justify-center mb-6 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined text-[28px]">smart_toy</span>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ __('Smart AI Insights') }}</h3>
                <p class="text-on-surface-variant leading-relaxed">{{ __('Automated ticket summaries and priority routing using Llama 3.') }}</p>
            </div>

            <!-- Feature 3 -->
            <div class="glass-panel p-8 rounded-3xl border border-outline-variant/30 hover:border-blue-500/30 hover:shadow-[0_10px_30px_rgba(59,130,246,0.1)] transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center mb-6 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined text-[28px]">palette</span>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ __('Premium Design') }}</h3>
                <p class="text-on-surface-variant leading-relaxed">{{ __('Beautiful glassmorphism interface crafted with Tailwind CSS.') }}</p>
            </div>
        </div>
    </section>
</body>
</html>
