<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {

        return view('admin.user.index', [
            'title' => 'Users',
        ]);
    }
    public function list(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'created_at',
            4 => 'status'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $users = User::orderBy($order, $dir);
        $totalData = $users->count();

        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $users = $users->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('id', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $users->count();
        }
        $users = $users->offset($start)
            ->limit($limit)
            ->get();
        $data = array();
        if (!empty($users)) {
            $sr_no = '1';
            foreach ($users as $user) {
                $nestedData['id'] = $user->id;
                $nestedData['srno'] = $sr_no;
                $nestedData['name'] = $user->name ?? 'N/A';
                $nestedData['registered_date'] = $user->created_at->format('d-m-Y H:i:s') ?? 'N/A';
                if (isset($user->profile) && Storage::exists($user->profile)) {
                    $nestedData['profile'] = Storage::url($user->profile);
                } else {
                    $nestedData['profile_picture'] = asset('Admin/vendors/images/person.svg');
                }

                $nestedData['phone'] = $user->phone;
                $nestedData['email'] = $user->email ?? '';
                $nestedData['status'] = $user->status;
                // $nestedData['show_url'] = route('admin.user.show', $user->id);
                // $nestedData['edit_url'] = route('admin.user.edit', $user->id);
                // $nestedData['destroy_url'] = route('admin.user.destroy', $user->id);
                $nestedData['status_change_url'] = route('admin.user.status.change', $user->id);
                $nestedData['actions'] = $user->id;
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

    public function statusChange(Request $request, $id)
    {
        try {
            $user = User::find($id);
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
}
