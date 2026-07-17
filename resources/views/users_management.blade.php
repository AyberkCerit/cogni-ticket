@extends('layouts.app')
@section('title', 'SupportHub - User Management')

@section('extra_css')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 8px; height: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(131, 116, 108, 0.2); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(131, 116, 108, 0.5); }
</style>
@endsection

@section('content')
<main class="flex-1 h-full flex flex-col relative z-10">
    <div class="glass-panel rounded-[32px] w-full h-full flex flex-col overflow-hidden relative">
        <!-- Header -->
        <header class="px-8 py-6 border-b border-outline-variant/30 flex justify-between items-center bg-surface-container-low/50 relative z-20">
            <div>
                <h1 class="text-4xl font-display-lg font-bold bg-[linear-gradient(to_right,#FF5A5A,#FF8B5A,#FFA95A,#FFD45A)] bg-clip-text text-transparent">User Management</h1>
                <p class="text-on-surface-variant text-sm mt-1 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#FF5A5A] animate-pulse shadow-[0_0_10px_rgba(255,90,90,0.8)]"></span>
                    Manage registered users and admins
                </p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-[#FF8B5A] transition-colors">search</span>
                    <input type="text" placeholder="Search users..." class="w-72 bg-surface-container-high/50 border border-outline-variant/50 rounded-full py-2.5 pl-11 pr-4 text-sm text-on-surface placeholder:text-on-surface-variant/60 focus:outline-none focus:border-[#FF8B5A] focus:ring-2 focus:ring-[#FF8B5A]/20 transition-all">
                </div>
            </div>
        </header>

        <!-- Users Table -->
        <div class="flex-1 overflow-auto relative z-10 p-8 custom-scrollbar">
            <div class="bg-white rounded-3xl border border-gray-200 shadow-[0_10px_40px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/90 backdrop-blur-md sticky top-0 z-20">
                        <tr>
                            <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200 w-16">ID</th>
                            <th class="py-4 px-4 font-bold text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200">User Name</th>
                            <th class="py-4 px-4 font-bold text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200">Email</th>
                            <th class="py-4 px-4 font-bold text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200">Role</th>
                            <th class="py-4 px-4 font-bold text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200">Joined</th>
                            <th class="py-4 px-6 font-bold text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        @forelse($users as $user)
                        <tr class="border-b border-gray-100 hover:bg-orange-50/50 transition-colors group">
                            <td class="py-4 px-6 font-mono text-[#FF5A5A] font-semibold text-[11px]">#USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="py-4 px-4 text-gray-900 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[linear-gradient(to_bottom_right,#FF5A5A,#FFA95A)] text-white flex items-center justify-center font-bold text-[10px] uppercase shadow-sm">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <span class="font-medium text-sm">{{ $user->name }}</span>
                            </td>
                            <td class="py-4 px-4 text-gray-500">{{ $user->email }}</td>
                            <td class="py-4 px-4">
                                @if(strtolower($user->role) === 'admin')
                                    <span class="inline-flex items-center text-[10px] font-bold text-[#FF5A5A] bg-[#FF5A5A]/10 px-2.5 py-1 rounded-full border border-[#FF5A5A]/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#FF5A5A] mr-1.5 shadow-[0_0_5px_rgba(255,90,90,0.5)]"></span> Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-[10px] font-medium text-gray-700 bg-gray-100 px-2.5 py-1 rounded-full border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span> Customer
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-gray-500 font-mono text-[11px]">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="py-4 px-6 text-right">
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-all rounded-lg hover:bg-red-50 opacity-0 group-hover:opacity-100 focus:opacity-100" title="Delete User">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[10px] text-gray-400 italic px-2">Current</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-500 flex flex-col items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-[48px] opacity-20">group_off</span>
                                <p>No users found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="p-6 bg-gray-50/50 border-t border-gray-100 flex justify-between items-center mt-auto">
                    <div class="text-xs text-gray-500 font-medium">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
