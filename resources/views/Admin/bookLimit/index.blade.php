@extends('Admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('Admin/datatables/datatables.min.css') }}">
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="p-4">
            <a href="javascript:void(0)" class="btn btn-primary float-right mr-2 add_book_limit_btn" data-toggle="modal"
                data-target="#staticBackdrop">
                <i class="bi bi-plus-circle mr-2"></i>Add Book Limit
            </a>

        </div>
        <div class="p-5">
            <table class="table hover" id="book_limit_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>User Name</th>
                        <th>Max Book Limit</th>
                        <th>Max Day Limit</th>
                        <th>Created At</th>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Add Book Limit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="book-limit-form" data-parsley-validate="">
                        @csrf
                        <input type="hidden" value="" name="book_limit_id" id="book_limit_id">
                        <div class="form-group">
                            <label for="user_id">User Name</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="" disabled selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="max_book_limit">Max Book Limit</label>
                            <input type="number" class="form-control" id="max_book_limit" name="max_book_limit"
                                required="">
                        </div>
                        <div class="form-group">
                            <label for="max_day_limit">Max Day Limit</label>
                            <input type="number" class="form-control" id="max_day_limit" name="max_day_limit"
                                required="">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_book_limit" id="store_book_limit">Save</button>
                    <button type="button" class="btn btn-primary" id="update_book_limit">Update</button>
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
        var listDataUrl = "{{ route('admin.book.limit.list.data') }}";
        var bookLimitStoreUrl = "{{ route('admin.book.limit.store') }}";
    </script>
    <script src="{{ asset('Admin/custom_js/book_limit/list.js') }}"></script>
@endsection
