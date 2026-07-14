<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/login.css', 'resources/js/login.js'])
</head>
<body class="bg-[#f8f9fa] text-gray-800">
    <!-- Main Content - Centered Login Card -->
    <main class="flex-grow flex items-center justify-center p-gutter relative overflow-hidden min-h-screen">
        <!-- Decorative abstract blobs behind the card for depth -->
        <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-primary-container/20 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute top-1/2 right-1/4 -translate-y-1/3 w-80 h-80 bg-secondary-container/20 rounded-full blur-3xl mix-blend-multiply"></div>
        
        <div class="relative z-10 w-full max-w-[440px] animate-float">
            <!-- Login Card -->
            <div class="bg-gradient-peach-neon rounded-2xl p-[1px] shadow-neon animate-gradient-shift animate-pulse-glow">
                <div class="bg-white rounded-[21px] p-8 md:p-10 w-full h-full relative overflow-hidden">
                    <!-- Inner glow effect for the card -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-peach-neon opacity-60 animate-gradient-shift"></div>
                    
                    <div class="text-center mb-8 animate-fade-in-up delay-100">
                        <h1 class="font-headline-md text-headline-md text-gray-900 mb-2">
                            <div id="animation" class="large grid centered square-grid">
                                <h2 class="text-xl">Welcome</h2>
                            </div>
                        </h1>
                        <p class="font-body-md text-body-md text-gray-600">Sign in to continue</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form action="{{ route('login') }}" class="space-y-6" method="POST" novalidate>
                        @csrf
                        
                        <div class="animate-fade-in-up delay-200">
                            <label class="block font-label-md text-label-md text-gray-700 mb-2" for="email">Email Address</label>
                            <input class="glass-input w-full px-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200 !text-gray-900 @error('email') !border-error !shadow-[0_0_0_1px_#ba1a1a] has-error @enderror" id="email" name="email" placeholder="example@mail.com" required autofocus value="{{ old('email') }}" type="email"/>
                            @error('email')
                                <div class="error-message text-error text-sm mt-2 flex items-center gap-1 font-medium opacity-0">
                                    <span class="material-symbols-outlined text-[18px]">error</span>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="animate-fade-in-up delay-300">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block font-label-md text-label-md text-gray-700" for="password">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="font-label-sm text-label-sm text-primary hover:text-primary-fixed-variant transition-colors duration-200" href="{{ route('password.request') }}">Forgot Password?</a>
                                @endif
                            </div>
                            <input class="glass-input w-full px-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200 !text-gray-900 @error('password') !border-error !shadow-[0_0_0_1px_#ba1a1a] has-error @enderror" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" type="password"/>
                            @error('password')
                                <div class="error-message text-error text-sm mt-2 flex items-center gap-1 font-medium opacity-0">
                                    <span class="material-symbols-outlined text-[18px]">error</span>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="animate-fade-in-up delay-300 block mt-4">
                            <label for="remember_me" class="inline-flex items-center text-gray-700">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-400 text-primary shadow-sm focus:ring-primary" name="remember">
                                <span class="ms-2 text-sm">Remember me</span>
                            </label>
                        </div>

                        <div class="animate-fade-in-up delay-400">
                            <button class="w-full bg-gradient-peach-neon text-on-primary-container font-label-md text-label-md py-3 px-4 rounded-lg shadow-ambient hover:shadow-neon transition-all duration-300 relative overflow-hidden group animate-gradient-shift" type="submit">
                                <span class="relative z-10 font-bold text-gray-900">Login</span>
                                <!-- Hover overlay effect -->
                                <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>

                    @if (Route::has('register'))
                    <div class="mt-8 text-center animate-fade-in-up delay-500">
                        <p class="font-body-md text-body-md text-gray-600">
                            Don't have an account? 
                            <a class="text-primary font-semibold hover:text-primary-fixed-variant hover:underline transition-colors duration-200" href="{{ route('register') }}">Sign Up</a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

</body>
</html>
