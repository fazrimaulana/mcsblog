@extends('layouts.auth')

@section('content')

    <div class="login container">
        <div class="row vertical-center-row">
            <div class="col-xs-12 col-sm-10 col-md-6 col-center-block">
                <div class="row">
                    <div class="col-sm-4 col-md-3 login-left">
                        <div class="text-center logo">
                            <div class="image">
                                <a href=""><h1>MCS Admin</h1></a>
                            </div>
                            <h6>Welcome to <small>Admin Panel</small></h6>
                            <h6 class="register">Don't have an account?</h6>
                            <a class="btn button-register" href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> Register Now</a>
                        </div>
                    </div><!--LOGIN-LEFT-->
                    <div class="col-sm-8 col-md-9 login-right">
                        <form class="login-form form-horizontal" method="post" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="heading-form text-center">
                                <h3>Login Page</h3>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback form-group-lg">
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                    <i class="fa fa-user fa-lg form-control-feedback"></i>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback form-group-lg">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control pass" id="password" name="password" placeholder="Password..." required>
                                    <i class="fa fa-lock fa-lg form-control-feedback"></i>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-checkbox">
                                <input type="checkbox" class="remember" name="remember" {{ old('remember') ? 'checked' : '' }}> <span>Remember me</span>
                                <!-- <input type="checkbox" class="show-pass" id="show-pass"> <span>Show password</span> -->
                            </div>
                            <button type="submit" class="btn btn-default btn-lg btn-block"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>
                            <div class="col-md-12 col-sm-12 text-center footer-form">
                                <a href="{{ route('password.request') }}">Forget your password?</a>
                                <p><i class="fa fa-copyright"></i> by Aldi | 2017</p>
                            </div>
                        </form><!--END OF LOGIN-FORM-->
                    </div><!--LOGIN-RIGHT-->
                </div>
            </div><!--END OF COL-CENTER-BLOCK-->
        </div><!--END OF VERTICAL-CENTER-ROW-->
    </div>

@endsection
