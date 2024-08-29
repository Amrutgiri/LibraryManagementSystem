@extends('Admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('Admin/css/select2.min.css') }}">
    <style>
        .preview-container {
            display: flex;
            /*flex-wrap: wrap;*/
            gap: 10px;
        }

        .preview-container img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>
    <div class="card">
        <div class="card-header">

            <a href="{{ route('admin.book.manage') }}" class="btn btn-danger float-right"><i
                    class="bi bi-arrow-left mr-2"></i>Back</a>

        </div>
    </div>
    <div class="card-box mb-30 mt-2">
        <div class="p-4">
            <form action="{{ route('admin.book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Book Name <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control @error('name') @enderror" name="name"
                                    placeholder="Enter Book Name..." id="book_name" value="{{ old('name', $book->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Total Pages</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name="total_pages"
                                    placeholder="Enter Total Pages." id="total_pages"
                                    value="{{ old('total_pages', $book->total_pages) }}">
                            </div>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name="price" placeholder="Enter Price."
                                    id="price" value="{{ old('price', $book->price) }}">
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Language</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="language" id="language">
                                    <option value="">Select Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}"
                                            @if ($language->id == $book->language) selected @endif>{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Department</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="department" id="department">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if ($department->id == $book->department) selected @endif>{{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Rack</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="rack" id="rack">
                                    <option value="">Select Rack</option>
                                    @foreach ($racks as $rack)
                                        <option value="{{ $rack->id }}"
                                            @if ($rack->id == $book->rack) selected @endif>{{ $rack->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Classification No.</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control " name="classification_no"
                                    placeholder="Enter Classification No" id="classification_no"
                                    value="{{ old('classification_no', $book->classification_no) }}">

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Auther Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control " name="auther" placeholder="Enter Auther Name"
                                    id="auther" value="{{ old('auther', $book->auther) }}">
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Publication</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control " name="publication"
                                    placeholder="Enter Publication Name" id="publication"
                                    value="{{ old('publication', $book->publication) }}">
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Publish Date</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control date-picker" name="publish_date"
                                    placeholder="Select Publish Date" id="publish_date"
                                    value="{{ old('publish_date', date('d-m-Y', strtoTime($book->publish_date))) }}">
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">ISBN No.</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="isbn"
                                    placeholder="Enter ISBN Number" id="isbn"
                                    value="{{ old('isbn', $book->isbn) }}">
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Genre</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="genre" id="genre">
                                    <option value="">Select Genre</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            @if ($genre->id == $book->genre) selected @endif>
                                            {{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Number Of Book Copy<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control @error('number_of_copy') @enderror"
                                    name="number_of_copy" placeholder="Enter Number Of Copy" id="number_of_copy"
                                    value="{{ old('number_of_copy', $book->number_of_copy) }}">
                                @error('number_of_copy')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Book Image</label>
                            <div class="col-lg-8">
                                <input type="file" class="form-control" name="book_image[]"
                                    placeholder="Enter Book Image" multiple accept=".jpeg,.jpg,.png,.gif" id="book_image"
                                    value="{{ old('book_image') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-lg-4 font-weight-bold">Notes</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="notes" placeholder="Enter Notes"
                                    id="notes" value="{{ old('notes', $book->notes) }}">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            @foreach ($bookImages as $row)
                                <div class="col-lg-3 mt-5 text-center">
                                    <img src="{{ url('book_images/' . $row->image) }}" alt="Book Image"
                                        class="img-thumbnail w-100 h-100">
                                    <button type="button" class="btn btn-danger btn-sm mt-2"
                                        style="position: absolute;right:0;top:0;" data-id="{{ $row->id }}"
                                        data-url="{{ route('admin.book.delete.image', $row->id) }}"
                                        onclick="deleteImage(this)"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            @endforeach
                            <div class="col-lg-3 mt-5 text-center">
                                <div class="preview-container" id="preview-container">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-warning float-right ml-2 ">Update</button>
                        <a href="{{ route('admin.book.manage') }}" class="btn btn-dark float-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection

    @section('js')
        <script src="{{ asset('Admin/js/select2.min.js') }}"></script>
        <script>
            function deleteImage(e) {
                var id = e.getAttribute('data-id');
                var url = e.getAttribute('data-url');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Toast.fire({
                                icon: 'success',
                                title: "<span style='color:black'>'+response.message+'</span>",
                            })
                            location.reload();
                        } else {
                            alert();
                        }
                    }
                });

            }
            const fileInput = document.getElementById('book_image');
            const previewContainer = document.getElementById('preview-container');

            fileInput.addEventListener('change', () => {
                previewContainer.innerHTML = ''; // Clear previous previews
                const files = fileInput.files;

                for (const file of files) {
                    const fileReader = new FileReader();

                    fileReader.addEventListener('load', (e) => {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        previewContainer.appendChild(imgElement);
                    });

                    fileReader.readAsDataURL(file);
                }
            });
        </script>
    @endsection
