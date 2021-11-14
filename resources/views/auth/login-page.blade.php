<!doctype html>
<html lang="en">


<!-- Mirrored from preview.pichforest.com/dashonic/layouts/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Sep 2021 15:57:37 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Log In | E-MR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Pichforest" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets')}}/images/logo-solvus-small.jpeg">

    <!-- Bootstrap Css -->
    <link href="{{asset('/assets')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/assets')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        .overlay-body {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .pos-absolute {
            position: absolute;
        }

        .wd-100p {
            width: 100% !important;
        }

        /* .ht-100p {
            height: 100%;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        a-0 {
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
        } */
    }

    </style>
</head>


<body style="overflow: hidden">

    <!-- <body data-layout="horizontal"> -->
    {{-- <video id="headVideo" class="pos-absolute a-0 wd-100p ht-100p object-fit-cover" autoplay="" muted="" loop=""
        __idm_id__="902646785">
        <source src="{{asset('/assets')}}/video/1.mp4" type="video/mp4">
        <source src="/public/videos/video1.ogv" type="video/ogg">
        <source src="/public/videos/video1.webm" type="video/webm">
    </video> --}}
    <div class="authentication-bg bg-wall min-vh-100" style="background-image:url({{asset('assets/images/loginwall.jpg')}}) ;  background-size: cover;
    background-position: center;
    background-repeat: no-repeat;">
        <div class=" "></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-4">

                        <div class="text-center bg-white pd-1 py-5" style="border-radius: 30px;padding: 22px;">
                            <div class="mb-2 mb-md-3">
                                <a href="{{route('dashboard')}}" class="d-block auth-logo" style="padding: 10px 41px">
                                    <img src="{{asset('assets/')}}/images/logo-solvus.jpeg" alt="" width="100%"
                                        class="auth-logo-dark">
                                    <img src="{{asset('assets/')}}/images/logo-solvus.jpeg" alt="" width="100%"
                                        class="auth-logo-light">
                                </a>
                            </div>
                            <div class="mb-4">
                                <h5>Welcome Back !</h5>
                                <p>Sign in to continue to Solvus E-MR</p>
                            </div>
                            <form action="{{ route('login') }}" method="post">
                                @csrf


                                @if(session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                                @endif



                                <div class="form-floating form-floating-custom mb-3">
                                    <input type="text" class="form-control form-control-sm" id="input-username" name="email"
                                        placeholder="Enter User Name">
                                    <label for="input-username">Email/Username</label>
                                    <div class="form-floating-icon">
                                        <i class="uil uil-users-alt"></i>
                                    </div>
                                </div>
                                <div class="form-floating form-floating-custom mb-3">
                                    <input type="password" class="form-control" id="input-password"
                                        placeholder="Enter Password" name="password">
                                    <label for="input-password">Password</label>
                                    <div class="form-floating-icon">
                                        <i class="uil uil-padlock"></i>
                                    </div>
                                </div>

                                <div class="form-check form-check-info font-size-16">
                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                    <label class="form-check-label font-size-14" for="remember-check">
                                        Remember me
                                    </label>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-info w-100" type="submit">Log In</button>
                                </div>
                                {{--
                                    <div class="mt-4">
                                        <a href="auth-resetpassword-basic.html" class="text-muted text-decoration-underline">Forgot your password?</a>
                                    </div> --}}
                            </form><!-- end form -->

                            {{-- <div class="mt-5 text-center text-muted">
                                    <p>Don't have an account ? <a href="auth-signup-basic.html" class="fw-medium text-decoration-underline"> Signup </a></p>
                                </div> --}}
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

                {{-- <div class="row">
                        <div class="col-xl-12">
                            <div class="text-center text-muted p-4">
                                <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script> Dashonic. Crafted with <i class="mdi mdi-heart text-danger"></i> by Pichforest</p>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row --> --}}

            </div>
        </div><!-- end container -->
    </div>
    <!-- end authentication section -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('/assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/assets')}}/libs/metismenujs/metismenujs.min.js"></script>
    <script src="{{asset('/assets')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('/assets')}}/libs/feather-icons/feather.min.js"></script>

</body>

<!-- Mirrored from preview.pichforest.com/dashonic/layouts/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Sep 2021 15:57:37 GMT -->

</html>
