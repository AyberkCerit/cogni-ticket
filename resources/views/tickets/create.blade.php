@extends('layouts.app')
@section('title', 'Create New Ticket')

@section('extra_css')
    @vite(['resources/css/ticket-create.css'])
@endsection

@section('content')
<main class="flex-1 rounded-[32px] glass-panel p-8 overflow-y-auto relative flex flex-col items-center">
    <!-- Header -->
    <div class="w-full max-w-3xl mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <h2 class="font-display-lg text-3xl md:text-4xl text-on-surface tracking-tight font-bold neon-glow-bg"><span class="neon-text">Create</span> Ticket</h2>
            <p class="text-on-surface-variant mt-2 text-sm font-mono">Submit a new request for support.</p>
        </div>
        <a href="{{ route('tickets.index') }}" class="px-5 py-2 text-xs border border-outline-variant rounded-full font-medium text-on-surface hover:bg-surface-container-high transition-colors flex items-center gap-1 bg-surface-container/50 backdrop-blur-sm">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            Back to Tickets
        </a>
    </div>

    <!-- Form Container -->
    <div class="glass-panel w-full max-w-3xl rounded-2xl p-8 border border-outline-variant/30 shadow-[0_8px_32px_rgba(0,0,0,0.1)]">
        <form id="create-ticket-form" action="{{ route('tickets.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf
            
            <!-- Title -->
            <div class="flex flex-col gap-2">
                <label for="title" class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Title</label>
                <div class="relative group">
                    <input type="text" id="title" name="title" required value="{{ old('title') }}" placeholder="Briefly describe your issue..." 
                           class="w-full bg-white border border-outline-variant/50 rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/50 transition-all">
                    @error('title')
                        <span class="text-xs text-error mt-1 block font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Category -->
            <div class="flex flex-col gap-2">
                <label for="category_id" class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Category</label>
                <div class="relative group custom-select-wrapper">
                    <select id="category_id" name="category_id" required 
                            class="w-full bg-white border border-outline-variant/50 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/50 transition-all appearance-none cursor-pointer">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-4 top-3.5 text-on-surface-variant pointer-events-none">expand_more</span>
                    @error('category_id')
                        <span class="text-xs text-error mt-1 block font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-end">
                    <label for="description" class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider">Description</label>
                    <span id="char-count" class="text-xs font-mono text-on-surface-variant/70">0 chars</span>
                </div>
                <div class="relative group">
                    <textarea id="description" name="description" required rows="6" placeholder="Provide detailed information about your request..." 
                              class="w-full bg-white border border-outline-variant/50 rounded-xl px-4 py-3 text-gray-900 placeholder:text-gray-400 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/50 transition-all resize-none custom-scrollbar">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-xs text-error mt-1 block font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">error</span>{{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Submit -->
            <div class="mt-4 flex justify-end">
                <button type="submit" id="submit-btn" class="submit-glow-btn px-8 py-3 bg-primary-container text-primary font-bold rounded-xl flex items-center gap-2 transition-all relative overflow-hidden group border border-primary-container/50 hover:bg-primary-container/80">
                    <span class="btn-text">Submit Ticket</span>
                    <span class="material-symbols-outlined text-[18px] btn-icon group-hover:translate-x-1 transition-transform">send</span>
                    <!-- Loading Spinner (Hidden by default) -->
                    <svg class="hidden animate-spin w-5 h-5 text-primary loading-icon absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</main>

@push('scripts')
    @vite(['resources/js/ticket-create.js'])
@endpush
@endsection
