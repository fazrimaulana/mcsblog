@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">

@endsection

@section('content')

        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-cog" aria-hidden="true"></i> General
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </div>
        @endif

        	<!--.CONTENT-NEW-USER-->
        <div class="content-ui-element">
            <div class="panel-custom">
                <div class="heading-1">
                    <h3>General</h3>
                </div>
                <div class="panel-body-custom">
                    <div class="container">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="Site Title" class="col-sm-2 col-form-label col-form-label-md">Site Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-md" id="site_title" name="site_title" placeholder="Title situs anda ..." value="{{ Modules\Settings\Models\Setting::getData('site_title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Tagline" class="col-sm-2 col-form-label col-form-label-md">Tagline</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-md" id="tagline" name="tagline" placeholder="Moto situs anda ..." value="{{ Modules\Settings\Models\Setting::getData('tagline') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Site Url" class="col-sm-2 col-form-label col-form-label-md">Site URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-md" id="site_url" name="site_url" placeholder="http://localhost/mcsblog/public" value="{!! url(Modules\Settings\Models\Setting::getData('site_url')) !!}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Home Url" class="col-sm-2 col-form-label col-form-label-md">Home URL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-md" id="home_url" name="home_url" placeholder="http://localhost/mcsblog/public" value="{!! url(Modules\Settings\Models\Setting::getData('home_url')) !!}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email Address" class="col-sm-2 col-form-label col-form-label-md">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-md" id="email_address" name="email_address" placeholder="example@gmail.com" value="{{ Modules\Settings\Models\Setting::getData('email_address') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Membership" class="col-sm-2 col-form-label col-form-label-md">Membership</label>
                                <div class="col-sm-10">
                                    <div class="checkbox">
                                        <input type="checkbox" name="membership" id="membership" @if( Modules\Settings\Models\Setting::getData('membership')=="true" ) checked @endif value="true"> Anyone can register
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Default Role" class="col-sm-2 col-form-label col-form-label-md">New User Default Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="default_role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @if( Modules\Settings\Models\Setting::getData('default_role') == $role->id ) selected @endif >{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

@endsection

@section('javascript')

    <script src="{{ url('/backend/assets/iCheck/icheck.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });

    </script>

@stop
