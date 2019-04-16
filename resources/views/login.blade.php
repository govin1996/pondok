<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('template/img/mli.png') }}">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/vendor/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/css/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/fonts/iconic/css/material-design-iconic-font.min.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/vendor/animate/animate.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/vendor/css-hamburgers/hamburgers.min.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/vendor/animsition/css/animsition.min.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/vendor/select2/select2.min.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/vendor/daterangepicker/daterangepicker.css') }} " rel="stylesheet">
    <!--===============================================================================================-->
    <link href="{{ asset('assets/login/css/util.css') }} " rel="stylesheet">

    <link href="{{ asset('assets/login/css/main.css') }} " rel="stylesheet">

    <!--===============================================================================================-->
</head>
<body>
<form action="{{ url('/loginPost') }}" method="post">
    {{ csrf_field() }}
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form">
                    <span class="login100-form-title p-b-48">
						  <img src="{{ asset('template/img/mli.png') }}" alt=""/>
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Enter User">
                        <input class="input100" type="text" name="user">
                        <span class="focus-input100" data-placeholder="User"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>

<div id="dropDownSelect1"></div>
<script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/vendor/bootstrap/js/popper.js')}}"></script>

<script src="{{ asset('assets/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/vendor/daterangepicker/moment.min.js')}}"></script>

<script src="{{ asset('assets/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/login/js/main.js')}}"></script>

</body>
</html>