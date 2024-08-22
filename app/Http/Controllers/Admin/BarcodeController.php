<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookImage;
use Throwable;
use App\Models\Book;
use App\Models\Barcode;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BarcodeController extends Controller
{
    public function getBarcode($bookId)
    {
        $book = Book::find($bookId);
        return view('Admin.barcode.index', [
            'title' => 'Generate Barcode',
            'book' => $book
        ]);
    }
    public function listData(Request $request, $bookId)
    {
        $columns = [
            0 => 'id',
            1 => 'barcode',
            2 => 'barcode_image',
            3 => 'created_at',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $barcodes = Barcode::where('book_id', $bookId)->orderBy($order, $dir);
        $totalData = $barcodes->count();


        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $barcodes = $barcodes->where(function ($query) use ($search) {
                $query->where('barcode', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $barcodes->count();
        }
        $barcodes = $barcodes->offset($start)
            ->limit($limit)
            ->get();
        $data = array();
        if (!empty($barcodes)) {
            $sr_no = '1';
            foreach ($barcodes as $row) {
                $nestedData['id'] = $row->id;
                $nestedData['barcode'] = $row->barcode ?? 'N/A';
                // $nestedData['barcode_image'] = $row->barcode_image ?? 'N/A';
                $nestedData['created_at'] = $row->created_at->format('d-m-Y H:i:s') ?? 'N/A';

                if (isset($row->barcode_image)) {
                    $nestedData['barcode_image'] = url($row->barcode_image);
                } else {
                    $nestedData['barcode_image'] = 'N/A';
                }
                // $nestedData['show_url'] = route('admin.user.show', $user->id);
                // $nestedData['edit_url'] = route('admin.book.edit', $row->id);
                // $nestedData['barcode_url'] = route('admin.book.barcode.manage', $row->id);
                $nestedData['destroy_url'] = route('admin.barcode.delete', $row->id);
                // $nestedData['status_change_url'] = route('admin.book.status.change', $row->id);
                $nestedData['actions'] = $row->id;
                $data[] = $nestedData;
                $sr_no++;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    public function generateBarcode(Request $request)
    {
        $barcodes = [];
        $barcodeGenerator = new DNS1D();
        $bookId = $request->book_id;
        $number_of_copies = $request->number_of_copies;
        if ($number_of_copies == 0) {
            return response()->json([
                'status' => true,
                'message' => 'Please Add Number of Copies',
                'data' => $barcodes
            ]);
        }

        for ($i = 1; $i <= $number_of_copies; $i++) {
            $rand = rand(1000000000, 9999999999);

            // Generate unique barcode for each copy
            $code = $bookId . str_pad($rand, 3, '0', STR_PAD_LEFT);
            $barcodeImage = $barcodeGenerator->getBarcodePNG($code, 'C128');

            $fileName = $code . '.png';
            $filePath = public_path('barcodes/' . $fileName);

            if (!file_exists(public_path('barcodes'))) {
                mkdir(public_path('barcodes'), 0755, true);
            }


            file_put_contents($filePath, base64_decode($barcodeImage));

            // Save barcode to the database
            $barcode = new Barcode();
            $barcode->book_id = $bookId;
            $barcode->barcode = $code;
            $barcode->barcode_image = 'barcodes/' . $fileName; // Save as base64 string
            $barcode->save();

            $barcodes[] = $barcode;
        }

        return response()->json([
            'status' => true,
            'message' => 'Barcode generated successfully',
            'data' => $barcodes
        ]);

    }
    public function delete($id, Request $request)
    {
        try {
            $Barcode = Barcode::find($id);
            $imagePath = $Barcode->barcode_image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            if ($Barcode) {
                $Barcode->delete();
                return response()->json([
                    'state' => true,
                    'message' => 'Barcode Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Barcode Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function deleteAllBarcode($bookId, Request $request)
    {


        $Barcode = Barcode::where('book_id', $bookId)->pluck('barcode_image')->toArray();
        // dd($Barcode);
        foreach ($Barcode as $imagePath) {
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $Barcodes = Barcode::where('book_id', $bookId)->delete();
        if ($Barcodes) {
            return redirect(route('admin.book.manage'))->with('success', 'Barcode Deleted Successfully');
        } else {
            return redirect(route('admin.book.manage'))->with('error', 'Something Went to Wrong');
        }


    }

}
