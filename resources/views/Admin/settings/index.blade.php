@extends('Admin.app')

@section('css')
@endsection


@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">{{ $title }}</h2>
    </div>

    <div class="card-box mb-30">
        <div class="p-5">

            <div class="row align-items-center">
                <label class="col-lg-3 d-flex justify-content-end h6">Max Day Limit <span class="text-danger">*</span></label>
                <div class="col-lg-7 align-items-center">
                    <div class="form-group">
                        <input type="text" class="form-control" name="max_day_limit" id="name" value="">
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-lg-3 d-flex justify-content-end h6">Send Mail After Return Date Expires</label>
                <div class="col-lg-7 align-items-center">
                    <div class="form-group">
                        <input type="text" class="form-control" name="send_after_mail" id="name" value=""
                            placeholder="Enter Day">
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-lg-3 d-flex justify-content-end h6">Send Mail Before Return Date</label>
                <div class="col-lg-7 align-items-center">
                    <div class="form-group">
                        <input type="text" class="form-control" name="send_before_mail" id="name" value=""
                            placeholder="Enter Day">
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
                        <input type="email" class="form-control" name="form_email" id="name" value=""
                            placeholder="Enter Day">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-warning mr-2">Save</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
