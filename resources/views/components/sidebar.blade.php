<!-- Floating Vertical Dock -->
<nav class="floating-dock h-[calc(100vh-32px)] w-20 fixed left-4 top-4 rounded-3xl z-40 flex flex-col items-center py-6 gap-6 glass-panel border border-outline-variant/30 hidden md:flex">
    <!-- Brand Icon -->
    <div class="w-10 h-10 rounded-full bg-surface-container border border-orange-500/30 flex items-center justify-center shadow-[0_0_15px_rgba(249,115,22,0.3)] relative group cursor-pointer" onclick="window.location='{{ route('contact.create') }}'" title="{{ __('Contact Us') }}">
        <span class="material-symbols-outlined text-orange-500 drop-shadow-[0_0_5px_rgba(249,115,22,0.8)] text-[20px]" data-original-icon="headset_mic" style="font-variation-settings: 'FILL' 1;">headset_mic</span>
        <div class="absolute inset-0 rounded-full border border-orange-500/50 opacity-50 group-hover:animate-ping" style="animation-duration: 3s;"></div>
    </div>
    
    <!-- Navigation Links -->
    <div class="flex flex-col gap-4 flex-1 justify-center w-full items-center">
        <!-- Dashboard -->
        <a class="w-12 h-12 flex items-center justify-center rounded-2xl transition-all duration-300 group relative {{ request()->routeIs('dashboard') ? 'bg-orange-500/20 text-orange-500 border border-orange-500/30 shadow-[0_0_20px_rgba(249,115,22,0.3)]' : 'text-on-surface-variant hover:text-orange-400 hover:bg-orange-500/10 hover:shadow-[0_0_15px_rgba(249,115,22,0.2)]' }}" href="{{ route('dashboard') }}" title="{{ __('Dashboard') }}">
            <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' {{ request()->routeIs('dashboard') ? '1' : '0' }};">dashboard</span>
            @if(request()->routeIs('dashboard'))
            <div class="absolute right-[-4px] w-2 h-2 rounded-full bg-orange-500 shadow-[0_0_10px_rgba(249,115,22,0.8)]"></div>
            @endif
        </a>
        <!-- Tickets -->
        <a class="w-12 h-12 flex items-center justify-center rounded-2xl transition-all duration-300 group relative {{ request()->routeIs('tickets.*') ? 'bg-orange-500/20 text-orange-500 border border-orange-500/30 shadow-[0_0_20px_rgba(249,115,22,0.3)]' : 'text-on-surface-variant hover:text-orange-400 hover:bg-orange-500/10 hover:shadow-[0_0_15px_rgba(249,115,22,0.2)]' }}" href="{{ route('tickets.index') }}" title="{{ __('Tickets') }}">
            <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' {{ request()->routeIs('tickets.*') ? '1' : '0' }};">confirmation_number</span>
            @if(request()->routeIs('tickets.*'))
            <div class="absolute right-[-4px] w-2 h-2 rounded-full bg-orange-500 shadow-[0_0_10px_rgba(249,115,22,0.8)]"></div>
            @endif
        </a>
        <!-- Users -->
        @if(Auth::user()->role === 'admin')
        <a class="w-12 h-12 flex items-center justify-center rounded-2xl transition-all duration-300 group relative {{ request()->routeIs('users.*') ? 'bg-orange-500/20 text-orange-500 border border-orange-500/30 shadow-[0_0_20px_rgba(249,115,22,0.3)]' : 'text-on-surface-variant hover:text-orange-400 hover:bg-orange-500/10 hover:shadow-[0_0_15px_rgba(249,115,22,0.2)]' }}" href="{{ route('users.index') }}" title="{{ __('Users') }}">
            <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' {{ request()->routeIs('users.*') ? '1' : '0' }};">group</span>
            @if(request()->routeIs('users.*'))
            <div class="absolute right-[-4px] w-2 h-2 rounded-full bg-orange-500 shadow-[0_0_10px_rgba(249,115,22,0.8)]"></div>
            @endif
        </a>
        @endif
    </div>
    
    <!-- Bottom Profile -->
    <div class="mt-auto flex flex-col gap-4 items-center w-full">
        <!-- Language Switcher -->
        @php $currentLang = app()->getLocale(); $switchLang = $currentLang === 'en' ? 'tr' : 'en'; @endphp
        <a href="{{ route('lang.switch', $switchLang) }}" class="w-10 h-10 bg-surface-container-high text-on-surface rounded-full border border-outline/50 hover:bg-orange-500/10 hover:text-orange-500 hover:border-orange-500/40 hover:shadow-[0_0_15px_rgba(249,115,22,0.3)] transition-all duration-300 flex items-center justify-center font-display-sm group" title="{{ __('Dil Değiştir') }}">
            <span class="font-bold text-xs tracking-wider group-hover:scale-110 transition-transform">{{ strtoupper($switchLang) }}</span>
        </a>

        <!-- New Ticket Button -->
        <a href="{{ route('tickets.create') }}" class="w-10 h-10 bg-orange-500/20 text-orange-500 rounded-full border border-orange-500/40 hover:bg-orange-500/40 hover:shadow-[0_0_20px_rgba(249,115,22,0.5)] transition-all duration-300 flex items-center justify-center" title="{{ __('Create New Ticket') }}">
            <span class="material-symbols-outlined text-[20px]">add</span>
        </a>
        
        <div onclick="window.location='{{ route('profile.edit') }}'" class="w-10 h-10 rounded-full border-2 border-outline-variant overflow-hidden cursor-pointer hover:border-primary-container transition-colors relative group">
            @if(Auth::user()->profile_photo)
                <img alt="Profile" class="w-full h-full object-cover" src="{{ asset('storage/' . Auth::user()->profile_photo) }}"/>
            @else
                <img alt="Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=f9ebe3&color=7e553b"/>
            @endif
            
            <!-- Quick Profile Menu (Hover) -->
            <div onclick="event.stopPropagation()" class="absolute bottom-0 left-14 hidden group-hover:flex flex-col bg-surface-container-high border border-outline-variant rounded-xl p-2 w-32 shadow-xl z-50">
                <a href="{{ route('profile.edit') }}" class="w-full text-left px-3 py-2 text-sm text-on-surface hover:bg-primary-container/30 hover:text-primary rounded-lg transition-colors flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-[16px]">person</span>
                    {{ __('Profilim') }}
                </a>
            </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="w-full flex justify-center mt-2 border-t border-outline-variant/30 pt-4">
            @csrf
            <button type="submit" class="w-10 h-10 bg-error/10 text-error rounded-full border border-error/30 hover:bg-error hover:text-on-error hover:shadow-[0_0_15px_rgba(186,26,26,0.4)] transition-all duration-300 flex items-center justify-center" title="{{ __('Çıkış Yap') }}">
                <span class="material-symbols-outlined text-[20px]">power_settings_new</span>
            </button>
        </form>
    </div>
</nav>

<!-- Mobile Navbar (Responsive enhancement) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full glass-panel border-t border-outline-variant/30 z-50 flex justify-around py-3 px-4 rounded-t-3xl shadow-[0_-10px_20px_rgba(0,0,0,0.05)]">
    <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 transition-colors {{ request()->routeIs('dashboard') ? 'text-orange-500 drop-shadow-[0_0_5px_rgba(249,115,22,0.5)]' : 'text-on-surface-variant hover:text-orange-400' }}">
        <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' {{ request()->routeIs('dashboard') ? '1' : '0' }};">dashboard</span>
    </a>
    <a href="{{ route('tickets.index') }}" class="flex flex-col items-center gap-1 transition-colors {{ request()->routeIs('tickets.*') ? 'text-orange-500 drop-shadow-[0_0_5px_rgba(249,115,22,0.5)]' : 'text-on-surface-variant hover:text-orange-400' }}">
        <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' {{ request()->routeIs('tickets.*') ? '1' : '0' }};">confirmation_number</span>
    </a>
    @if(Auth::user()->role === 'admin')
    <a href="{{ route('users.index') }}" class="flex flex-col items-center gap-1 transition-colors {{ request()->routeIs('users.*') ? 'text-orange-500 drop-shadow-[0_0_5px_rgba(249,115,22,0.5)]' : 'text-on-surface-variant hover:text-orange-400' }}">
        <span class="material-symbols-outlined text-[24px]" style="font-variation-settings: 'FILL' {{ request()->routeIs('users.*') ? '1' : '0' }};">group</span>
    </a>
    @endif
    <form method="POST" action="{{ route('logout') }}" class="flex items-center">
        @csrf
        <button type="submit" class="flex flex-col items-center gap-1 transition-colors text-on-surface-variant hover:text-error">
            <span class="material-symbols-outlined text-[24px]">logout</span>
        </button>
    </form>
</nav>
