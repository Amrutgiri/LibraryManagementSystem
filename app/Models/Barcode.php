<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    use HasFactory;

    protected $table = 'barcodes';
    protected $fillable = [
        'barcode',
        'book_id',
        'barcode_image',
    ];
}
