<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login | {{ get_system_title() }}</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('backend') }}/assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('backend') }}/assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('backend') }}/assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('backend') }}/assets/css/dashmix.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    {{-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/xwork.min.css"> --}}
    <!-- END Stylesheets -->
</head>

<body>
    <div id="page-container">
        <main id="main-container">
            <div class="row g-0 justify-content-center bg-body-dark">
                <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
                    <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image"
                        style="background-image: url('assets/media/photos/photo20@2x.jpg');">
                        <div class="row g-0">
                            <div class="col-md-6 order-md-1 bg-body-extra-light">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    <div class="mb-2 text-center">
                                        <a class="link-fx fw-bold fs-1" href="index.html">
                                            <span class="text-dark">{{ get_system_setting()->app_title }}</span>
                                        </a>
                                        <p class="text-uppercase fw-bold fs-sm text-muted">Sign In</p>
                                    </div>
                                    <form class="js-validation-signin" action="{{ route('login') }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <input type="text" class="form-control form-control-alt"
                                                id="login-username" name="email" placeholder="Username">
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" class="form-control form-control-alt"
                                                id="login-password" name="password" placeholder="Password">
                                        </div>
                                        <div class="mb-4">
                                            <button type="submit" class="btn w-100 btn-hero btn-primary">
                                                <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 order-md-0 bg-primary-dark-op d-flex align-items-center">
                                <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                    <div class="d-flex">
                                        <a class="flex-shrink-0 img-link me-3" href="javascript:void(0)">
                                            <img class="img-avatar img-avatar-thumb"
                                                src="{{ asset(get_system_setting()->app_image) }}" alt="">
                                        </a>
                                        <div class="flex-grow-1">
                                            <p class="text-white fw-semibold mb-1">
                                                Amazing framework with tons of options! It helped us build our project!
                                            </p>
                                            <a class="text-white-75 fw-semibold" href="javascript:void(0)">Soft Touch
                                                Technology</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <script src="{{ asset('backend') }}/assets/js/dashmix.core.min.js"></script>

    <!--
            Dashmix JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_js/main/app.js
        -->
    <script src="{{ asset('backend') }}/assets/js/dashmix.app.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('backend') }}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('backend') }}/assets/js/pages/op_auth_signin.min.js"></script>
</body>

</html>
