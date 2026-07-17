@props(['ticket', 'interactive' => false])
@php $statusValue = $ticket->status instanceof \UnitEnum ? $ticket->status->value : $ticket->status; @endphp

@if(Auth::user()->role === 'admin' && $interactive)
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="inline-block" onsubmit="window.handleAjaxSubmit(event, this)" onclick="event.stopPropagation()">
        @csrf
        @method('PATCH')
        <input type="hidden" name="cycle_status" value="1">
        <button type="submit" class="focus:outline-none hover:opacity-80 transition-opacity" title="Click to change status">
            @if(strtolower($statusValue) === 'pending')
                <span class="inline-flex items-center text-[10px] font-bold text-[#008B8B] bg-[#40E0D0]/10 px-2 py-1 rounded-full border border-[#40E0D0]/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#00CED1] mr-2 shadow-[0_0_5px_rgba(0,206,209,0.5)]"></span> Pending
                </span>
            @elseif(strtolower($statusValue) === 'resolved')
                <span class="inline-flex items-center text-[10px] font-bold text-[#4d6328] bg-[#93C572]/20 px-2 py-1 rounded-full border border-[#93C572]/40">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#93C572] mr-2 shadow-[0_0_5px_rgba(147,197,114,0.5)]"></span> Resolved
                </span>
            @elseif(strtolower($statusValue) === 'closed')
                <span class="inline-flex items-center text-[10px] font-bold text-[#404040] bg-[#808080]/10 px-2 py-1 rounded-full border border-[#808080]/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#696969] mr-2"></span> Closed
                </span>
            @else
                <span class="inline-flex items-center text-[10px] font-medium text-on-surface-variant bg-surface-container-high px-2 py-1 rounded-full border border-outline-variant">
                    <span class="w-1.5 h-1.5 rounded-full bg-outline mr-2"></span> {{ ucfirst($statusValue) }}
                </span>
            @endif
        </button>
    </form>
@else
    @if(strtolower($statusValue) === 'pending')
        <span class="inline-flex items-center text-[10px] font-bold text-[#008B8B] bg-[#40E0D0]/10 px-2 py-1 rounded-full border border-[#40E0D0]/30">
            <span class="w-1.5 h-1.5 rounded-full bg-[#00CED1] mr-2 shadow-[0_0_5px_rgba(0,206,209,0.5)]"></span> Pending
        </span>
    @elseif(strtolower($statusValue) === 'resolved')
        <span class="inline-flex items-center text-[10px] font-bold text-[#4d6328] bg-[#93C572]/20 px-2 py-1 rounded-full border border-[#93C572]/40">
            <span class="w-1.5 h-1.5 rounded-full bg-[#93C572] mr-2 shadow-[0_0_5px_rgba(147,197,114,0.5)]"></span> Resolved
        </span>
    @elseif(strtolower($statusValue) === 'closed')
        <span class="inline-flex items-center text-[10px] font-bold text-[#404040] bg-[#808080]/10 px-2 py-1 rounded-full border border-[#808080]/30">
            <span class="w-1.5 h-1.5 rounded-full bg-[#696969] mr-2"></span> Closed
        </span>
    @else
        <span class="inline-flex items-center text-[10px] font-medium text-on-surface-variant bg-surface-container-high px-2 py-1 rounded-full border border-outline-variant">
            <span class="w-1.5 h-1.5 rounded-full bg-outline mr-2"></span> {{ ucfirst($statusValue) }}
        </span>
    @endif
@endif
