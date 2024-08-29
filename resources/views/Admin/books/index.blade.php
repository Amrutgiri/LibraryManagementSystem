@extends('Admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('Admin/datatables/datatables.min.css') }}">
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box">
        <div class="row py-3 px-4 d-flex justify-content-end align-items-center">
            <div class="" id="toolbar"></div>
            <div class="dropdown mr-2">
                <button class="btn btn-outline-secondary dropdown-toggle d-flex align-middle" type="button"
                    data-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-search mr-2" style="font-size: 20px;"></i> Search
                </button>
                <div class="dropdown-menu" style="width: 300px;">
                    <form class="px-4 py-3 w-100">
                        <div class="form-group">
                            <select name="department" id="department" class="form-control">
                                <option value="" disabled selected>Department</option>
                                @forelse ($department as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                    <option value="">Not Department Added</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="language" id="language" class="form-control">
                                <option value="" disabled selected>Language</option>
                                @forelse ($language as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                    <option value="">Not language Added</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="gener" id="gener" class="form-control">
                                <option value="" disabled selected>Gener</option>
                                @forelse ($gener as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                    <option value="">Not gener Added</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="rack" id="rack" class="form-control">
                                <option value="" disabled selected>Rack</option>
                                @forelse ($rack as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                                    <option value="">Not rack Added</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group d-flex justify-content-around">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    checked>
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="0">
                                <label class="form-check-label" for="inactive">
                                    In Active
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
            <a href="javascript:void(0)" class="btn btn-success mr-2" data-toggle="modal" data-target="#generateReport">
                <i class="bi bi-file-earmark-post" style="font-size: 20px;"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-outline-secondary mr-2">
                {{ $bookCount }}
            </a>
            {{-- <div class="dropdown mr-2">
                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-printer-fill mr-3" style="font-size: 20px;"></i> Print Barcode
                </button>
                <div class="dropdown-menu">
                    <button class="dropdown-item" type="button">Book Sticker Sheet</button>
                    <button class="dropdown-item" type="button">Book Sticker Liner</button>
                    <button class="dropdown-item" type="button">Book Sticker Uniqe No.</button>
                </div>
            </div> --}}
            <a href="{{ route('admin.book.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle mr-2"></i>Add
                Book</a>
        </div>
        <div class="p-3">
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

    <!-- Modal -->
    <div class="modal fade" id="generateReport" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="generateReportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateReportLabel">Generate Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="report_type" id="report_type" class="form-control">
                        <option value="" disabled selected>Select Report</option>
                        <option value="1">Book Issue Report</option>
                        <option value="2">Book Return Report</option>
                        <option value="3">Over Due Report</option>
                        <option value="4">Book List Report</option>
                        <option value="5">Book Valuation Report</option>
                        <option value="6">Book Barcode Report</option>
                        <option value="7">Book Issue and Return Report</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Generate</button>
                </div>
            </div>
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
