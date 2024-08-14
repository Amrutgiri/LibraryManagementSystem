<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('Admin.departments.index', [
            'title' => 'Book Type - Department'
        ]);
    }
    public function listData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'serial_no',
            3 => 'create_at',
            4 => 'status',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $departments = Department::orderBy($order, $dir);
        $totalData = $departments->count();

        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $departments = $departments->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $departments->count();
        }
        $departments = $departments->offset($start)
            ->limit($limit)
            ->get();
        $data = array();
        if (!empty($departments)) {
            $sr_no = '1';
            foreach ($departments as $row) {
                $nestedData['id'] = $row->id;
                $nestedData['name'] = $row->name ?? 'N/A';
                $nestedData['create_at'] = $row->created_at->format('d-m-Y H:i:s') ?? 'N/A';
                $nestedData['serial_no'] = $row->serial_no;
                $nestedData['status'] = $row->status;
                // $nestedData['show_url'] = route('admin.user.show', $user->id);
                // $nestedData['edit_url'] = route('admin.row.edit', $row->id);
                // $nestedData['destroy_url'] = route('admin.row.delete', $row->id);
                $nestedData['status_change_url'] = route('admin.department.status.change', $row->id);
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
            'name' => 'required',
            'serial_no' => 'unique:departments',
        ]);
        $rackManage = new Department();
        $rackManage->name = $request->name;
        $rackManage->serial_no = $request->serial_no;
        $rackManage->save();
        return response()->json(['success' => true, 'message' => 'Department Created Successfully.']);

    }
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'name' => 'required',
                'serial_no' => 'unique:departments,serial_no,' . $id,
            ]);
            $rack = Department::find($id);
            if ($rack) {
                $rack->name = $request->name;
                $rack->serial_no = $request->serial_no;
                $rack->update();
                return response()->json([
                    'state' => true,
                    'message' => 'Department Updated Successfully.',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Department Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $Genre = Department::find($id);
            if ($Genre) {
                $Genre->delete();
                return response()->json([
                    'state' => true,
                    'message' => 'Department Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Department Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function statusChange(Request $request, $id)
    {
        try {
            $user = Department::find($id);
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
