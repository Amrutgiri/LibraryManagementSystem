@extends('Admin.app')

@section('css')
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="p-5">
            <form action="{{ route('admin.settings.update', $settings->id) }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">Max Day Limit <span
                            class="text-danger">*</span></label>
                    <div class="col-lg-7 align-items-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="max_day_limit" id="name"
                                value="{{ old('max_day_limit', $settings->max_day_limit) }}"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="btn btn-secondary" id="basic-addon2">Days</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">Max Book Limit <span
                            class="text-danger">*</span></label>
                    <div class="col-lg-7 align-items-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="max_book_limit" id="max_book_limit"
                                value="{{ old('max_book_limit', $settings->max_book_limit) }}">
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">Send Mail After Return Date Expires</label>
                    <div class="col-lg-7 align-items-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="send_after_mail" id="name"
                                value="{{ old('send_after_mail', $settings->send_after_mail) }}" placeholder="Enter Day">
                            <div class="input-group-append">
                                <span class="btn btn-secondary" id="basic-addon2">Days</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">Send Mail Before Return Date</label>
                    <div class="col-lg-7 align-items-center">
                        <div class="input-group">
                            <input type="text" class="form-control" name="send_before_mail" id="name"
                                value="{{ old('send_before_mail', $settings->send_before_mail) }}" placeholder="Enter Day">
                            <div class="input-group-append">
                                <span class="btn btn-secondary" id="basic-addon2">Days</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-flex align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">Note</label>
                    <div class="col-lg-7 align-items-center">
                        <div class="form-group">
                            <h6>Daily 1 Mail will be Sent until user returns book.</h6>
                        </div>
                    </div>
                </div>

                <div class="row d-flex align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">From Email Id</label>
                    <div class="col-lg-7 align-items-center">
                        <div class="form-group">
                            <input type="email" class="form-control" name="form_email" id="name"
                                value="{{ old('form_email', $settings->form_email) }}" placeholder="Enter Day">
                        </div>
                    </div>
                </div>

                <div class="row d-flex align-items-center">
                    <label class="col-lg-3 d-flex justify-content-end h6">Fine Amount</label>
                    <div class="col-lg-7 align-items-center">
                        <div class="form-group">
                            <input type="number" class="form-control" name="fine_amount" id="fine_amount"
                                value="{{ old('fine_amount', $settings->fine_amount) }}" placeholder="Enter Fine Amount">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-warning mr-2">Save</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
