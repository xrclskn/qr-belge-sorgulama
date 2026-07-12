<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('plate', 'like', "%{$search}%")
                  ->orWhere('serial_no', 'like', "%{$search}%");
        }

        $shipments = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('admin.shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('admin.shipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_no' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:1900-01-01|before_or_equal:2100-12-31',
            'plate' => 'required|string|max:255',
            'tonnage' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'exporter_name' => 'nullable|string|max:255',
            'exporter_id' => 'nullable|string|max:255',
            'exporter_address' => 'nullable|string|max:255',
            'exporter_order' => 'nullable|string|max:255',
            'consignee_name' => 'nullable|string|max:255',
            'consignee_address' => 'nullable|string|max:255',
            'consignee_country' => 'nullable|string|max:255',
        ]);

        $data = $request->except('pdf');

        // Otomatik QR Kodu Üret (Benzersiz UUID)
        $uuid = (string) Str::uuid();
        $data['qr_code'] = $uuid;

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('shipments', 'public');
        }

        $shipment = Shipment::create($data);

        // QR Görseli Üret ve Storage'a Kaydet (SVG - imagick gerektirmez)
        $verifyUrl = url('/verify/' . $uuid);
        $qrImagePath = 'qrcodes/' . $uuid . '.svg';

        Storage::disk('public')->makeDirectory('qrcodes');
        $qrImage = QrCode::format('svg')
            ->size(512)
            ->margin(1)
            ->generate($verifyUrl);

        Storage::disk('public')->put($qrImagePath, $qrImage);

        return redirect()->route('admin.shipments.edit', $shipment->id)->with('success', 'Belge başarıyla eklendi ve QR kodu oluşturuldu.');
    }

    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $request->validate([
            'serial_no' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:1900-01-01|before_or_equal:2100-12-31',
            'plate' => 'required|string|max:255',
            'tonnage' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:10240',
            'exporter_name' => 'nullable|string|max:255',
            'exporter_id' => 'nullable|string|max:255',
            'exporter_address' => 'nullable|string|max:255',
            'exporter_order' => 'nullable|string|max:255',
            'consignee_name' => 'nullable|string|max:255',
            'consignee_address' => 'nullable|string|max:255',
            'consignee_country' => 'nullable|string|max:255',
        ]);

        $data = $request->except('pdf');

        // qr_code alanını asla güncelleme!
        unset($data['qr_code']);

        if ($request->hasFile('pdf')) {
            if ($shipment->pdf_path) {
                Storage::disk('public')->delete($shipment->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf')->store('shipments', 'public');
        }

        $shipment->update($data);

        return redirect()->route('admin.shipments.index')->with('success', 'Belge başarıyla güncellendi.');
    }

    public function destroy(Shipment $shipment)
    {
        if ($shipment->pdf_path) {
            Storage::disk('public')->delete($shipment->pdf_path);
        }

        // QR Görseli de sil
        $qrImagePath = 'qrcodes/' . $shipment->qr_code . '.svg';
        if (Storage::disk('public')->exists($qrImagePath)) {
            Storage::disk('public')->delete($qrImagePath);
        }

        $shipment->delete();
        return redirect()->route('admin.shipments.index')->with('success', 'Belge başarıyla silindi.');
    }
}

