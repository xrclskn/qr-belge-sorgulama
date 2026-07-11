<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($qr_code)
    {
        $shipment = Shipment::where('qr_code', $qr_code)->firstOrFail();
        return view('welcome', compact('shipment'));
    }

    public function manualVerify(Request $request)
    {
        $request->validate([
            'serial_no' => 'required|string',
            'qr_code' => 'required|string',
        ]);

        $shipment = Shipment::where('serial_no', $request->serial_no)
                            ->where('qr_code', $request->qr_code)
                            ->first();

        if (!$shipment) {
            return back()->with('error', 'The provided Reference Number and QR-Code do not match our records.');
        }

        return redirect()->route('verify', ['qr_code' => $shipment->qr_code]);
    }
}
