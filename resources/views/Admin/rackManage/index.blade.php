@extends('Admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('Admin/datatables/datatables.min.css') }}">
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="p-2">
            <a href="javascript:void(0)" class="btn btn-primary float-right add_rack" data-toggle="modal"
                data-target="#staticBackdrop"><i class="bi bi-plus-circle mr-2"></i>Add Rack</a>
        </div>

        <div class="p-5">
            <table class="table hover" id="rack_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Serial No</th>
                        <th>Notes</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Rack</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="rack-form" data-parsley-validate="">
                        @csrf
                        <input type="hidden" name="rack_id" id="rack_id">
                        <div class="form-group">
                            <label for="rack_name">Rack Name</label>
                            <input type="text" class="form-control" name="name" id="rack_name"
                                placeholder="Enter Rack Name" required="" data-parsley-trigger="keyup"
                                data-parsley-minlength="5" data-parsley-maxlength="35" maxlength="35"
                                data-parsley-minlength-message="You need to enter at least a 5 character."
                                data-parsley-validation-threshold="5" data-parsley-ui-enabled="true">
                        </div>
                        <div class="form-group">
                            <label for="rack_serial">Rack Serial No</label>
                            <input type="number" class="form-control" name="serial_no" id="rack_serial"
                                placeholder="Enter Rack Serial No" maxlength="3">
                        </div>
                        <div class="form-group">
                            <label for="rack_notes">Rack Notes</label>
                            <textarea class="form-control" name="notes" id="rack_notes" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_rack">Save</button>
                    <button type="button" class="btn btn-primary" id="update_rack">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('Admin/js/parsley.min.js') }}"></script>

    <script src="{{ asset('Admin/datatables/datatables.min.js') }}"></script>
    <script>
        var rackListUrl = "{{ route('admin.rack.list.data') }}";
        var rackStoreUrl = "{{ route('admin.rack.store') }}";
    </script>
    <script src="{{ asset('Admin/custom_js/rack_manage/list.js') }}"></script>
@endsection
