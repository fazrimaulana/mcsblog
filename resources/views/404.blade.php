<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('/backend/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/backend/css/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


</head>

<body>

    <div class="eror container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <br>
                <h4>MCS Blog's Site</h4>
                <p>
                    <img src="{{ url('/backend/images/blog-pic.png') }}" alt="">
                </p>
                <h2>
                    <i class="fa fa-exclamation-triangle" style="color:red"></i>
                    Page not found <small>404 error</small>
                </h2>
                <p>Well, this is embarrassing.

                    <br>
                </p>
                <p><a href="{{ url(Modules\Settings\Models\Setting::getUrlHome('home_url')) }}">Click here</a> to visit our home page</p>
                <p><a href="{{ url('/') }}">MCSBlog.com</a></p>
            </div>

        </div>
    </div>

<!-- jQuery -->
<script src="{{ url('/backend/js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ url('/backend/js/bootstrap.min.js') }}"></script>

</body>
</html>
