<!DOCTYPE html>


<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="Frontend/assets/" data-template="vertical-menu-template" data-style="light">


<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/auth-forgot-password-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jul 2024 14:02:00 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Forgot Password Cover - Pages | Vuexy - Bootstrap Admin Template</title>






    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="Frontend/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="Frontend/assets/vendor/fonts/tabler-icons.css"/>
    <link rel="stylesheet" href="Frontend/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="Frontend/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="Frontend/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="Frontend/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="Frontend/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="Frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="Frontend/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
<link rel="stylesheet" href="Frontend/assets/vendor/libs/%40form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="Frontend/assets/vendor/css/pages/page-auth.css">

    <!-- Helpers -->
    <script src="Frontend/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="Frontend/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="Frontend/assets/js/config.js"></script>

  </head>

  <body>




<div class="authentication-wrapper authentication-cover">
  <!-- Logo -->
  <a href="{{route('home')}}" class="app-brand auth-cover-brand">
    <span class="app-brand-logo demo">
<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
  <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
  <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
</svg>
</span>
    <span class="app-brand-text demo text-heading fw-bold">LMS</span>
  </a>
  <!-- /Logo -->
  <div class="authentication-inner row m-0">

    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-8 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="Frontend/assets/img/illustrations/auth-forgot-password-illustration-light.png" alt="auth-forgot-password-cover" class="my-5 auth-illustration d-lg-block d-none" data-app-light-img="illustrations/auth-forgot-password-illustration-light.png" data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.html">

        <img src="Frontend/assets/img/illustrations/bg-shape-image-light.png" alt="auth-forgot-password-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.html">
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Forgot Password -->
    <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
      <div class="w-px-400 mx-auto mt-12 mt-5">
        <h4 class="mb-1">Forgot Password? 🔒</h4>
        <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
        <form id="formAuthentication" class="mb-6" action="https://demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/auth-reset-password-cover.html" method="GET">
          <div class="mb-6">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
          </div>
          <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
        </form>
        <div class="text-center">
          <a href="{{route('login')}}" class="d-flex align-items-center justify-content-center">
            <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
            Back to login
          </a>
        </div>
      </div>
    </div>
    <!-- /Forgot Password -->
  </div>
</div>

<!-- / Content -->






    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="Frontend/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="Frontend/assets/vendor/libs/popper/popper.js"></script>
    <script src="Frontend/assets/vendor/js/bootstrap.js"></script>
      <script src="Frontend/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="Frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="Frontend/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="Frontend/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="Frontend/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="Frontend/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="Frontend/assets/vendor/libs/%40form-validation/popular.js"></script>
<script src="Frontend/assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
<script src="Frontend/assets/vendor/libs/%40form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="Frontend/assets/js/main.js"></script>


    <!-- Page JS -->
    <script src="Frontend/assets/js/pages-auth.js"></script>

  </body>


<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/auth-forgot-password-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jul 2024 14:02:01 GMT -->
</html>

<!-- beautify ignore:end -->
