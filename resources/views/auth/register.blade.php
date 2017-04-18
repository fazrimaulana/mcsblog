@extends('layouts.auth')

@section('content')

    <div class="signup container">
        <div class="row vertical-center-row">
            <div class="col-xs-12 col-sm-10 col-md-6 col-center-block">
                <div class="row">
                    <div class="col-sm-4 col-md-3 signup-left">
                        <div class="text-center logo">
                            <div class="image">
                                <a href=""><h1>MCS Admin</h1></a>
                            </div>
                            <h6>Welcome to <small>Admin Panel</small></h6>
                            <h6 class="login">Already have an account</h6>
                            <a class="btn button-login" href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login Here</a>
                        </div>
                    </div><!--SIGNUP-LEFT-->
                    <div class="col-sm-8 col-md-9 signup-right">
                        <form class="signup-form form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="heading-form text-center">
                                <h3>Create New Account</h3>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback form-group-lg">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name..." value="{{ old('name') }}" required autofocus>
                                    <i class="fa fa-user fa-lg form-control-feedback"></i>

                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback form-group-lg">
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email..." value="{{ old('email') }}" required>
                                    <i class="fa fa-envelope fa-lg form-control-feedback"></i>

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
                            <div class="form-group has-feedback form-group-lg">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control pass" id="password-confirm" name="password_confirmation" placeholder="Re-Password..." required>
                                    <i class="fa fa-lock fa-lg form-control-feedback"></i>
                                </div>
                            </div>
                            <!-- <div class="form-checkbox">
                                <input type="checkbox" class="show-pass" id="show-pass"> <span>Show password</span>
                            </div> -->
                            <button type="submit" class="btn btn-default btn-lg btn-block"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</button>
                            <div class="col-md-12 col-sm-12 text-center footer-form">
                                <p><i class="fa fa-copyright"></i> by Aldi | 2017</p>
                            </div>
                        </form><!--END OF SIGNUP-FORM-->
                    </div><!--SIGNUP-RIGHT-->
                </div>
            </div><!--END OF COL-CENTER-BLOCK-->
        </div><!--END OF VERTICAL-CENTER-ROW-->
    </div>

@endsection
