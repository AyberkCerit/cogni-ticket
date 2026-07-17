<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Support Portal')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet"/>
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/dashboard.css'])
    @yield('extra_css')
</head>
<body class="font-body-md text-on-surface antialiased min-h-screen flex bg-background overflow-hidden relative w-full selection:bg-primary selection:text-on-primary">

    <!-- Ambient Glow (from Light Theme) -->
    <div class="absolute top-[-20%] right-[-10%] w-[60%] h-[60%] rounded-full bg-primary-container opacity-[0.2] blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] left-[-10%] w-[40%] h-[40%] rounded-full bg-tertiary-container opacity-[0.1] blur-[100px] pointer-events-none"></div>

    <!-- Sidebar Navigation Component -->
    <x-sidebar />

    <!-- Main Content Wrapper -->
    <div class="ml-28 w-[calc(100%-7rem)] flex @yield('wrapper_class', 'flex-col') h-screen p-4 pr-6">
        @yield('content')
    </div>

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
        @if(session('success'))
            <div class="toast bg-tertiary-container border border-tertiary text-tertiary px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 transform translate-y-0 opacity-100 transition-all duration-300">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100"><span class="material-symbols-outlined text-[18px]">close</span></button>
            </div>
        @endif
        @if(session('error'))
            <div class="toast bg-error-container border border-error text-error px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 transform translate-y-0 opacity-100 transition-all duration-300">
                <span class="material-symbols-outlined">error</span>
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100"><span class="material-symbols-outlined text-[18px]">close</span></button>
            </div>
        @endif
    </div>

    <script>
        // Global Toast Function
        window.showToast = function(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;
            
            const toast = document.createElement('div');
            const isSuccess = type === 'success';
            toast.className = \`toast \${isSuccess ? 'bg-tertiary-container border-tertiary text-tertiary' : 'bg-error-container border-error text-error'} px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 transform translate-y-0 opacity-100 transition-all duration-300\`;
            
            toast.innerHTML = \`
                <span class="material-symbols-outlined">\${isSuccess ? 'check_circle' : 'error'}</span>
                <span class="text-sm font-medium">\${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 opacity-70 hover:opacity-100"><span class="material-symbols-outlined text-[18px]">close</span></button>
            \`;
            
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        };

        // Global AJAX Form Handler
        window.handleAjaxSubmit = async function(event, form) {
            event.preventDefault();
            event.stopPropagation();
            
            const btn = form.querySelector('button[type="submit"]');
            if(btn) btn.style.opacity = '0.5';

            try {
                const formData = new FormData(form);
                const url = form.getAttribute('action');
                
                const response = await fetch(url, {
                    method: 'POST', // The form has _method=PATCH inside
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showToast(data.message, 'success');
                    if (data.html) {
                        form.outerHTML = data.html;
                    }
                } else {
                    showToast('An error occurred.', 'error');
                }
            } catch (error) {
                showToast('Network error.', 'error');
            } finally {
                if(document.body.contains(btn)) {
                    btn.style.opacity = '1';
                }
            }
        };

        // Auto-hide initial toasts after 4 seconds
        setTimeout(() => {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(100%)';
                setTimeout(() => toast.remove(), 300);
            });
        }, 4000);
    </script>
    @stack('scripts')
</body>
</html>
