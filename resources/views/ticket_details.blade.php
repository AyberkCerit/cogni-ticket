@extends('layouts.app')
@section('title', 'SupportHub - Ticket #' . str_pad($ticket->id, 4, '0', STR_PAD_LEFT))
@section('wrapper_class', 'flex-row gap-6')

@section('extra_css')
<style>
    /* Custom Scrollbar for Chat */
    .chat-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .chat-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .chat-scroll::-webkit-scrollbar-thumb {
        background: rgba(213, 195, 186, 0.5); /* outline-variant */
        border-radius: 10px;
    }
    .chat-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(131, 116, 108, 0.8); /* outline */
    }
</style>
@endsection

@section('content')
<!-- Left Pane: Ticket Details -->
<div class="w-1/3 flex flex-col gap-6 h-full">
    <!-- Back Button & Header -->
    <div class="flex items-center gap-4 glass-panel p-4 rounded-[24px]">
        <a href="{{ route('tickets.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="text-xl font-bold text-on-surface">Ticket Details</h1>
            <p class="text-xs text-primary font-mono">#TKT-{{ str_pad($ticket->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    <!-- Info Card -->
    <div class="flex-1 glass-panel rounded-[32px] p-8 overflow-y-auto chat-scroll flex flex-col gap-6">
        
        <div>
            <h2 class="text-2xl font-bold neon-text mb-2">{{ $ticket->title }}</h2>
            <div class="flex flex-wrap gap-2 text-xs">
                <x-ticket-status :ticket="$ticket" :interactive="true" />
                <x-ticket-priority :ticket="$ticket" :interactive="true" />
                
                <span class="text-on-surface-variant font-mono bg-surface-container-high px-2 py-1 rounded border border-outline-variant flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">schedule</span>
                    {{ $ticket->created_at->format('M d, Y H:i') }}
                </span>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="bg-surface-container/50 rounded-2xl p-4 border border-outline-variant/30 flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-secondary-container text-on-surface flex items-center justify-center font-bold text-lg uppercase">
                {{ substr($ticket->user->name ?? 'Un', 0, 2) }}
            </div>
            <div>
                <div class="text-sm text-on-surface-variant">Customer</div>
                <div class="font-bold text-on-surface text-lg">{{ $ticket->user->name ?? 'Unknown User' }}</div>
                <div class="text-xs text-primary">{{ $ticket->user->email ?? 'No email provided' }}</div>
            </div>
        </div>

        <!-- Description -->
        <div>
            <h3 class="text-sm text-on-surface-variant mb-2 uppercase tracking-wider font-bold">Description</h3>
            <div class="bg-surface-container-high/50 rounded-2xl p-5 border border-outline-variant/20 text-sm leading-relaxed text-on-surface">
                {{ $ticket->description }}
            </div>
        </div>

        <!-- Attachments -->
        @if($ticket->attachments && $ticket->attachments->count() > 0)
        <div>
            <h3 class="text-sm text-on-surface-variant mb-2 uppercase tracking-wider font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">attachment</span> 
                Attachments
            </h3>
            <div class="grid grid-cols-2 gap-4">
                @foreach($ticket->attachments as $attachment)
                    @if(Str::startsWith($attachment->file_type, 'image/'))
                        <!-- Image Attachment -->
                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="block group relative rounded-xl overflow-hidden border border-outline-variant/30 bg-surface-container-high aspect-video">
                            <img src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                                <span class="text-xs font-medium text-on-surface truncate">{{ $attachment->file_name }}</span>
                            </div>
                        </a>
                    @else
                        <!-- File Attachment (PDF, DOCX, etc.) -->
                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl border border-outline-variant/30 bg-surface-container hover:bg-surface-container-high transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-primary-container/30 text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined">description</span>
                            </div>
                            <div class="overflow-hidden">
                                <div class="text-sm font-medium text-on-surface truncate">{{ $attachment->file_name }}</div>
                                <div class="text-[10px] text-on-surface-variant uppercase">{{ explode('/', $attachment->file_type)[1] ?? 'FILE' }}</div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
        
        @if($ticket->is_ai_processed && $ticket->ai_summary)
        <!-- AI Summary -->
        <div>
            <h3 class="text-sm text-on-surface-variant mb-2 uppercase tracking-wider font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary text-[18px]">smart_toy</span> 
                AI Summary
            </h3>
            <div class="bg-tertiary-fixed/10 rounded-2xl p-5 border border-tertiary/20 text-sm leading-relaxed text-on-surface">
                {{ $ticket->ai_summary }}
            </div>
        </div>
        @endif

    </div>
</div>

<!-- Right Pane: Chat Window -->
<div class="w-2/3 h-full glass-panel rounded-[32px] flex flex-col relative overflow-hidden">
    <!-- Chat Header -->
    <div class="h-20 border-b border-outline-variant/30 bg-surface-container/50 backdrop-blur-md flex items-center px-8 justify-between shrink-0">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-[28px]">forum</span>
            <div>
                <h2 class="font-bold text-lg text-on-surface">Ticket Discussion</h2>
                <p class="text-xs text-on-surface-variant font-mono">End-to-end communication log</p>
            </div>
        </div>
        <div class="flex gap-2">
            <!-- Example action buttons -->
            <button class="w-10 h-10 rounded-full bg-surface-container hover:bg-surface-container-high border border-outline-variant/50 flex items-center justify-center text-on-surface-variant transition-colors">
                <span class="material-symbols-outlined text-[18px]">more_vert</span>
            </button>
        </div>
    </div>

    <!-- Chat Messages Area -->
    <div class="flex-1 overflow-y-auto chat-scroll p-8 flex flex-col gap-6" id="chat-container">
        
        <!-- Initial ticket creation message (System/User) -->
        <div class="flex justify-start w-full">
            <div class="flex gap-3 max-w-[80%]">
                <div class="w-8 h-8 rounded-full bg-secondary-container shrink-0 flex items-center justify-center font-bold text-xs uppercase mt-1">
                    {{ substr($ticket->user->name ?? 'Un', 0, 2) }}
                </div>
                <div>
                    <div class="flex items-baseline gap-2 mb-1">
                        <span class="font-bold text-sm text-on-surface">{{ $ticket->user->name ?? 'Unknown' }}</span>
                        <span class="text-[10px] text-on-surface-variant font-mono">{{ $ticket->created_at->format('H:i') }}</span>
                    </div>
                    <div class="bg-surface-container-high p-4 rounded-2xl rounded-tl-sm border border-outline-variant/30 text-sm">
                        <span class="block mb-2 font-bold text-primary">Ticket created.</span>
                        {{ $ticket->description }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Loop through messages -->
        @foreach($ticket->messages as $msg)
            @if($msg->user_id === Auth::id())
                <!-- My Message (Right aligned) -->
                <div class="flex justify-end w-full">
                    <div class="flex gap-3 max-w-[80%] flex-row-reverse">
                        <div class="w-8 h-8 rounded-full border border-primary shrink-0 overflow-hidden mt-1">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=684126&color=ffdbc8" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col items-end">
                            <div class="flex items-baseline gap-2 mb-1 flex-row-reverse">
                                <span class="font-bold text-sm text-primary">You</span>
                                <span class="text-[10px] text-on-surface-variant font-mono">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                            <div class="bg-primary-container/30 p-4 rounded-2xl rounded-tr-sm border border-primary-container/50 text-sm text-on-surface shadow-[0_0_15px_rgba(255,219,200,0.05)]">
                                {{ $msg->message }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Other User Message (Left aligned) -->
                <div class="flex justify-start w-full">
                    <div class="flex gap-3 max-w-[80%]">
                        <div class="w-8 h-8 rounded-full bg-surface-container-high border border-outline-variant shrink-0 flex items-center justify-center font-bold text-xs uppercase mt-1">
                            {{ substr($msg->user->name ?? 'Un', 0, 2) }}
                        </div>
                        <div>
                            <div class="flex items-baseline gap-2 mb-1">
                                <span class="font-bold text-sm text-on-surface">{{ $msg->user->name ?? 'Unknown' }}</span>
                                <span class="text-[10px] text-on-surface-variant font-mono">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                            <div class="bg-surface-container-high p-4 rounded-2xl rounded-tl-sm border border-outline-variant/30 text-sm">
                                {{ $msg->message }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>

    <!-- Chat Input Area -->
    <div class="p-6 bg-surface-container/80 backdrop-blur-md border-t border-outline-variant/30 shrink-0">
        <form action="{{ route('tickets.message', $ticket->id) }}" method="POST" class="flex gap-4">
            @csrf
            <div class="flex-1 relative">
                <input type="text" name="message" placeholder="Type your message here..." required 
                    class="w-full bg-surface-container-high border border-outline-variant/50 text-on-surface rounded-full py-4 pl-6 pr-12 focus:ring-1 focus:ring-primary focus:border-primary placeholder:text-on-surface-variant/50 transition-all text-sm shadow-inner">
                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px]">attach_file</span>
                </button>
            </div>
            <button type="submit" class="w-14 h-14 rounded-full bg-primary text-surface-container-low flex items-center justify-center hover:bg-[#ffeddf] transition-colors shadow-[0_0_20px_rgba(255,219,200,0.3)] hover:shadow-[0_0_30px_rgba(255,219,200,0.5)] shrink-0 group">
                <span class="material-symbols-outlined group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">send</span>
            </button>
        </form>
    </div>
</div>

<script>
    // Scroll chat to bottom on load
    const chatContainer = document.getElementById('chat-container');
    if(chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
</script>
@endsection
