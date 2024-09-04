<?php

namespace App\Http\Controllers\Admin;

use App\Models\BookLimit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookLimitController extends Controller
{
    public function index()
    {
        $users = User::where('status', 1)->get();
        // dd($users);
        return view('Admin.bookLimit.index', [
            'title' => 'Book Limit',
            'users' => $users,
        ]);
    }
    public function listData(Request $request)
    {

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'max_day_limit',
            3 => 'max_book_limit',
            4 => 'created_at',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $BookLimit = BookLimit::orderBy($order, $dir);
        $totalData = $BookLimit->count();

        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $BookLimit = $BookLimit->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $BookLimit->count();
        }
        $BookLimit = $BookLimit->offset($start)
            ->limit($limit)
            ->get();
        $data = array();
        if (!empty($BookLimit)) {
            $sr_no = '1';
            foreach ($BookLimit as $row) {
                $nestedData['id'] = $row->id;
                $nestedData['name'] = $row->users->name ?? 'N/A';
                $nestedData['max_day_limit'] = $row->max_day_limit ?? 'N/A';
                $nestedData['max_book_limit'] = $row->max_book_limit;
                $nestedData['created_at'] = $row->created_at->format('d-m-Y');
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

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:book_limits,user_id',
            'max_day_limit' => 'required',
            'max_book_limit' => 'required',
        ]);
        $bookLimit = BookLimit::create([
            'user_id' => $request->user_id,
            'max_day_limit' => $request->max_day_limit,
            'max_book_limit' => $request->max_book_limit,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Book Limit Created Successfully',
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|unique:book_limits,user_id,' . $id,
            'max_day_limit' => 'required',
            'max_book_limit' => 'required',
        ]);
        $bookLimit = BookLimit::find($id);
        $bookLimit->update([
            'user_id' => $request->user_id,
            'max_day_limit' => $request->max_day_limit,
            'max_book_limit' => $request->max_book_limit,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Book Limit Updated Successfully',
        ]);
    }
    public function delete($id)
    {
        $bookLimit = BookLimit::find($id);
        $bookLimit->delete();
        return response()->json([
            'status' => true,
            'message' => 'Book Limit Deleted Successfully',
        ]);

    }
}
