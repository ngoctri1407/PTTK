<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>USHome | Login</title>

    <link href="{{ generateAsset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ generateAsset('public/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ generateAsset('public/css/animate.css') }}" rel="stylesheet">
    <link href="{{ generateAsset('public/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">USHome</h1>

            </div>
            
            <form class="m-t" role="form" action="login" method="post">
                <div>{{isset($error) ? $error :''}}</div>
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot Password?</small></a>
            </form>
			 <p class="m-t"> <small><i class="fa fa-chevron-left"></i> <a href="" style="color: #676a6c">Back to Home Page</a></small> </p>
            <p class="m-t"> <small>Copyright &copy; 2016. All Rights Reserved by Us Home</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ generateAsset('public/js/bootstrap.min.js') }}"></script>

</body>

</html>
