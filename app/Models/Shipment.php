<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'serial_no',
        'date',
        'plate',
        'tonnage',
        'qr_code',
        'pdf_path',
        'exporter_name',
        'exporter_id',
        'exporter_address',
        'exporter_order',
        'consignee_name',
        'consignee_address',
        'consignee_country',
    ];
}
