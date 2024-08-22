<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin LMS</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('Admin/vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('Admin/vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('Admin/vendors/images/favicon-16x16.png') }}" />


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Admin/vendors/styles/core.css') }}?{{ time() }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Admin/vendors/styles/icon-font.min.css') }}?{{ time() }}" />
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('Admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('Admin/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('Admin/vendors/styles/style.css') }}?{{ time() }}" />
    <link href="{{ asset('Admin/css/loader.css') }}?{{ time() }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Admin/css/responsive.bootstrap.css') }}">
    @yield('css')
</head>

<body>
    <div class="loading" style="display: none" id="loader">Loading&#8230;</div>
    @include('Admin.layouts.header')

    @include('Admin.layouts.sidebar')
    <div class="main-container">

        <div class="xs-pd-20-10 pd-ltr-20">
            @yield('content')

            {{-- @include('Admin.layouts.footer') --}}
        </div>
    </div>

    <script src="{{ asset('Admin/vendors/scripts/core.js') }}?{{ time() }}"></script>
    <script src="{{ asset('Admin/vendors/scripts/script.min.js') }}?{{ time() }}"></script>
    <script src="{{ asset('Admin/vendors/scripts/process.js') }}?{{ time() }}"></script>
    <script src="{{ asset('Admin/vendors/scripts/layout-settings.js') }}?{{ time() }}"></script>
    <script src="{{ asset('Admin/src/plugins/apexcharts/apexcharts.min.js') }}?{{ time() }}"></script>
    {{-- <script src="{{ asset('Admin/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Admin/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Admin/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ asset('Admin/vendors/scripts/dashboard3.js') }}?{{ time() }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Admin/js/dataTables.responsive.js') }}"></script>


    <script>
        const csrfToken = "{{ csrf_token() }}";
        const adminId = "{{ Auth::guard('admin')->id() }}";
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        @foreach (['error', 'warning', 'success', 'info'] as $msg)
            @if (Session::has($msg))
                Toast.fire({
                    icon: '{{ $msg }}',
                    title: "<span style='color:black'>{{ Session::get($msg) }}</span>",
                })
            @endif
        @endforeach
    </script>

    @yield('js')
</body>

</html>
