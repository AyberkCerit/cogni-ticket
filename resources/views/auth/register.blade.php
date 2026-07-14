<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign Up</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&family=Manrope:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/register.css', 'resources/js/register.js'])
</head>
<body class="bg-background text-on-background min-h-screen flex items-center justify-center p-margin-mobile md:p-margin-desktop overflow-hidden">
    <!-- Background Ambient Glow -->
    <div class="fixed inset-0 pointer-events-none z-[-2]">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary-container/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-secondary-container/10 rounded-full blur-[120px]"></div>
    </div>
    
    <main class="w-full max-w-[440px] z-10 peach-glow-container relative">
        <div class="glass-card rounded-[24px] p-8 md:p-10 w-full relative overflow-hidden">
            <!-- Subtle Decorative Element -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary-container/20 rounded-bl-full blur-2xl"></div>
            
            <!-- Header -->
            <div class="text-center mb-8 relative z-10">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-surface-container-high border border-outline-variant/30 mb-4">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Create an account</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Join LuminaSaaS and start building.</p>
            </div>
            
            <!-- Form -->
            <form action="{{ route('register') }}" class="space-y-5 relative z-10" method="POST" novalidate>
                @csrf
                
                <div class="space-y-1.5">
                    <label class="block font-label-sm text-label-sm text-on-surface" for="name">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-lg">person</span>
                        </div>
                        <input class="w-full bg-surface border border-outline-variant rounded-xl py-3 pl-10 pr-4 font-body-md text-body-md text-on-surface placeholder-outline/60 input-glow transition-all duration-200 @error('name') !border-error !shadow-[0_0_0_1px_#ba1a1a] has-error @enderror" id="name" name="name" placeholder="Jane Doe" required autofocus value="{{ old('name') }}" type="text"/>
                    </div>
                    @error('name')
                        <div class="error-message text-error text-sm mt-1 flex items-center gap-1 font-medium opacity-0">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="space-y-1.5">
                    <label class="block font-label-sm text-label-sm text-on-surface" for="email">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-lg">mail</span>
                        </div>
                        <input class="w-full bg-surface border border-outline-variant rounded-xl py-3 pl-10 pr-4 font-body-md text-body-md text-on-surface placeholder-outline/60 input-glow transition-all duration-200 @error('email') !border-error !shadow-[0_0_0_1px_#ba1a1a] has-error @enderror" id="email" name="email" placeholder="jane@example.com" required value="{{ old('email') }}" type="email"/>
                    </div>
                    @error('email')
                        <div class="error-message text-error text-sm mt-1 flex items-center gap-1 font-medium opacity-0">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="space-y-1.5">
                    <label class="block font-label-sm text-label-sm text-on-surface" for="password">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-lg">lock</span>
                        </div>
                        <input class="w-full bg-surface border border-outline-variant rounded-xl py-3 pl-10 pr-4 font-body-md text-body-md text-on-surface placeholder-outline/60 input-glow transition-all duration-200 @error('password') !border-error !shadow-[0_0_0_1px_#ba1a1a] has-error @enderror" id="password" name="password" placeholder="••••••••" required autocomplete="new-password" type="password"/>
                        <!-- Visibility toggle could be added with JS later -->
                        <button class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-outline hover:text-primary transition-colors" type="button">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message text-error text-sm mt-1 flex items-center gap-1 font-medium opacity-0">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="space-y-1.5">
                    <label class="block font-label-sm text-label-sm text-on-surface" for="password_confirmation">Repeat Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline text-lg">lock</span>
                        </div>
                        <input class="w-full bg-surface border border-outline-variant rounded-xl py-3 pl-10 pr-4 font-body-md text-body-md text-on-surface placeholder-outline/60 input-glow transition-all duration-200 @error('password_confirmation') !border-error !shadow-[0_0_0_1px_#ba1a1a] has-error @enderror" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" type="password"/>
                        <button class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-outline hover:text-primary transition-colors" type="button">
                            <span class="material-symbols-outlined text-lg">visibility</span>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="error-message text-error text-sm mt-1 flex items-center gap-1 font-medium opacity-0">
                            <span class="material-symbols-outlined text-[16px]">error</span>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="pt-2">
                    <button class="w-full btn-peach rounded-xl py-3.5 px-6 font-headline-md text-body-md font-semibold flex items-center justify-center gap-2" type="submit">
                        Sign Up
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'wght' 600;">arrow_forward</span>
                    </button>
                </div>
            </form>
            
            <!-- Footer Link -->
            <div class="mt-8 text-center relative z-10">
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Already have an account? 
                    <a class="text-primary font-medium hover:text-primary-fixed-dim transition-colors relative inline-block group" href="{{ route('login') }}">
                        Login
                        <span class="absolute -bottom-0.5 left-0 w-0 h-[1.5px] bg-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>
