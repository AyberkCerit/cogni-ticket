@extends('layouts.app')
@section('title', 'SupportHub - Tickets')
@section('extra_css')
    @vite(['resources/css/tickets.css'])
@endsection

@section('content')
<!-- Main Tickets Area -->
<main class="flex-1 rounded-[32px] glass-panel p-8 overflow-y-auto relative flex flex-col">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <h2 class="font-display-lg text-3xl md:text-4xl text-on-surface tracking-tight font-bold neon-glow-bg"><span class="neon-text">Support</span> Tickets</h2>
            <p class="text-on-surface-variant mt-2 text-sm font-mono uppercase">
                ALL TICKETS 
                @if(request('status') || request('priority'))
                    | ACTIVE FILTERS: 
                    @if(request('status')) <span class="neon-text font-bold">{{ request('status') }}</span> @endif
                    @if(request('status') && request('priority')) &amp; @endif
                    @if(request('priority')) <span class="neon-text font-bold">{{ request('priority') }} priority</span> @endif
                @else
                    | ACTIVE FILTERS: NONE
                @endif
            </p>
        </div>
        <form id="filter-form" method="GET" action="{{ route('tickets.index') }}" class="flex flex-wrap items-center gap-3">
            <!-- Status Filter -->
            <div class="relative">
                <select name="status" onchange="this.form.submit()" class="appearance-none pl-4 pr-8 py-2 text-xs border border-outline-variant/80 rounded-full font-bold text-on-surface bg-surface-container-high/60 backdrop-blur-md shadow-sm hover:bg-surface-container-high hover:border-primary/50 transition-all focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/50 cursor-pointer">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[14px] text-primary pointer-events-none">expand_more</span>
            </div>

            <!-- Priority Filter -->
            <div class="relative">
                <select name="priority" onchange="this.form.submit()" class="appearance-none pl-4 pr-8 py-2 text-xs border border-outline-variant/80 rounded-full font-bold text-on-surface bg-surface-container-high/60 backdrop-blur-md shadow-sm hover:bg-surface-container-high hover:border-primary/50 transition-all focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/50 cursor-pointer">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[14px] text-primary pointer-events-none">expand_more</span>
            </div>

            <!-- Sort By -->
            <div class="relative">
                <select name="sort" onchange="this.form.submit()" class="appearance-none pl-4 pr-8 py-2 text-xs border border-outline-variant/80 rounded-full font-bold text-on-surface bg-surface-container-high/60 backdrop-blur-md shadow-sm hover:bg-surface-container-high hover:border-primary/50 transition-all focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/50 cursor-pointer">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                </select>
                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-[14px] text-primary pointer-events-none">expand_more</span>
            </div>
            
            @if(request()->hasAny(['status', 'priority', 'sort']) && (request('status') || request('priority') || request('sort') == 'oldest'))
                <a href="{{ route('tickets.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-error/10 text-error hover:bg-error hover:text-white transition-colors" title="Clear Filters">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </a>
            @endif
        </form>
    </div>

    <!-- Ticket List Panel -->
    <div class="glass-panel rounded-2xl overflow-hidden flex-1 flex flex-col border border-outline-variant/80 shadow-[0_8px_32px_rgba(0,0,0,0.15)]">
        <div class="overflow-x-auto custom-scrollbar flex-1">
            <table class="w-full text-left border-collapse relative">
                <thead class="sticky top-0 bg-surface-container/60 backdrop-blur-md z-10 border-b border-outline-variant/80">
                    <tr class="text-on-surface-variant font-label-sm tracking-wide">
                        <th class="py-4 px-4 pl-6 font-medium uppercase text-[10px]">ID</th>
                        <th class="py-4 px-4 font-medium uppercase text-[10px]">Subject</th>
                        <th class="py-4 px-4 font-medium uppercase text-[10px]">Customer</th>
                        <th class="py-4 px-4 font-medium uppercase text-[10px]">Status</th>
                        <th class="py-4 px-4 font-medium uppercase text-[10px]">Priority</th>
                        <th class="py-4 px-4 font-medium uppercase text-[10px]">Time</th>
                        <th class="py-4 px-4 pr-6 font-medium uppercase text-[10px] text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @forelse($tickets as $ticket)
                    <tr onclick="window.location='{{ route('tickets.show', $ticket->id) }}'" class="border-b border-outline-variant/60 hover:bg-surface-container-low transition-colors group cursor-pointer">
                        <td class="py-4 px-4 pl-6 font-mono text-primary font-semibold text-[10px]">#TKT-{{ str_pad($ticket->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-4 px-4 font-medium text-on-surface max-w-[14rem] truncate">{{ $ticket->title }}</td>
                        <td class="py-4 px-4 text-on-surface flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-secondary-container text-on-surface flex items-center justify-center font-bold text-[10px] uppercase">
                                {{ substr($ticket->user->name ?? 'Un', 0, 2) }}
                            </div>
                            {{ $ticket->user->name ?? 'Unknown' }}
                        </td>
                        <td class="py-4 px-4">
                            <x-ticket-status :ticket="$ticket" :interactive="false" />
                        </td>
                        <td class="py-4 px-4">
                            <x-ticket-priority :ticket="$ticket" :interactive="false" />
                        </td>
                        <td class="py-4 px-4 text-on-surface-variant font-mono text-[10px]">{{ $ticket->created_at->diffForHumans() }}</td>
                        <td class="py-4 px-4 pr-6 text-right" onclick="event.stopPropagation()">
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
                        <td colspan="7" class="py-8 text-center text-on-surface-variant text-xs">
                            No tickets found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if ($tickets->hasPages())
        <div class="p-4 border-t border-outline-variant/30 flex items-center justify-between bg-surface-container/50 backdrop-blur-md">
            <span class="text-xs text-on-surface-variant">Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }} of {{ $tickets->total() }} entries</span>
            <div class="flex gap-1">
                {{-- Previous Page Link --}}
                @if ($tickets->onFirstPage())
                <button class="w-7 h-7 flex items-center justify-center rounded border border-outline-variant/50 text-on-surface-variant/50 cursor-not-allowed transition-colors" disabled>
                    <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                </button>
                @else
                <a href="{{ $tickets->previousPageUrl() }}" class="w-7 h-7 flex items-center justify-center rounded border border-outline-variant/50 text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-[16px]">chevron_left</span>
                </a>
                @endif

                {{-- Page Numbers --}}
                @foreach(range(1, $tickets->lastPage()) as $i)
                    @if($i >= $tickets->currentPage() - 2 && $i <= $tickets->currentPage() + 2)
                        @if ($i == $tickets->currentPage())
                            <span class="w-7 h-7 flex items-center justify-center rounded bg-primary-container/60 text-primary font-medium shadow-[0_0_10px_rgba(255,199,167,0.3)]">{{ $i }}</span>
                        @else
                            <a href="{{ $tickets->url($i) }}" class="w-7 h-7 flex items-center justify-center rounded border border-outline-variant/50 text-on-surface-variant hover:bg-surface-container-high transition-colors text-xs">{{ $i }}</a>
                        @endif
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($tickets->hasMorePages())
                <a href="{{ $tickets->nextPageUrl() }}" class="w-7 h-7 flex items-center justify-center rounded border border-outline-variant/50 text-on-surface-variant hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </a>
                @else
                <button class="w-7 h-7 flex items-center justify-center rounded border border-outline-variant/50 text-on-surface-variant/50 cursor-not-allowed transition-colors" disabled>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </button>
                @endif
            </div>
        </div>
        @endif
    </div>
</main>
@endsection
