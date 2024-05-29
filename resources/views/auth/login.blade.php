<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Login Page | POS Inventory</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/pages/login/login-15883.css?v=7.2.9') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/plugins/global/plugins.bundle5883.css?v=7.2.9') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/assets/css/style.bundle5883.css?v=7.2.9') }}" />
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <div class="d-flex flex-column flex-root">
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{ asset('dist/assets/img/svg/login-visual-1.svg') }})"></div>
            </div>
            
            <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <div class="d-flex flex-column-fluid flex-center">
                    <!--Signin-->
                    <div class="login-form login-signin">
                        <form action="{{ route('login') }}" method="POST" class="form" id="kt_login_signin_form">
                            @csrf
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to Inventory</h3>
                                <span class="text-muted font-weight-bold font-size-h4">New Here? 
                                <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
                            </div>
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                <input type="email" name="email" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" id="email" :value="old('email')" required />
                            </div>
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                <input type="password" name="password" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" id="password" required autocomplete="current-password" />
                            </div>
                            <div class="pb-lg-0 pb-5">
                                <div class="d-flex justify-content-between mt-n5">
                                    <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                                    @if (Route::has('password.request'))
                                        <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--Signup-->
                    <div class="login-form login-signup">
                        <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                                <p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <label class="checkbox mb-0">
                                    <input type="checkbox" name="agree" />
                                    <span></span>
                                    <div class="ml-2">I Agree the 
                                    <a href="#">terms and conditions</a>.</div>
                                </label>
                            </div>
                            <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                                <button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                                <button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                            </div>
                        </form>
                    </div>
                   
                    <!--Forgot Password-->
                    <div class="login-form login-forgot">
                        <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                                <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
                            </div>
                            <div class="form-group d-flex flex-wrap pb-lg-0">
                                <button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                                <button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                        <span class="mr-1">2024©</span>
                        <a href="#" class="text-dark-75 text-hover-primary">Janaina Santos</a>
                    </div>
                    <!-- <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a> -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('dist/assets/plugins/global/plugins.bundle5883.js?v=7.2.9') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/js/scripts.bundle5883.js?v=7.2.9') }}"></script>
    <script type="text/javascript" src="{{ asset('dist/assets/js/pages/custom/login/login-general5883.js?v=7.2.9') }}"></script>
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };
    </script>
</body>
</html>