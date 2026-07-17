@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- Main Command Center Area -->
<main class="flex-1 rounded-[32px] glass-panel p-8 overflow-y-auto relative">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <h2 class="font-display-lg text-3xl md:text-4xl text-on-surface tracking-tight font-bold neon-glow-bg"><span class="neon-text">{{ __('Welcome') }}</span> , {{Auth::user()->name}}</h2>
            <p class="text-on-surface-variant mt-2 text-sm font-mono">{{ __('Todays Summary:') }}<span class="neon-text">{{today()->format('Y-m-d')}}</span></p>
        </div>
    </div>
    
    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <!-- Stat 1 -->
        <div class="glass-panel rounded-2xl p-6 relative overflow-hidden group hover:border-primary-container transition-colors duration-500">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-error/10 rounded-full blur-2xl group-hover:bg-error/20 transition-colors"></div>
            <p class="text-on-surface-variant font-label-sm uppercase tracking-wider mb-2 relative z-10 text-xs">{{ __('Open Tickets') }}</p>
            <div class="flex items-baseline gap-3 relative z-10">
                <h3 class="font-display-lg text-[48px] font-bold text-on-surface leading-none tracking-tighter"><span class="count-up" data-target="{{ $openTicketsCount }}">0</span></h3>
            </div>
            <div class="mt-6 flex items-end gap-1.5 h-10 relative z-10">
                <div class="flex-1 bg-orange-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $createdHeights[0] ?? 0 }}%; animation-delay: 0ms;"></div>
                <div class="flex-1 bg-orange-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $createdHeights[1] ?? 0 }}%; animation-delay: 100ms;"></div>
                <div class="flex-1 bg-orange-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $createdHeights[2] ?? 0 }}%; animation-delay: 200ms;"></div>
                <div class="flex-1 bg-orange-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $createdHeights[3] ?? 0 }}%; animation-delay: 300ms;"></div>
                <div class="flex-1 bg-orange-500 rounded-t-sm shadow-[0_0_15px_rgba(249,115,22,0.5)] animate-bar" style="--target-height: {{ $createdHeights[4] ?? 0 }}%; animation-delay: 400ms;"></div>
            </div>
        </div>
        
        <!-- Stat 2 -->
        <div class="glass-panel rounded-2xl p-6 relative overflow-hidden group hover:border-tertiary-fixed transition-colors duration-500">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-tertiary-fixed/30 rounded-full blur-2xl group-hover:bg-tertiary-fixed/50 transition-colors"></div>
            <p class="text-on-surface-variant font-label-sm uppercase tracking-wider mb-2 relative z-10 text-xs">{{ __('Resolved Today') }}</p>
            <div class="flex items-baseline gap-3 relative z-10">
                <h3 class="font-display-lg text-[48px] font-bold text-on-surface leading-none tracking-tighter"><span class="count-up" data-target="{{ $resolvedTodayCount }}">0</span></h3>
            </div>
            <div class="mt-6 flex items-end gap-1.5 h-10 relative z-10">
                <div class="flex-1 bg-emerald-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $resolvedHeights[0] ?? 0 }}%; animation-delay: 0ms;"></div>
                <div class="flex-1 bg-emerald-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $resolvedHeights[1] ?? 0 }}%; animation-delay: 100ms;"></div>
                <div class="flex-1 bg-emerald-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $resolvedHeights[2] ?? 0 }}%; animation-delay: 200ms;"></div>
                <div class="flex-1 bg-emerald-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $resolvedHeights[3] ?? 0 }}%; animation-delay: 300ms;"></div>
                <div class="flex-1 bg-emerald-500 rounded-t-sm shadow-[0_0_15px_rgba(16,185,129,0.5)] animate-bar" style="--target-height: {{ $resolvedHeights[4] ?? 0 }}%; animation-delay: 400ms;"></div>
            </div>
        </div>
        
        <!-- Stat 3 -->
        <div class="glass-panel rounded-2xl p-6 relative overflow-hidden group hover:border-outline transition-colors duration-500">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-surface-variant/50 rounded-full blur-2xl group-hover:bg-surface-variant transition-colors"></div>
            <p class="text-on-surface-variant font-label-sm uppercase tracking-wider mb-2 relative z-10 text-xs">{{ __('Avg Response Time') }}</p>
            <div class="flex items-baseline gap-3 relative z-10">
                <h3 class="font-display-lg text-[48px] font-bold text-on-surface leading-none tracking-tighter"><span class="count-up" data-target="{{ $avgResponseHours }}">0</span><span class="text-2xl text-on-surface-variant">h</span> <span class="count-up" data-target="{{ $avgResponseMins }}">0</span><span class="text-2xl text-on-surface-variant">m</span></h3>
            </div>
            <div class="mt-6 flex items-end gap-1.5 h-10 relative z-10">
                <div class="flex-1 bg-blue-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $avgTimeHeights[0] ?? 0 }}%; animation-delay: 0ms;"></div>
                <div class="flex-1 bg-blue-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $avgTimeHeights[1] ?? 0 }}%; animation-delay: 100ms;"></div>
                <div class="flex-1 bg-blue-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $avgTimeHeights[2] ?? 0 }}%; animation-delay: 200ms;"></div>
                <div class="flex-1 bg-blue-500/20 rounded-t-sm animate-bar" style="--target-height: {{ $avgTimeHeights[3] ?? 0 }}%; animation-delay: 300ms;"></div>
                <div class="flex-1 bg-blue-500 rounded-t-sm shadow-[0_0_15px_rgba(59,130,246,0.5)] animate-bar" style="--target-height: {{ $avgTimeHeights[4] ?? 0 }}%; animation-delay: 400ms;"></div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Content Grid -->
    <div class="flex flex-col lg:flex-row gap-5">
        <!-- Recent Tickets Feed -->
        <div class="glass-panel rounded-2xl p-6 flex-[7]">
            <div class="pb-6 flex justify-between items-center border-b border-outline-variant/50">
                <h3 class="font-headline-md text-xl font-semibold text-on-surface tracking-tight flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.7)] animate-pulse"></div>
                    {{ __('Recent Tickets') }}
                </h3>
                <a class="text-xs font-medium text-primary hover:text-primary-container transition-colors flex items-center gap-1 bg-primary-container/30 px-3 py-1.5 rounded-full border border-primary-container/40" href="{{ route('tickets.index') }}">
                    {{ __('View All') }} <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
            <div class="overflow-x-auto mt-3">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-on-surface-variant font-label-sm tracking-wide">
                            <th class="py-3 px-3 font-medium uppercase text-[10px]">{{ __('Ticket / Subject') }}</th>
                            <th class="py-3 px-3 font-medium uppercase text-[10px]">{{ __('Customer') }}</th>
                            <th class="py-3 px-3 font-medium uppercase text-[10px]">{{ __('Status') }}</th>
                            <th class="py-3 px-3 font-medium uppercase text-[10px]">{{ __('Priority') }}</th>
                            <th class="py-3 px-3 font-medium uppercase text-[10px]">{{ __('Time') }}</th>
                            <th class="py-3 px-3"></th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        @forelse($recentTickets as $ticket)
                        <tr onclick="window.location='{{ route('tickets.show', $ticket->id) }}'" class="border-b border-outline-variant/30 hover:bg-surface-container-low transition-colors group cursor-pointer">
                            <td class="py-4 px-3">
                                <div class="font-mono text-primary mb-0.5 text-[10px]">#TKT-{{ str_pad($ticket->id, 4, '0', STR_PAD_LEFT) }}</div>
                                <div class="text-on-surface truncate max-w-[14rem] font-medium">{{ $ticket->title }}</div>
                            </td>
                            <td class="py-4 px-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-surface-container-high border border-outline-variant text-on-surface flex items-center justify-center font-bold text-[10px] uppercase">
                                        {{ substr($ticket->user->name ?? 'Un', 0, 2) }}
                                    </div>
                                    <span class="font-medium text-on-surface-variant">{{ $ticket->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-3">
                                <x-ticket-status :ticket="$ticket" :interactive="false" />
                            </td>
                            <td class="py-4 px-3">
                                <x-ticket-priority :ticket="$ticket" :interactive="false" />
                            </td>
                            <td class="py-4 px-3 text-on-surface-variant font-mono text-[10px]">{{ $ticket->created_at->diffForHumans() }}</td>
                            <td class="py-4 px-3 text-right" onclick="event.stopPropagation()">
                                @if(Auth::user()->role === 'admin')
                                    <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-on-surface-variant hover:text-error transition-all rounded hover:bg-error/10" title="Delete">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="flex items-center justify-end opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-[18px] text-on-surface-variant">chevron_right</span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-on-surface-variant text-xs">
                                {{ __('No recent tickets found.') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- AI Summary Panel -->
        <div class="glass-panel rounded-2xl p-6 flex-[3] flex flex-col">
            <h3 class="font-headline-md text-xl font-semibold text-on-surface tracking-tight mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[20px]">auto_awesome</span>
                {{ __('Recent AI Summary') }}
            </h3>
            <ul class="space-y-3 text-on-surface-variant text-xs flex-1 font-medium">
                @foreach($aiSummary as $index => $bullet)
                <li class="flex items-start gap-2">
                    @php
                        $colors = ['bg-error shadow-[0_0_5px_rgba(186,26,26,0.4)]', 'bg-tertiary', 'bg-primary shadow-[0_0_5px_rgba(126,85,59,0.4)]'];
                        $colorClass = $colors[$index % count($colors)];
                    @endphp
                    <span class="w-1 h-1 rounded-full {{ $colorClass }} mt-1.5 shrink-0"></span>
                    <span>{{ $bullet }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</main>

@push('scripts')
    @vite(['resources/js/dashboard.js'])
@endpush
@endsection
