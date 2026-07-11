<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Belgeler (Shipments)') }}
            </h2>
            <div class="flex items-center gap-4">
                <form action="{{ route('admin.shipments.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Plaka veya Seri No ara..." class="pl-10 pr-4 py-2.5 rounded-xl border-slate-200 bg-white text-sm focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all w-64 shadow-sm text-slate-700">
                    <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    @if(request('search'))
                        <a href="{{ route('admin.shipments.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    @endif
                </form>
                
                <a href="{{ route('admin.shipments.create') }}" class="px-5 py-2.5 bg-[#176b87] hover:bg-[#125368] text-white font-medium rounded-xl transition-all shadow-md shadow-[#176b87]/20 flex items-center gap-2 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Yeni Belge Ekle
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl flex items-center gap-3 animate-fade-in-down">
                    <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                <th class="p-4 pl-6">Seri No</th>
                                <th class="p-4">Plaka</th>
                                <th class="p-4">Tarih</th>
                                <th class="p-4">Tonaj</th>
                                <th class="p-4">Karekod</th>
                                <th class="p-4 pr-6 text-right">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($shipments as $shipment)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="p-4 pl-6 font-medium text-slate-800">{{ $shipment->serial_no }}</td>
                                <td class="p-4 text-slate-600">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-sm font-medium bg-slate-100 text-slate-800 border border-slate-200">
                                        {{ $shipment->plate }}
                                    </span>
                                </td>
                                <td class="p-4 text-slate-600">{{ \Carbon\Carbon::parse($shipment->date)->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-600">{{ $shipment->tonnage }} Kg</td>
                                <td class="p-4">
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ url('/verify/'.$shipment->qr_code) }}" target="_blank" class="inline-flex items-center gap-1 text-[#176b87] hover:text-[#0f4b5f] font-medium transition-colors text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            Belgeyi Gör
                                        </a>
                                        <button
                                            data-qr-download="{{ url('/verify/'.$shipment->qr_code) }}"
                                            data-qr-size="512"
                                            class="inline-flex items-center gap-1 text-purple-600 hover:text-purple-800 font-medium transition-colors text-sm cursor-pointer bg-transparent border-0 p-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                            QR İndir
                                        </button>

                                        @if($shipment->pdf_path)
                                        <a href="{{ Storage::url($shipment->pdf_path) }}" target="_blank" class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-800 font-medium transition-colors text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            PDF İndir
                                        </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 pr-6 text-right space-x-3">
                                    <a href="{{ route('admin.shipments.edit', $shipment->id) }}" class="text-slate-400 hover:text-amber-500 transition-colors inline-flex items-center" title="Düzenle">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.shipments.destroy', $shipment->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors inline-flex items-center" title="Sil" onclick="return confirm('Silmek istediğinize emin misiniz?')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        <p class="text-base font-medium">Henüz kayıtlı belge bulunmuyor</p>
                                        <p class="text-sm mt-1">Hemen yeni bir belge ekleyerek başlayabilirsiniz.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($shipments->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $shipments->links() }}
                </div>
                @endif
            </div>

            @if($shipments->hasPages())
                <div class="mt-6">
                    {{ $shipments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
