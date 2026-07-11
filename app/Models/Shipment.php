<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = ['serial_no', 'date', 'plate', 'tonnage', 'qr_code', 'pdf_path'];
}
