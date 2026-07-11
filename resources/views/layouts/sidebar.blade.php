<!-- Mobile sidebar backdrop -->
<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

<!-- Sidebar Component -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-72 bg-[#0a1120] text-slate-300 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto flex flex-col border-r border-slate-800 shadow-2xl lg:shadow-none">
    
    <!-- Logo -->
    <div class="flex items-center h-20 px-6 bg-[#060a13] border-b border-slate-800/50">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-white">
            <div class="p-2 bg-[#176b87]/20 rounded-xl border border-[#176b87]/30">
                <svg class="w-7 h-7 text-[#176b87]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <span class="text-2xl font-bold tracking-tight bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">QR Panel</span>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Ana Menü</p>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard', 'admin.shipments.*') ? 'bg-[#176b87] text-white shadow-lg shadow-[#176b87]/20 font-semibold' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 font-medium' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard', 'admin.shipments.*') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span>Belgeler</span>
        </a>

        @if(auth()->user()->role === 'owner')
        <div class="pt-6 mt-6 border-t border-slate-800/50">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4">Yönetim</p>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-[#176b87] text-white shadow-lg shadow-[#176b87]/20 font-semibold' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>Kullanıcı Yönetimi</span>
            </a>
        </div>
        @endif
    </nav>

    <!-- User Profile Footer -->
    <div class="p-5 border-t border-slate-800/80 bg-[#060a13]">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-gradient-to-br from-[#176b87] to-[#083344] flex items-center justify-center text-white font-bold shadow-lg shadow-[#176b87]/20 border border-white/10">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs font-medium text-[#176b87] truncate uppercase tracking-wider">{{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>
</aside>
