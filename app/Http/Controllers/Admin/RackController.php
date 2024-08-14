<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\User;
use App\Models\RackManage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RackController extends Controller
{
    public function index()
    {
        return view('Admin.rackManage.index', [
            'title' => 'Book Rack Manage'
        ]);
    }

    public function listData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'serial_no',
            3 => 'notes',
            4 => 'create_at',
            5 => 'status'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $rackManage = RackManage::orderBy($order, $dir);
        $totalData = $rackManage->count();

        $totalFiltered = $totalData;

        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $rackManage = $rackManage->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('note', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%");
            });

            $totalFiltered = $rackManage->count();
        }
        $rackManage = $rackManage->offset($start)
            ->limit($limit)
            ->get();
        $data = array();
        if (!empty($rackManage)) {
            $sr_no = '1';
            foreach ($rackManage as $rack) {
                $nestedData['id'] = $rack->id;
                $nestedData['name'] = $rack->name ?? 'N/A';
                $nestedData['create_at'] = $rack->created_at->format('d-m-Y H:i:s') ?? 'N/A';
                $nestedData['serial_no'] = $rack->serial_no;
                $nestedData['notes'] = $rack->notes ?? '';
                $nestedData['status'] = $rack->status;
                // $nestedData['show_url'] = route('admin.user.show', $user->id);
                // $nestedData['edit_url'] = route('admin.rack.edit', $rack->id);
                // $nestedData['destroy_url'] = route('admin.rack.delete', $rack->id);
                $nestedData['status_change_url'] = route('admin.rack.status.change', $rack->id);
                $nestedData['actions'] = $rack->id;
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
            'serial_no' => 'unique:rack_manages',
        ]);
        $rackManage = new RackManage();
        $rackManage->name = $request->name;
        $rackManage->serial_no = $request->serial_no;
        $rackManage->notes = $request->notes;
        $rackManage->save();
        return response()->json(['success' => true, 'message' => 'Rack Manage Created Successfully.']);
    }
    public function statusChange(Request $request, $id)
    {
        try {
            $user = RackManage::find($id);
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

    public function delete($id, Request $request)
    {
        try {
            $rack = RackManage::find($id);
            if ($rack) {
                $rack->delete();
                return response()->json([
                    'state' => true,
                    'message' => 'Rack Deleted Successfully.',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Rack Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'serial_no' => 'unique:rack_manages',
            ]);
            $rack = RackManage::find($id);
            if ($rack) {
                $rack->name = $request->name;
                $rack->serial_no = $request->serial_no;
                $rack->notes = $request->notes;
                $rack->update();
                return response()->json([
                    'state' => true,
                    'message' => 'Rack Updated Successfully.',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Rack Not Found.',
                ]);
            }

        } catch (Throwable $exception) {

            return response()->json([
                'state' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

}
