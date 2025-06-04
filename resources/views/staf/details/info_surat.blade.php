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
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Lintas Internasional Berkarya</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset("assets/img/logo_favicon.png")}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />


    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />

  </head>

  <body>
    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-10">
        <div class="card">
            <h5 class="card-header">Informasi TTD Surat</h5>
            <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                <tbody>
                    <tr>
                    <th>No Surat</th>
                    <td>{{ $surat->no_surat }}</td>
                    </tr>
                    <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                    <th>Tanggal Disetujui</th>
                    <td>-</td>
                    </tr>
                    <tr>
                    <th>Dibuat Oleh</th>
                    <td>{{ $namaStaf }}</td>
                    </tr>
                    <tr>
                    <th>Disetujui Oleh</th>
                    <td>-</td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>




  </body>
</html>
