<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SGHOME | Login</title>

    <link href="{{ generateAsset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ generateAsset('public/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ generateAsset('public/css/animate.css') }}" rel="stylesheet">
    <link href="{{ generateAsset('public/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">SGHOME</h1>

            </div>

            {!! Form::open(array('url' => generateUrl('admin') . '')) !!}
                <div class="form-group">
                   {!! Form::text('username','',array('class' => 'form-control', 'placeholder' => 'Username', 'required')) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password', 'required')) !!}
                </div>
                <p style="color: red; font-weight: bold"><?php if(isset($error)) echo $error ?></p>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot Password?</small></a>
            {!! Form::close() !!}
			 <p class="m-t"> <small><i class="fa fa-chevron-left"></i> <a href="" style="color: #676a6c">Back to Home Page</a></small> </p>
            <p class="m-t"> <small>Copyright &copy; 2016. All Rights Reserved by Saigon Home</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ generateAsset('public/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ generateAsset('public/js/bootstrap.min.js') }}"></script>

</body>

</html>
