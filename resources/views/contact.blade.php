<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CogniTicket - {{ __('Contact Us') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body class="antialiased bg-surface text-on-surface font-sans selection:bg-orange-500/30 min-h-screen flex flex-col overflow-x-hidden relative">
    <!-- Animated Background Spheres -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-[-1]">
        <div class="absolute top-[10%] left-[-10%] w-[40%] h-[50%] bg-orange-600/20 rounded-full blur-[120px] animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute bottom-[-10%] right-[10%] w-[50%] h-[60%] bg-purple-600/10 rounded-full blur-[150px] animate-pulse" style="animation-duration: 12s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="w-full glass-panel border-b border-outline-variant/30 py-4 px-6 md:px-12 flex justify-between items-center z-50 sticky top-0">
        <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
            <div class="w-10 h-10 rounded-full bg-surface-container border border-orange-500/30 flex items-center justify-center shadow-[0_0_15px_rgba(249,115,22,0.3)] relative group">
                <span class="material-symbols-outlined text-orange-500 drop-shadow-[0_0_5px_rgba(249,115,22,0.8)] text-[24px]" style="font-variation-settings: 'FILL' 1;">headset_mic</span>
            </div>
            <span class="font-display font-bold text-xl tracking-wide bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent">CogniTicket</span>
        </a>

        <div class="flex items-center gap-4 md:gap-6">
            @php $currentLang = app()->getLocale(); $switchLang = $currentLang === 'en' ? 'tr' : 'en'; @endphp
            <a href="{{ route('lang.switch', $switchLang) }}" class="w-10 h-10 bg-surface-container-high text-on-surface rounded-full border border-outline/50 hover:bg-orange-500/10 hover:text-orange-500 hover:border-orange-500/40 hover:shadow-[0_0_15px_rgba(249,115,22,0.3)] transition-all duration-300 flex items-center justify-center font-display-sm group" title="{{ __('Dil Değiştir') }}">
                <span class="font-bold text-xs tracking-wider group-hover:scale-110 transition-transform">{{ strtoupper($switchLang) }}</span>
            </a>
            
            <a href="{{ url('/') }}" class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[18px]">home</span>
                <span class="hidden md:inline">{{ __('Welcome') }}</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-4 z-10">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-display font-bold mb-3">{{ __('Contact Us') }}</h1>
                <p class="text-on-surface-variant">{{ __('Send us a message and we\'ll get back to you as soon as possible.') }}</p>
            </div>

            <div class="glass-panel p-8 md:p-10 rounded-3xl border border-outline-variant/30 shadow-[0_10px_40px_rgba(0,0,0,0.1)] relative overflow-hidden" id="contact-container">
                <!-- Success State (Hidden by default) -->
                <div id="success-state" class="absolute inset-0 bg-surface/95 backdrop-blur-md flex flex-col items-center justify-center z-20 opacity-0 pointer-events-none transition-opacity duration-500">
                    <div class="w-20 h-20 bg-green-500/20 text-green-500 rounded-full flex items-center justify-center mb-4 scale-0" id="success-icon">
                        <span class="material-symbols-outlined text-4xl">check_circle</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-2 translate-y-4 opacity-0" id="success-title">{{ __('Your message has been successfully sent!') }}</h3>
                    <a href="{{ url('/') }}" class="mt-4 px-6 py-2 rounded-xl bg-surface-container border border-outline hover:border-primary hover:text-primary transition-all translate-y-4 opacity-0" id="success-btn">
                        {{ __('Welcome') }}
                    </a>
                </div>

                <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="flex flex-col gap-5">
                    @csrf
                    
                    <!-- Name and Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-semibold ml-1">{{ __('Full Name') }}</label>
                            <input type="text" name="name" required class="w-full bg-surface-container/50 border border-outline-variant/50 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-on-surface-variant/50" placeholder="John Doe" value="{{ old('name', Auth::user()?->name) }}">
                            <span class="text-error text-xs ml-1 hidden error-text" id="error-name"></span>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <label class="text-sm font-semibold ml-1">{{ __('Email') }}</label>
                            <input type="email" name="email" required class="w-full bg-surface-container/50 border border-outline-variant/50 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-on-surface-variant/50" placeholder="john@example.com" value="{{ old('email', Auth::user()?->email) }}">
                            <span class="text-error text-xs ml-1 hidden error-text" id="error-email"></span>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold ml-1">{{ __('Subject (Optional)') }}</label>
                        <input type="text" name="subject" class="w-full bg-surface-container/50 border border-outline-variant/50 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-on-surface-variant/50" placeholder="How can we help you?">
                        <span class="text-error text-xs ml-1 hidden error-text" id="error-subject"></span>
                    </div>

                    <!-- Message -->
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold ml-1">{{ __('Message') }}</label>
                        <textarea name="message" required rows="5" class="w-full bg-surface-container/50 border border-outline-variant/50 rounded-xl px-4 py-3 text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none placeholder:text-on-surface-variant/50" placeholder="Type your message here..."></textarea>
                        <span class="text-error text-xs ml-1 hidden error-text" id="error-message"></span>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit-btn" class="w-full py-4 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold hover:shadow-[0_0_20px_rgba(249,115,22,0.4)] transition-all duration-300 flex items-center justify-center gap-2 mt-2 relative overflow-hidden group">
                        <span id="btn-text">{{ __('Send Message') }}</span>
                        <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform" id="btn-icon">send</span>
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('contact-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const btn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnIcon = document.getElementById('btn-icon');
            
            // Clear errors
            document.querySelectorAll('.error-text').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
            form.querySelectorAll('input, textarea').forEach(el => {
                el.classList.remove('border-error', 'ring-error');
            });

            // Loading state
            btn.disabled = true;
            const originalText = btnText.textContent;
            btnText.textContent = '...';
            btnIcon.textContent = 'hourglass_empty';
            btnIcon.classList.add('animate-spin');

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422 && data.errors) {
                        // Validation errors
                        anime({
                            targets: '#contact-container',
                            translateX: [0, -10, 10, -10, 10, 0],
                            duration: 500,
                            easing: 'easeInOutSine'
                        });

                        Object.keys(data.errors).forEach(key => {
                            const errorSpan = document.getElementById(`error-${key}`);
                            const input = form.querySelector(`[name="${key}"]`);
                            if (errorSpan && input) {
                                errorSpan.textContent = data.errors[key][0];
                                errorSpan.classList.remove('hidden');
                                input.classList.add('border-error', 'ring-error');
                            }
                        });
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                    
                    // Reset button
                    btn.disabled = false;
                    btnText.textContent = originalText;
                    btnIcon.textContent = 'send';
                    btnIcon.classList.remove('animate-spin');
                } else {
                    // Success animation
                    const successState = document.getElementById('success-state');
                    successState.classList.remove('opacity-0', 'pointer-events-none');
                    
                    anime.timeline({
                        easing: 'easeOutExpo',
                    })
                    .add({
                        targets: '#success-icon',
                        scale: [0, 1],
                        duration: 600,
                        delay: 100
                    })
                    .add({
                        targets: ['#success-title', '#success-btn'],
                        translateY: [20, 0],
                        opacity: [0, 1],
                        duration: 600,
                        delay: anime.stagger(100)
                    }, '-=400');
                }
            } catch (error) {
                console.error(error);
                alert('Connection error.');
                btn.disabled = false;
                btnText.textContent = originalText;
                btnIcon.textContent = 'send';
                btnIcon.classList.remove('animate-spin');
            }
        });
    </script>
</body>
</html>
