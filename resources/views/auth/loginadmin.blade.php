<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Halaman Administrator Absensi Indah Motor</title>
  <!-- CSS files -->
  <link href="{{asset('tabler/dist/css/tabler.min.css?1692870487')}}" rel="stylesheet" />
  <link href="{{asset('tabler/dist/css/tabler-flags.min.css?1692870487')}}/" rel="stylesheet" />
  <link href="{{asset('tabler//dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet" />
  <link href="{{asset('tabler/dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet" />
  <link rel="icon" type="image/png" href="{{asset('assets/img/imo.png')}}" sizes="32x32">
  <link href="{{asset('tabler/dist/css/demo.min.css?1692870487')}}" rel="stylesheet" />
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>

<body class="d-flex flex-column" style="background-color: #000000;">
  <script src=" {{asset('tabler/dist/js/demo-theme.min.js?1692870487')}}">
  </script>
  <div class="page page-center">
    <div class="container container-normal py-4">
      <div class="row align-items-center g-4">
        <div class="col-lg">
          <div class="container-tight">
            <div class="card card-md" style="background-color: #F1F1F1;">
              <div class="card-body">
                <h2 class="h2 text-center mb-4">Login Administrator</h2>
                @if(Session::get('warning'))
                <div class="alert alert-warning">
                  <p>{{Session::get('warning')}}</p>
                </div>
                @endif
                <form action="/prosesloginadmin" method="post" autocomplete="off" novalidate>
                  @csrf
                  <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="your@email.com"
                      autocomplete="off">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">
                      Password
                      <span class="form-label-description">
                        <a href="lupapassword">Lupa Password</a>
                      </span>
                    </label>
                    <div class="input-group input-group-flat">
                      <input type="password" name="password" class="form-control" placeholder="Your password"
                        autocomplete="off">
                      <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password"
                          data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path
                              d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                          </svg>
                        </a>
                      </span>
                    </div>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn w-100"
                      style="background-color: #FDB827; color: #F1F1F1;">Login</button>
                  </div>
                </form>
                <div class="text-center text-secondary mt-3">
                  Belum Punya Akun? <a href="/registeradmin" tabindex="-1">Registrasi</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg d-none d-lg-block">
          <img src="{{asset('assets/img/login/logo.png')}}" height="300" class="d-block mx-auto" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- Libs JS -->
  <!-- Tabler Core -->
  <script src="{{asset('tabler/dist/js/tabler.min.js?1692870487')}}" defer></script>
  <script src="{{asset('tabler/dist/js/demo.min.js?1692870487')}}" defer></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var passwordInput = document.querySelector('input[name="password"]');
      var togglePasswordBtn = document.querySelector('.input-group-text a');

      togglePasswordBtn.addEventListener('click', function (e) {
        e.preventDefault();

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
        } else {
          passwordInput.type = 'password';
        }
      });
    });
  </script>
</body>

</html>