<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cake Shop Admin | Log in</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/square/blue.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
=======
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/flat/blue.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/dist/css/custom.css') }}">
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
        .disabled{color: #c5c5c5!important;}
    </style>
>>>>>>> 972ad4dd6fc87e6182fc0e309cf8c1f9d77835ff
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ URL::to('/admin') }}"><b>Cake Shop</b> <br>Admin</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @include("admin.error1")
                <form class="" role="form" method="POST" action="{{ url('admin/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">

                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/plugins/jQuery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ URL::asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass   : 'iradio_square-blue',
                increaseArea : '20%' // optional
            })
        })
    </script>
</body>
</html>
