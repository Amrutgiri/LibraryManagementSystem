@extends('Admin.app')

@section('content')
    <div class="title pb-20">
        <h2 class="h3 mb-0">Library Overview</h2>
    </div>

    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">75</div>
                        <div class="font-14 text-secondary weight-500">
                            Book Issued
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy bi bi-book-half"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">60</div>
                        <div class="font-14 text-secondary weight-500">
                            Book Returned
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b">
                            <span class="icon-copy bi bi-journal-check"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $total_users }}+</div>
                        <div class="font-14 text-secondary weight-500">
                            Total Users
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="icon-copy bi bi-people" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $total_books }}</div>
                        <div class="font-14 text-secondary weight-500">Total Books</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06">
                            <i class="icon-copy bi bi-bookshelf" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pb-10">
        <div class="col-md-8 mb-20">
            <div class="card-box height-100-p pd-20">
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                    <div class="h5 mb-md-0">Books Activities</div>
                    <div class="form-group mb-md-0">
                        <select class="form-control form-control-sm selectpicker">
                            <option value="">Last Week</option>
                            <option value="">Last Month</option>
                            <option value="">Last 6 Month</option>
                            <option value="">Last 1 year</option>
                        </select>
                    </div>
                </div>
                <div id="activities-chart"></div>
            </div>
        </div>
        <div class="col-md-4 mb-20">
            <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <div class="icon h1 text-white">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                    </div>
                    <div class="font-14 text-right">
                        <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                        <div class="font-12">Since last month</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">New Users</div>
                        <div class="font-24 weight-500">1865</div>
                    </div>
                    <div class="max-width-150">
                        <div id="appointment-chart"></div>
                    </div>
                </div>
            </div>
            <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <div class="icon h1 text-white">
                        <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    </div>
                    <div class="font-14 text-right">
                        <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                        <div class="font-12">Since last month</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">Deactivate Users</div>
                        <div class="font-24 weight-500">250</div>
                    </div>
                    <div class="max-width-150">
                        <div id="surgery-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-20">
            <div class="card-box height-100-p pd-20 min-height-200px">
                <div class="d-flex justify-content-between pb-10">
                    <div class="h5 mb-0">Top Readers</div>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133"
                            href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>
                </div>
                <div class="user-list">
                    <ul>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="vendors/images/photo1.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Neil Wagner</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="vendors/images/photo2.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Ren Delan</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="vendors/images/photo3.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Garrett Kincy</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center justify-content-between">
                            <div class="name-avatar d-flex align-items-center pr-2">
                                <div class="avatar mr-2 flex-shrink-0">
                                    <img src="vendors/images/photo4.jpg" class="border-radius-100 box-shadow"
                                        width="50" height="50" alt="" />
                                </div>
                                <div class="txt">
                                    <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                        data-color="#265ed7">4.9</span>
                                    <div class="font-14 weight-600">Dr. Callie Reed</div>
                                    <div class="font-12 weight-500" data-color="#b2b1b6">
                                        Pediatrician
                                    </div>
                                </div>
                            </div>
                            <div class="cta flex-shrink-0">
                                <a href="#" class="btn btn-sm btn-outline-primary">Schedule</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-20">
            <div class="card-box height-100-p pd-20 min-height-200px">
                <div class="d-flex justify-content-between">
                    <div class="h5 mb-0">Missing Book</div>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" data-color="#1b3133"
                            href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                        </div>
                    </div>
                </div>

                <div id="diseases-chart"></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-20">
            <div class="card-box height-100-p pd-20 min-height-200px">
                <div class="max-width-300 mx-auto">
                    <img src="vendors/images/upgrade.svg" alt="" />
                </div>
                <div class="text-center">
                    <div class="h5 mb-1">Upgrade to Pro</div>
                    <div class="font-14 weight-500 max-width-200 mx-auto pb-20" data-color="#a6a6a7">
                        You can enjoy all our features by upgrading to pro.
                    </div>
                    <a href="#" class="btn btn-primary btn-lg">Upgrade</a>
                </div>
            </div>
        </div>
    </div>
@endsection
