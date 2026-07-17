<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign Up</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet"/>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/register.css', 'resources/js/register.js'])
</head>
<body class="bg-[#f8f9fa] text-gray-800">
    <!-- Main Content - Centered Login Card -->
    <main class="flex-grow flex items-center justify-center p-gutter relative overflow-hidden min-h-screen">
        <!-- Decorative abstract blobs behind the card for depth -->
        <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-primary-container/20 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="absolute top-1/2 right-1/4 -translate-y-1/3 w-80 h-80 bg-secondary-container/20 rounded-full blur-3xl mix-blend-multiply"></div>
        <div class="relative z-10 w-full max-w-[440px] animate-float">
            <!-- Login Card -->
            <div class="bg-gradient-peach-neon rounded-2xl p-[1px] shadow-neon animate-gradient-shift animate-pulse-glow" style="box-shadow: 0 0 20px rgba(255, 199, 167, 0.4), 0 0 40px rgba(255, 199, 167, 0.2), 0 0 60px rgba(255, 199, 167, 0.1);">
                <div class="bg-white rounded-[21px] p-8 md:p-10 w-full h-full relative overflow-hidden">
                    <!-- Inner glow effect for the card -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-peach-neon opacity-60 animate-gradient-shift"></div>
                    <div class="text-center mb-8 animate-fade-in-up delay-100">
                        <h1 class="font-headline-md text-headline-md text-gray-900 mb-2">Create an Account</h1>
                        <p class="font-body-md text-body-md text-gray-600">Join our community today</p>
                    </div>
                    <form action="{{ route('register') }}" class="space-y-6" method="POST">
                        @csrf
                        <div class="animate-fade-in-up delay-100">
                            <label class="block font-label-md text-label-md text-gray-700 mb-2" for="full-name">Full Name</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">person</span>
                                <input class="glass-input w-full pl-12 pr-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200 bg-transparent" id="full-name" name="name" placeholder="John Doe" required type="text" value="{{ old('name') }}"/>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="animate-fade-in-up delay-200">
                            <label class="block font-label-md text-label-md text-gray-700 mb-2" for="email">Email Address</label>
                            <input class="glass-input w-full px-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200 bg-transparent" id="email" name="email" placeholder="name@company.com" required type="email" value="{{ old('email') }}"/>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="animate-fade-in-up delay-300">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block font-label-md text-label-md text-gray-700" for="password">Password</label>
                            </div>
                            <input class="glass-input w-full px-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200 bg-transparent" id="password" name="password" placeholder="••••••••" required type="password"/>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="animate-fade-in-up delay-400">
                            <label class="block font-label-md text-label-md text-gray-700 mb-2" for="repeat-password">Repeat Password</label>
                            <input class="glass-input w-full px-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200 bg-transparent" id="repeat-password" name="password_confirmation" placeholder="••••••••" required type="password"/>
                        </div>

                        <div class="animate-fade-in-up delay-400">
                            <button class="w-full bg-gradient-peach-neon text-on-primary-container font-label-md text-label-md py-3 px-4 rounded-lg shadow-ambient hover:shadow-neon transition-all duration-300 relative overflow-hidden group animate-gradient-shift" type="submit">
                                <span class="relative z-10 font-bold text-gray-900">Sign Up</span>
                                <!-- Hover overlay effect -->
                                <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>
                    <div class="mt-8 text-center animate-fade-in-up delay-500">
                        <p class="font-body-md text-body-md text-gray-600">Already have an account? <a class="text-primary font-semibold hover:text-primary-fixed-variant hover:underline transition-colors duration-200" href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
