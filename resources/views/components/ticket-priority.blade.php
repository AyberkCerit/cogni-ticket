@props(['ticket', 'interactive' => false])
@php $priorityValue = $ticket->priority instanceof \UnitEnum ? $ticket->priority->value : $ticket->priority; @endphp

@if(Auth::user()->role === 'admin' && $interactive)
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="inline-block" onsubmit="window.handleAjaxSubmit(event, this)" onclick="event.stopPropagation()">
        @csrf
        @method('PATCH')
        <input type="hidden" name="cycle_priority" value="1">
        <button type="submit" class="focus:outline-none hover:opacity-80 transition-opacity" title="Click to change priority">
            @if(strtolower($priorityValue) === 'urgent')
                <span class="inline-flex items-center text-[10px] text-[#D90000] font-medium bg-[#D90000]/10 px-2 py-1 rounded border border-[#D90000]/20 animate-pulse">Urgent Priority</span>
            @elseif(strtolower($priorityValue) === 'high')
                <span class="inline-flex items-center text-[10px] text-[#D90000] font-medium bg-[#D90000]/10 px-2 py-1 rounded border border-[#D90000]/20">High Priority</span>
            @elseif(strtolower($priorityValue) === 'medium')
                <span class="inline-flex items-center text-[10px] text-[#c7a718] font-bold bg-[#FFDE4E]/20 px-2 py-1 rounded border border-[#FFDE4E]/50">Medium Priority</span>
            @elseif(strtolower($priorityValue) === 'low')
                <span class="inline-flex items-center text-[10px] text-[#7a9e1e] font-bold bg-[#A1CB35]/20 px-2 py-1 rounded border border-[#A1CB35]/50">Low Priority</span>
            @else
                <span class="inline-flex items-center text-[10px] text-on-surface-variant font-medium bg-surface-container-high px-2 py-1 rounded border border-outline-variant">{{ ucfirst($priorityValue) }} Priority</span>
            @endif
        </button>
    </form>
@else
    @if(strtolower($priorityValue) === 'urgent')
        <span class="inline-flex items-center text-[10px] text-[#D90000] font-medium bg-[#D90000]/10 px-2 py-1 rounded border border-[#D90000]/20 animate-pulse">Urgent Priority</span>
    @elseif(strtolower($priorityValue) === 'high')
        <span class="inline-flex items-center text-[10px] text-[#D90000] font-medium bg-[#D90000]/10 px-2 py-1 rounded border border-[#D90000]/20">High Priority</span>
    @elseif(strtolower($priorityValue) === 'medium')
        <span class="inline-flex items-center text-[10px] text-[#c7a718] font-bold bg-[#FFDE4E]/20 px-2 py-1 rounded border border-[#FFDE4E]/50">Medium Priority</span>
    @elseif(strtolower($priorityValue) === 'low')
        <span class="inline-flex items-center text-[10px] text-[#7a9e1e] font-bold bg-[#A1CB35]/20 px-2 py-1 rounded border border-[#A1CB35]/50">Low Priority</span>
    @else
        <span class="inline-flex items-center text-[10px] text-on-surface-variant font-medium bg-surface-container-high px-2 py-1 rounded border border-outline-variant">{{ ucfirst($priorityValue) }} Priority</span>
    @endif
@endif
