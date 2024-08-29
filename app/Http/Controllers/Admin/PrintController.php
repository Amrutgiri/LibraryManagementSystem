<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barcode;
use App\Models\Book;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function oneBookBarcodePrint($bookId)
    {
        $barcodes = Barcode::where('book_id', $bookId)->get();
        $bookDetails = Book::find($bookId);
        return view('Admin.barcode.bookBarcodePrintTemplate', [
            'title' => $bookDetails->name,
            'barcodes' => $barcodes,
            'bookDetails' => $bookDetails,
        ]);
    }
}
