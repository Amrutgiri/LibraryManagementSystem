@extends('Admin.app')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('Admin/css/select2.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('Admin/datatables/datatables.min.css') }}">
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="p-4">
            <a href="javascript:void(0)" class="btn btn-primary float-right mr-2 book_issue">
                <i class="bi bi-plus-circle mr-2"></i>Book Issue
            </a>

        </div>
        <div class="p-5" id="filter_div" style="display: none">
            <div class="p-3 shadow">
                <form id="book_issue_form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="user_id" id="user_id" class="form-control select2">
                                    <option value="" disabled selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span id="max_days" class="text-success h6"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <span id="max_book_limit" class="text-success h6" data-max-book-limit=""></span>
                                    </div>
                                    <div class="col-md-12">
                                        <span id="flag" class="text-danger h6"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="book_id[]" id="book_id" class="custom-select2 form-control"
                                    multiple="multiple" style="width: 100%">
                                    <option value="" disabled>Select Book</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->name }}</option>
                                    @endforeach
                                </select>
                                <span id="book_error_message" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="issue_date" id="issue_date"
                                    placeholder="Issue Date" value="{{ date('d-m-Y', strtotime(now())) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" name="return_date" id="return_date"
                                    placeholder="Issue Date" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="issue_book">Issue Book</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-5">
            <table class="table hover" id="book_issue_table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Book Name</th>
                        <th>Username</th>
                        <th>Issued Date</th>
                        <th>Return Date</th>
                        <th>Is Returned</th>
                        <th>Is Lost</th>
                        <th>Is Damage</th>
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
    {{-- <script src="{{ asset('Admin/js/select2.min.js') }}"></script> --}}
    <script src="{{ asset('Admin/js/parsley.min.js') }}"></script>
    <script src="{{ asset('Admin/datatables/datatables.min.js') }}"></script>
    <script>
        var listDataUrl = "{{ route('admin.book.issue.list.data') }}";
    </script>
    <script src="{{ asset('Admin/custom_js/book_issued/list.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#book_issue_form").parsley();
            $('.book_issue').on('click', function() {
                $('#filter_div').fadeToggle();
            });

            function formatDate(dateString) {
                var date = new Date(dateString);
                var day = String(date.getDate()).padStart(2, '0');
                var month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                var year = date.getFullYear();

                return `${day}-${month}-${year}`;
            }

            $('#book_issue_form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get form data
                var formData = $(this).serialize(); // Collect all form data

                $.ajax({
                    url: '{{ route('admin.book.issue.store') }}', // Your route to handle the request
                    type: 'POST', // Method type
                    data: formData, // Data to send
                    success: function(response) {
                        // Handle successful response
                        if (response.status == true) {
                            $('#book_issue_table').DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: "<span style='color:black'>" + response.message +
                                    "</span>",
                            })
                            // $('#book_issue_form')[0].reset();
                            $('#filter_div').fadeToggle();
                        } else {
                            $('#book_issue_table').DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'error',
                                title: "<span style='color:black'>" + response.message +
                                    "</span>",
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        alert('Something went wrong. Please try again.');
                    }
                });
            });


            $('#user_id').on('change', function() {
                var user_id = $(this).val();
                $.ajax({
                    url: "{{ route('admin.get_user_info') }}",
                    type: 'POST',
                    data: {
                        user_id: user_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response.data);
                        console.log(response.flag);
                        var formattedDate = formatDate(response.return_date);
                        $("#return_date").val(formattedDate);
                        if (response.flag == 0) {
                            $('#max_days').html('Book Issue Days :' + response.data
                                .max_day_limit);
                            $('#max_book_limit').html('Book Issue Limit :' + response.data
                                .max_book_limit);
                            $('#max_book_limit').attr('data-max-book-limit', response.data
                                .max_book_limit);
                            $('#flag').html('Custom Limit Added');
                        } else {
                            $('#max_days').html('Book Issue Days :' + response.data
                                .max_day_limit);
                            $('#max_book_limit').html('Book Issue Limit :' + response.data
                                .max_book_limit);
                            $('#max_book_limit').attr('data-max-book-limit', response.data
                                .max_book_limit);
                            $('#flag').html('System Default');
                        }
                    }
                });
            });

            $('#book_id').on("change", function(event) {
                event.preventDefault();
                var maxBookLimit = $('#max_book_limit').attr('data-max-book-limit');

                var selectedBooks = $(this).val().length;
                if (selectedBooks > maxBookLimit) {
                    // Show error message

                    $('#book_error_message').text('You cannot select more than ' + maxBookLimit +
                        ' books.');
                    var selectedValues = $(this).val().slice(0, maxBookLimit);
                    $(this).val(selectedValues).trigger('change');
                } else {
                    // Clear error message if within limit
                    $('#book_error_message').text('');
                }
            });
        });
    </script>
@endsection
