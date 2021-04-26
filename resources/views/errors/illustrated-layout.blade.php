<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{asset('assets/css/dashboard.min.css')}}" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }

            .full-height {
                height: 100%;
            }

            .bg-error{
                background:url("{{asset('assets/img/error-bg.svg')}}");
                background-position:center;
                background-size:cover
            }

            .border-3 {
                border-width:3px !important;
            }

            .btn-light{
                color:  #ECB811 !important;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="full-height bg-error d-flex align-items-center justify-content-center">
            <div class="text-center">
                @yield('image')
                
                <h1 class="text-white mb-4 font-weight-bold h3">
                    @yield('message')
                </h1>

                <a href="{{ url()->previous() }}">
                    <button class="btn rounded-pill py-3 px-4 btn-light border-3">
                        {{ __('Kembali ke Beranda') }}
                    </button>
                </a>
            </div>
        </div>
    </body>
</html>
