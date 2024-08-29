<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookImage;
use Throwable;
use App\Models\Book;
use App\Models\Gener;
use App\Models\Barcode;
use App\Models\Language;
use Milon\Barcode\DNS1D;
use App\Models\Department;
use App\Models\RackManage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookCount = Book::where('status', 1)->where('deleted_at', null)->count();
        $department = Department::where('status', 1)->where('deleted_at', null)->get();
        $language = Language::where('status', 1)->where('deleted_at', null)->get();
        $gener = Gener::where('status', 1)->where('deleted_at', null)->get();
        $rack = RackManage::where('status', 1)->where('deleted_at', null)->get();

        return view('Admin.books.index', [
            'title' => 'Manage Books',
            'bookCount' => $bookCount,
            'department' => $department,
            'language' => $language,
            'gener' => $gener,
            'rack' => $rack,
        ]);
    }
    public function listData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'language',
            3 => 'auther',
            4 => 'publication',
            5 => 'genre',
            6 => 'number_of_copy',
            7 => 'status'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $books = Book::orderBy($order, $dir);
        $totalData = $books->count();


        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $books = $books->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('language', 'LIKE', "%{$search}%")
                    ->orWhere('auther', 'LIKE', "%{$search}%")
                    ->orWhere('publication', 'LIKE', "%{$search}%")
                    ->orWhere('number_of_copy', 'LIKE', "%{$search}%")
                    ->orWhere('genre', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $books->count();
        }
        $books = $books->offset($start)
            ->limit($limit)
            ->get();

        $data = array();
        if (!empty($books)) {
            $sr_no = '1';
            foreach ($books as $row) {
                $nestedData['id'] = $row->id;
                $nestedData['name'] = $row->name ?? 'N/A';
                $nestedData['language'] = $row->lang->name ?? 'N/A';
                $nestedData['auther'] = $row->auther ?? '-';
                $nestedData['publication'] = $row->publication ?? '-';
                $nestedData['genre'] = $row->gen->name ?? '-';
                $nestedData['number_of_copy'] = $row->number_of_copy ?? '0';
                $nestedData['status'] = $row->status;

                $barcode = Barcode::where('book_id', $row->id)->count();
                $nestedData['barcode'] = $barcode;
                // $nestedData['show_url'] = route('admin.user.show', $user->id);
                $nestedData['edit_url'] = route('admin.book.edit', $row->id);
                $nestedData['barcode_url'] = route('admin.book.barcode.manage', $row->id);
                // $nestedData['destroy_url'] = route('admin.row.delete', $row->id);
                $nestedData['status_change_url'] = route('admin.book.status.change', $row->id);
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status', 1)->where('deleted_at', null)->get();
        $departments = Department::where('status', 1)->where('deleted_at', null)->get();
        $racks = RackManage::where('status', 1)->where('deleted_at', null)->get();
        $genres = Gener::where('status', 1)->where('deleted_at', null)->get();
        return view('Admin.books.create', [
            'title' => 'Add Book',
            'languages' => $languages,
            'departments' => $departments,
            'racks' => $racks,
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'number_of_copy' => 'required',
            ]);

            $book = Book::create([
                'name' => $request->name,
                'total_pages' => $request->total_pages,
                'price' => $request->price,
                'language' => $request->language,
                'department' => $request->department,
                'rack' => $request->rack,
                'classification_no' => $request->classification_no,
                'auther' => $request->auther,
                'publication' => $request->publication,
                'publish_date' => date('Y-m-d', strtotime($request->publish_date)),
                'isbn' => $request->isbn,
                'genre' => $request->genre,
                'notes' => $request->notes,
                'number_of_copy' => $request->number_of_copy,
                'status' => 1,
            ]);
            if ($book) {
                $images = [];
                if ($request->hasFile('book_image')) {
                    foreach ($request->file('book_image') as $file) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->move('book_images/', $filename);
                        $images[] = $path;
                        BookImage::create([
                            'book_id' => $book->id,
                            'image' => $filename,
                        ]);
                    }
                }
                //  dd($book);
                $barcodes = [];
                $barcodeGenerator = new DNS1D();
                $bookId = $book->id;
                $number_of_copies = $request->number_of_copy;

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
                }

            } else {
                return redirect(route('admin.book.create'))->with('error', 'Book Not Added');
            }




            return redirect(route('admin.book.manage'))->with('success', 'Book Added Successfully');


        } catch (Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect(route('admin.book.create'));
        }
        // dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $languages = Language::where('status', 1)->where('deleted_at', null)->get();
        $departments = Department::where('status', 1)->where('deleted_at', null)->get();
        $racks = RackManage::where('status', 1)->where('deleted_at', null)->get();
        $genres = Gener::where('status', 1)->where('deleted_at', null)->get();
        $book = Book::findOrFail($id);
        $bookImages = BookImage::where('book_id', $book->id)->get();

        return view('Admin.books.edit', [
            'title' => 'Edit Book',
            'languages' => $languages,
            'departments' => $departments,
            'racks' => $racks,
            'genres' => $genres,
            'book' => $book,
            'bookImages' => $bookImages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required',
                'number_of_copy' => 'required',
            ]);
            Book::where('id', $id)->update([
                'name' => $request->name,
                'total_pages' => $request->total_pages,
                'price' => $request->price,
                'language' => $request->language,
                'department' => $request->department,
                'rack' => $request->rack,
                'classification_no' => $request->classification_no,
                'auther' => $request->auther,
                'publication' => $request->publication,
                'publish_date' => date('Y-m-d', strtotime($request->publish_date)),
                'isbn' => $request->isbn,
                'genre' => $request->genre,
                'notes' => $request->notes,
                'number_of_copy' => $request->number_of_copy,
            ]);

            $images = [];
            if ($request->hasFile('book_image')) {
                foreach ($request->file('book_image') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->move('book_images/', $filename);
                    $images[] = $path;
                    BookImage::create([
                        'book_id' => $id,
                        'image' => $filename,
                    ]);
                }
            }
            return redirect(route('admin.book.manage'))->with('success', 'Book Updated Successfully');

        } catch (Throwable $th) {
            return redirect(route('admin.book.manage'))->with('success', $th->getMessage());
        }
    }

    public function statusChange(Request $request, $id)
    {
        try {
            $user = Book::find($id);
            if ($request->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $user->status = $status;
            $user->save();
            return response()->json([
                'state' => true,
                'message' => 'Status Changes Successfully.',
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id, Request $request)
    {
        try {
            $book = Book::find($id);

            if ($book) {
                $this->barcodeDelete($id);
                $book->delete();
                return response()->json([
                    'state' => true,
                    'message' => 'Book Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Book Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
    public function barcodeDelete($id)
    {
        $Barcodes = Barcode::where('book_id', $id)->get();
        foreach ($Barcodes as $Barcode) {
            if ($Barcode) {
                $imagePath = $Barcode->barcode_image;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $Barcode->delete();
            }
        }
        // $imagePath = $Barcode->barcode_image;
        // if (File::exists($imagePath)) {
        //     File::delete($imagePath);
        // }
        // $Barcode->delete();

    }
    public function deleteImage(Request $request, $id)
    {
        try {
            $book_image = BookImage::find($id);
            $imagePath = $book_image->image;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            if ($book_image) {
                $book_image->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Book Image Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Book Image Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
