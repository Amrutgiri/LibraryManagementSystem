<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode Print : {{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('Admin/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container mt-5 mb-5">
        <button class="btn btn-primary" type="button" onclick="this.style.display='none';window.print()">Print this
            page</button>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <h5><span>Book Name : </span> {{ $bookDetails->name }}</h5>
            </div>
            <div class="col-lg-4">
                <h5><span>Book Auther : </span> {{ $bookDetails->auther }}</h5>
            </div>
            <div class="col-lg-4">
                <h5><span>Book Publication : </span> {{ $bookDetails->publication }}</h5>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="tabe table-responsive-lg">
                    <div class="row">
                        @forelse ($barcodes as $row)
                            <div class="col-lg-3 p-3 mt-3 justify-content-center align-items-center">
                                <img src="{{ asset($row->barcode_image) }}" alt="" width="300px"
                                    height="70px">
                                <h5 style="font-size: 20px;letter-spacing: 15px;">{{ $row->barcode }}</h5>
                            </div>
                        @empty
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6>No Barcode Found ! </h6>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('Admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('Admin/js/bootstrap.min.js') }}"></script>
</body>

</html>
