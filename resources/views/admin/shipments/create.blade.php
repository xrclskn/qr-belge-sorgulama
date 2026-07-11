<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.shipments.index') }}" class="text-slate-400 hover:text-[#176b87] transition-colors p-2 rounded-full hover:bg-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Yeni Belge Ekle') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.shipments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Seri No (Reference Number)</label>
                                <input type="text" name="serial_no" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required placeholder="Örn: 100465">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tarih</label>
                                <input type="date" name="date" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Araç Plakası</label>
                                <input type="text" name="plate" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required placeholder="Örn: TRUCK">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tonaj (Ağırlık)</label>
                                <input type="text" name="tonnage" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required placeholder="Örn: 2113430">
                                <p class="text-xs text-slate-400 mt-2">Değeri Kg cinsinden sadece sayı olarak girebilirsiniz.</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">PDF Belgesi (Opsiyonel)</label>
                                <input type="file" name="pdf" accept=".pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#176b87]/10 file:text-[#176b87] hover:file:bg-[#176b87]/20 transition-all border border-slate-200 rounded-xl bg-slate-50">
                                <p class="text-xs text-slate-400 mt-2">Sadece PDF formatında ve maksimum 10MB boyutunda dosya yükleyebilirsiniz.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
                            <button type="submit" class="px-6 py-3 bg-[#176b87] hover:bg-[#125368] text-white font-medium rounded-xl transition-all shadow-md shadow-[#176b87]/20 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Kaydet ve QR Üret
                            </button>
                            <a href="{{ route('admin.shipments.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 font-medium rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all">
                                İptal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
