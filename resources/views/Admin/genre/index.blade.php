@extends('Admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('Admin/datatables/datatables.min.css') }}">
    <style>
        .custom-tab {
            padding: 15px;

        }

        .custom-tab.active {
            padding: 15px;
            border-bottom: 2px solid;
            color: #0606d4;
        }
    </style>
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="d-flex justify-content-between align-items-center">
            <div class="p-4">
                <a href="javascript:void(0)" class="custom-tab active">Gener</a>
                <a href="javascript:void(0)" class="custom-tab">Department</a>
                <a href="javascript:void(0)" class="custom-tab">Language</a>
            </div>
            <div class="p-4">
                <a href="javascript:void(0)" class="btn btn-primary float-right add_genre" data-toggle="modal"
                    data-target="#staticBackdrop"><i class="bi bi-plus-circle mr-2"></i>Add Genre</a>
            </div>
        </div>
        <div class="p-3">
            <table class="table hover" id="genre_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Serial No.</th>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Genre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="genre-form" data-parsley-validate="">
                        @csrf
                        <input type="hidden" name="genre_id" id="genre_id">
                        <div class="form-group">
                            <label for="rack_name">Genre Name</label>
                            <input type="text" class="form-control" name="name" id="genre_name"
                                placeholder="Enter Rack Name" required="" data-parsley-trigger="keyup" maxlength="35">
                        </div>
                        <div class="form-group">
                            <label for="rack_serial">Genre Serial No</label>
                            <input type="number" class="form-control" name="serial_no" id="genre_serial"
                                placeholder="Enter Rack Serial No" maxlength="3">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_genre">Save</button>
                    <button type="button" class="btn btn-primary" id="update_genre">Update</button>
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
        var genreListUrl = "{{ route('admin.genre.list.data') }}";
        var genreStoreUrl = "{{ route('admin.genre.store') }}";
    </script>
    <script src="{{ asset('Admin/custom_js/book_type/gener_list.js') }}"></script>
@endsection