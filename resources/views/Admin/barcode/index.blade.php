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
            <a href="{{ route('admin.book.manage') }}" class="btn btn-danger float-right"><i
                    class="bi bi-arrow-left"></i>Back</a>
            <a href="{{ route('admin.barcode.delete.all', $book->id) }}" class="btn btn-danger float-right mr-2"><i
                    class="bi bi-trash mr-2"></i>Delete All Barcode</a>
            <a href="{{ route('admin.book.barcode.print.all', $book->id) }}" target="_blank"
                class="btn btn-warning float-right mr-2"><i class="bi bi-printer-fill mr-3" style="font-size: 20px;"></i>
                Print Barcode</a>
        </div>
        <div class="p-5">
            <table class="table hover" id="barcode_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Barcode</th>
                        <th>Barcode Image</th>
                        <th>Created At</th>
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
        var bookListUrl = "{{ route('admin.barcode.list.data', $book->id) }}";
    </script>
    <script src="{{ asset('Admin/custom_js/barcode/barcode_list.js') }}"></script>
@endsection
