<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\commanTrait;
use App\Models\Book;
use App\Models\User;
use App\Models\Setting;
use App\Models\BookIssue;
use App\Models\BookLimit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookIssueController extends Controller
{
    use commanTrait;
    public function index()
    {
        $users = User::where('status', 1)->orderBy('id', 'desc')->get();
        $books = Book::where('status', 1)->orderBy('id', 'desc')->get();
        return view('Admin.bookIssue.index', [
            'title' => 'Book Issue',
            'users' => $users,
            'books' => $books,
        ]);
    }
    public function listData(Request $request)
    {

        $columns = [
            0 => 'id',
            1 => 'book_name',
            2 => 'username',
            3 => 'issued_date',
            4 => 'return_date',
            5 => 'is_returned',
            6 => 'is_lost',
            7 => 'is_damage',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $BookIssue = BookIssue::with(['user', 'book'])->orderBy($order, $dir);
        $totalData = $BookIssue->count();

        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $BookIssue = $BookIssue->where(function ($query) use ($search) {
                $query->where('issue_date', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $BookIssue->count();
        }
        $BookIssue = $BookIssue->offset($start)
            ->limit($limit)
            ->get();
        $data = array();
        if (!empty($BookIssue)) {
            $sr_no = '1';
            foreach ($BookIssue as $row) {
                $nestedData['id'] = $row->id;
                $book_ids = explode(',', $row->book_id);
                $bookDataArray = [];
                if ($book_ids) {
                    $bookData = Book::whereIn('id', $book_ids)->pluck("name");
                    if (!empty($bookData)) {
                        $bookDataArray = $bookData->toArray();
                    }
                }
                $nestedData['book_name'] = $bookDataArray ?? 'N/A';
                $nestedData['username'] = $row->user->name ?? 'N/A';
                $nestedData['issue_date'] = $row->issue_date ?? 'N/A';
                $nestedData['return_date'] = $row->return_date ?? 'N/A';
                $nestedData['return_date'] = $row->return_date ?? 'N/A';
                $nestedData['is_returned'] = $row->is_returned;
                $nestedData['is_lost'] = $row->is_lost;
                $nestedData['is_damage'] = $row->is_damage;
                $nestedData['created_at'] = $row->created_at;
                $nestedData['user_id'] = $row->user_id;

                // $nestedData['status'] = $row->status;
                // $nestedData['show_url'] = route('admin.user.show', $user->id);
                // $nestedData['edit_url'] = route('admin.row.edit', $row->id);
                // $nestedData['destroy_url'] = route('admin.row.delete', $row->id);
                //$nestedData['status_change_url'] = route('admin.genre.status.change', $row->id);
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
    public function userInfo(Request $request)
    {
        $bookLimit = BookLimit::where('user_id', $request->user_id)->first();
        $systemLimit = Setting::first();

        if ($bookLimit) {
            $returnDate = $this->getDateAfterDays($bookLimit->max_day_limit);
            return response()->json(['status' => true, 'data' => $bookLimit, 'flag' => '0', 'return_date' => $returnDate]);
        } else {
            $returnDate = $this->getDateAfterDays($systemLimit->max_day_limit);
            return response()->json(['status' => false, 'data' => $systemLimit, 'flag' => '1', 'return_date' => $returnDate]);
        }
    }

    public function store(Request $request)
    {
        try {
            $bookArray = $request->validate([
                'user_id' => 'required|exists:users,id',
                'book_id' => 'required|array',
                'issue_date' => 'required|date',
                'return_date' => 'required|date',
            ]);
            $settings = Setting::first();

            $bookArray['book_id'] = implode(',', $bookArray['book_id']);
            $bookArray['issue_date'] = date('Y-m-d', strtotime($bookArray['issue_date']));
            $bookArray['return_date'] = date('Y-m-d', strtotime($bookArray['return_date']));
            $bookArray['fine_amount'] = $settings->fine_amount;

            // dd($bookArray);
            $bookIssued = BookIssue::create($bookArray);
            if ($bookIssued) {
                return response()->json(['status' => true, 'message' => 'Book Issue Successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Something Went Wrong']);
            }
        } catch (Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }

    }

}
