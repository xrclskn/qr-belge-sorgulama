<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-[#176b87] transition-colors p-2 rounded-full hover:bg-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Kullanıcı Düzenle') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">İsim Soyisim</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required placeholder="John Doe">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">E-posta Adresi</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required placeholder="john@admin.com">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Şifre (Boş Bırakırsanız Değişmez)</label>
                                <input type="password" name="password" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Yetki Seviyesi</label>
                                <select name="role" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin (Sadece belge yönetebilir)</option>
                                    <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner (Kullanıcıları da yönetebilir)</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
                            <button type="submit" class="px-6 py-3 bg-[#176b87] hover:bg-[#125368] text-white font-medium rounded-xl transition-all shadow-md shadow-[#176b87]/20 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Güncelle
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 font-medium rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all">
                                İptal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
