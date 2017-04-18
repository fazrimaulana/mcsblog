@extends('layouts.backend')

@section('css')
    

@endsection

@section('content')
<!-- HEADER-POST -->
    <div class="header-title">
        <h3>
            <i class="fa fa-plus" aria-hidden="true"></i> Change Password User
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

            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        <li><strong>{{ session('status') }}</strong></li>
                </div>
            @endif

        <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Personal Change Password</h3>
                    </div>
                    <div class="panel-body-custom">
                        <form action="{{ url('/dashboard/users/'.$user->id.'/change-password') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <label class="label-control">New Password</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="*Password" aria-describedby="basic-addon1" name="new_password">
                                </div>
                            </div>
                        </div>
                        <br />

                        <label class="label-control">Old Password</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="*Password" aria-describedby="basic-addon1" name="old_password">
                                </div>
                            </div>
                        </div>
                        <br />

                        <button type="submit" class="btn btn-sm btn-4">Change</button>

                        </form>

                    </div>  
                </div>

    </div>
    <!-- /#page-content-wrapper -->

@endsection

@section('javascript')

    
    
@stop