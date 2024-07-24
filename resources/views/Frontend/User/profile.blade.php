@extends('Frontend.home')

@section('content')
    <div class="content-wrapper" style="margin-top: 100px;">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="user-profile-header-banner">
                            {{-- <img src="Frontend/assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top"> --}}
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-5">
                            <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto">
                                <img src="Frontend/assets/img/avatars/1.png" alt="user image"
                                    class="d-block h-auto ms-0 ms-sm-6 rounded user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-md-center align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2 mt-lg-0">John Doe</h4>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 my-2">
                                            <li class="list-inline-item d-flex gap-2 align-items-center">
                                                <i class='ti ti-palette ti-lg'></i><span class="fw-medium">UX
                                                    Designer</span>
                                            </li>
                                            <li class="list-inline-item d-flex gap-2 align-items-center">
                                                <i class='ti ti-map-pin ti-lg'></i><span class="fw-medium">Vatican
                                                    City</span>
                                            </li>
                                            <li class="list-inline-item d-flex gap-2 align-items-center">
                                                <i class='ti ti-calendar ti-lg'></i><span class="fw-medium"> Joined April
                                                    2021</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-success mb-1">
                                        <i class='ti ti-user-check ti-xs me-2'></i>Active
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->

            <!-- Navbar pills -->
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-align-top">
                        <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-2 gap-lg-0">
                            <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                        class='ti-sm ti ti-user-check me-1_5'></i> Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages-profile-teams.html"><i
                                        class='ti-sm ti ti-users me-1_5'></i> Teams</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages-profile-projects.html"><i
                                        class='ti-sm ti ti-layout-grid me-1_5'></i> Projects</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages-profile-connections.html"><i
                                        class='ti-sm ti ti-link me-1_5'></i> Connections</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Navbar pills -->

            <!-- User Profile Content -->
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5">
                    <!-- About User -->
                    <div class="card mb-6">
                        <div class="card-body">
                            <small class="card-text text-uppercase text-muted small">About</small>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-user ti-lg"></i><span
                                        class="fw-medium mx-2">Full Name:</span> <span>John Doe</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-check ti-lg"></i><span
                                        class="fw-medium mx-2">Status:</span> <span>Active</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-crown ti-lg"></i><span
                                        class="fw-medium mx-2">Role:</span> <span>Developer</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-flag ti-lg"></i><span
                                        class="fw-medium mx-2">Country:</span> <span>USA</span></li>
                                <li class="d-flex align-items-center mb-2"><i class="ti ti-language ti-lg"></i><span
                                        class="fw-medium mx-2">Languages:</span> <span>English</span></li>
                            </ul>
                            <small class="card-text text-uppercase text-muted small">Contacts</small>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-phone-call ti-lg"></i><span
                                        class="fw-medium mx-2">Contact:</span> <span>(123) 456-7890</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-messages ti-lg"></i><span
                                        class="fw-medium mx-2">Skype:</span> <span>john.doe</span></li>
                                <li class="d-flex align-items-center mb-4"><i class="ti ti-mail ti-lg"></i><span
                                        class="fw-medium mx-2">Email:</span> <span>john.doe@example.com</span></li>
                            </ul>
                            <small class="card-text text-uppercase text-muted small">Teams</small>
                            <ul class="list-unstyled mb-0 mt-3 pt-1">
                                <li class="d-flex flex-wrap mb-4"><span class="fw-medium me-2">Backend
                                        Developer</span><span>(126 Members)</span></li>
                                <li class="d-flex flex-wrap">
                                    <span class="fw-medium me-2">React Developer</span><span>(98 Members)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->

                </div>
                <div class="col-xl-8 col-lg-7 col-md-7">
                    <!-- Activity Timeline -->
                    <div class="card card-action mb-6">
                        <div class="card-header align-items-center">
                            <h5 class="card-action-title mb-0"><i class='ti ti-chart-bar ti-lg text-body me-4'></i>Activity
                                Timeline</h5>
                        </div>
                        <div class="card-body pt-3">
                            <ul class="timeline mb-0">
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">12 Invoices have been paid</h6>
                                            <small class="text-muted">12 min ago</small>
                                        </div>
                                        <p class="mb-2">
                                            Invoices have been paid to the company
                                        </p>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="badge bg-lighter rounded d-flex align-items-center">
                                                <img src="Frontend/assets/img/icons/misc/pdf.png" alt="img"
                                                    width="15" class="me-2">
                                                <span class="h6 mb-0 text-body">invoices.pdf</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-success"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">Client Meeting</h6>
                                            <small class="text-muted">45 min ago</small>
                                        </div>
                                        <p class="mb-2">
                                            Project meeting with john @10:15am
                                        </p>
                                        <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                            <div class="d-flex flex-wrap align-items-center mb-50">
                                                <div class="avatar avatar-sm me-3">
                                                    <img src="Frontend/assets/img/avatars/1.png" alt="Avatar"
                                                        class="rounded-circle" />
                                                </div>
                                                <div>
                                                    <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                                    <small>CEO of Pixinvent</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-info"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">Create a new project for client</h6>
                                            <small class="text-muted">2 Day Ago</small>
                                        </div>
                                        <p class="mb-2">
                                            6 team members in a project
                                        </p>
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <ul
                                                        class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="Vinnie Mostowy"
                                                            class="avatar pull-up">
                                                            <img class="rounded-circle"
                                                                src="Frontend/assets/img/avatars/1.png" alt="Avatar" />
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="Allen Rieske"
                                                            class="avatar pull-up">
                                                            <img class="rounded-circle"
                                                                src="Frontend/assets/img/avatars/4.png" alt="Avatar" />
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="Julee Rossignol"
                                                            class="avatar pull-up">
                                                            <img class="rounded-circle"
                                                                src="Frontend/assets/img/avatars/2.png" alt="Avatar" />
                                                        </li>
                                                        <li class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle pull-up text-heading"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="3 more">+3</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
            <!--/ User Profile Content -->

        </div>
        <!-- / Content -->




        <!-- Footer -->



        <div class="content-backdrop fade"></div>
    </div>
@endsection
