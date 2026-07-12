<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.shipments.index') }}" class="text-slate-400 hover:text-[#176b87] transition-colors p-2 rounded-full hover:bg-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
                {{ __('Belge Düzenle') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-6 items-start">

                <!-- Form Paneli -->
                <div class="flex-1 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-8">
                        <form action="{{ route('admin.shipments.update', $shipment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Seri No (Reference Number)</label>
                                    <input type="text" name="serial_no" value="{{ $shipment->serial_no }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tarih</label>
                                    <input type="date" name="date" value="{{ $shipment->date }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Araç Plakası</label>
                                    <input type="text" name="plate" value="{{ $shipment->plate }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tonaj (Ağırlık)</label>
                                    <input type="text" name="tonnage" value="{{ $shipment->tonnage }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200" required>
                                </div>

                                <div class="md:col-span-2 mt-4 pt-4 border-t border-slate-100">
                                    <h3 class="text-lg font-bold text-slate-800 mb-4">Exporter (İhracatçı Bilgileri)</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">Company Name (Firma Adı)</label>
                                            <input type="text" name="exporter_name" value="{{ $shipment->exporter_name }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">Commercial ID (Ticari ID)</label>
                                            <input type="text" name="exporter_id" value="{{ $shipment->exporter_id }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">Address (Adres)</label>
                                            <input type="text" name="exporter_address" value="{{ $shipment->exporter_address }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">By Order (Sipariş Veren)</label>
                                            <input type="text" name="exporter_order" value="{{ $shipment->exporter_order }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2 mt-4 pt-4 border-t border-slate-100">
                                    <h3 class="text-lg font-bold text-slate-800 mb-4">Consignee (Alıcı Bilgileri)</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">Consignee Name (Alıcı Adı)</label>
                                            <input type="text" name="consignee_name" value="{{ $shipment->consignee_name }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">Destination Country (Varış Ülkesi)</label>
                                            <input type="text" name="consignee_country" value="{{ $shipment->consignee_country }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-semibold text-slate-700 mb-2">Address (Adres)</label>
                                            <input type="text" name="consignee_address" value="{{ $shipment->consignee_address }}" class="block w-full px-4 py-3 rounded-xl border-slate-200 bg-slate-50 text-slate-800 focus:border-[#176b87] focus:ring focus:ring-[#176b87]/20 transition-all duration-200">
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-2 mt-4 pt-4 border-t border-slate-100">
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">PDF Belgesi Güncelle (Opsiyonel)</label>
                                    <input type="file" name="pdf" accept=".pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#176b87]/10 file:text-[#176b87] hover:file:bg-[#176b87]/20 transition-all border border-slate-200 rounded-xl bg-slate-50">
                                    @if($shipment->pdf_path)
                                        <div class="mt-3 p-3 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-emerald-800">Mevcut PDF Belgesi Yüklü</p>
                                                    <p class="text-xs text-emerald-600">Değiştirmek isterseniz yukarıdan yeni dosya seçin.</p>
                                                </div>
                                            </div>
                                            <a href="{{ Storage::url($shipment->pdf_path) }}" target="_blank" class="px-3 py-1.5 bg-white border border-emerald-200 text-emerald-700 text-sm font-medium rounded-lg hover:bg-emerald-50 transition-colors inline-flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Görüntüle
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-xs text-slate-400 mt-2 flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Sadece PDF formatında ve maksimum 10MB boyutunda dosya yükleyebilirsiniz.
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-6 border-t border-slate-100">
                                <button type="submit" class="px-6 py-3 bg-[#176b87] hover:bg-[#125368] text-white font-medium rounded-xl transition-all shadow-md shadow-[#176b87]/20 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    Güncelle
                                </button>
                                <a href="{{ route('admin.shipments.index') }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-600 font-medium rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all">
                                    İptal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- QR Kod Paneli -->
                <div class="w-72 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex-shrink-0">
                    <div class="p-6 flex flex-col items-center gap-5">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-700 text-center mb-1">Karekod (QR Code)</h3>
                            <p class="text-xs text-slate-400 text-center">Bu belgeye özel benzersiz kod</p>
                        </div>

                        <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center">
                            <img src="{{ Storage::url('qrcodes/' . $shipment->qr_code . '.svg') }}"
                                 alt="QR Code"
                                 class="w-56 h-56 rounded"
                                 onerror="this.parentElement.innerHTML='<p class=\'text-xs text-slate-400 text-center\'>QR görseli bulunamadı</p>'">
                        </div>

                        <div class="w-full space-y-2">
                            <a href="{{ Storage::url('qrcodes/' . $shipment->qr_code . '.svg') }}"
                                download="qr-{{ $shipment->qr_code }}.svg"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#176b87] hover:bg-[#125368] text-white text-sm font-semibold rounded-xl transition-all shadow-md shadow-[#176b87]/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                SVG İndir
                            </a>
                            <a href="{{ url('/verify/'.$shipment->qr_code) }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                Belgeyi Görüntüle
                            </a>
                        </div>

                        <div class="w-full pt-2 border-t border-slate-100">
                            <p class="text-xs text-slate-400 text-center break-all font-mono">{{ $shipment->qr_code }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

