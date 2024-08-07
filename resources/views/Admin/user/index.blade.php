@extends('Admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('Admin/datatables/datatables.min.css') }}">
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="p-5">
            <table class="table hover" id="user_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
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
@endsection

@section('js')
    <script src="{{ asset('Admin/datatables/datatables.min.js') }}"></script>
    <script>
        var userListUrl = "{{ route('admin.users.list') }}";
    </script>
    <script src="{{ asset('Admin/custom_js/user/user_list.js') }}"></script>
@endsection
