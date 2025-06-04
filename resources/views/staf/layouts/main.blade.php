<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Lintas Internasional Berkarya</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset("assets/img/logo_favicon.png")}}" />

    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />

    <!-- Notiflix CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.8/src/notiflix.min.css">

    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/flatpickr/flatpickr.css" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/form-validation.css" />
    <!-- css table modal -->
    <link rel="stylesheet" href="../../assets/vendor/css/custom-overrides.css" />


    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        @include ("staf.layouts.sidebar")

        <div class="menu-mobile-toggler d-xl-none rounded-1">
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
            <i class="ti tabler-menu icon-base"></i>
            <i class="ti tabler-chevron-right icon-base"></i>
          </a>
        </div>
        <div class="layout-page">


          @include("staf.layouts.navbar")

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                @yield("content")
            </div>

            @include ("staf.layouts.footer")

            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>

      <div class="layout-overlay layout-menu-toggle"></div>
      <div class="drag-target"></div>
    </div>


    <script src="{{asset("assets/vendor/libs/jquery/jquery.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/select2/select2.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/popper/popper.js")}}"></script>
    <script src="{{asset("assets/vendor/js/bootstrap.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/node-waves/node-waves.js")}}"></script>

    <script src="{{asset("assets/vendor/libs/@algolia/autocomplete-js.js")}}"></script>

    <script src="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>

    <script src="{{asset("assets/vendor/libs/hammer/hammer.js")}}"></script>

    <script src="{{asset("assets/vendor/libs/i18n/i18n.js")}}"></script>

    <script src="{{asset("assets/vendor/js/menu.js")}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset("assets/vendor/libs/apex-charts/apexcharts.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/swiper/swiper.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js")}}"></script>

    <!-- Main JS -->

    <script src="{{asset("assets/js/main.js")}}"></script>

    <!-- Page JS -->
    <script src="{{asset("assets/js/dashboards-analytics.js")}}"></script>

    <!-- endbuild -->


    <!-- Flat Picker -->
    <script src="../../assets/vendor/libs/moment/moment.js"></script>
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <!-- Form Validation -->
    <script src="../../assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/auto-focus.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.8/dist/notiflix-aio-3.2.8.min.js"></script>
    <!-- Select 2 -->
    @stack('scripts')

  </body>
</html>
