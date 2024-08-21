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
            <a href="{{ route('admin.book.create') }}" class="btn btn-primary float-right"><i
                    class="bi bi-plus-circle mr-2"></i>Add Book</a>

        </div>
        <div class="p-5">
            <table class="table hover" id="book_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Book Name</th>
                        <th>Language</th>
                        <th>Auther</th>
                        <th>Publication</th>
                        <th>Genre</th>
                        <th>Number Of Copy</th>
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
        var bookListUrl = "{{ route('admin.book.list.data') }}";
        var barcodeGenerateUrl = "{{ route('admin.book.barcode.generate') }}";
    </script>
    <script src="{{ asset('Admin/custom_js/manage_books/book_list.js') }}"></script>
@endsection
