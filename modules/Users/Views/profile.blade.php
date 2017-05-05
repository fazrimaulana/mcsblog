@extends('layouts.backend')

@section('css')
    

    
@endsection

@section('content')

<!-- HEADER-POST -->
    <div class="header-title">
        <h3>
            <i class="fa fa-user" aria-hidden="true"></i> User Profile
        </h3>
    </div><!--END OF HEADER-POST-->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <!--.CONTENT-NEW-USER-->
        <div class="content-user-profile">

            <div class="user-profile">
                <div class="header-user-profile">
                    <div class="title pull-left">
                        <h3>Personal Information</h3>
                    </div>
                    <div class="edit pull-right">
                        <h3><a href="#" class="fa fa-pencil" aria-hidden="true"></a></h3>
                    </div>
                </div>
                <div class="body-user-profile">
                    <div class="personal-info">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-i-left">
                            @if($user->usermeta->image=="")
                                
                                <div class="image">
                                    <img src="{{ url('/backend/images/profile-pic.jpeg') }}" class="img-responsive img-thumbnail">
                                </div>

                            @else

                                <div class="image">
                                    <img src="{{ url($user->usermeta->image) }}" class="img-responsive img-thumbnail">
                                </div>

                            @endif
                            <div class="status">
                                <!-- <h5>{{ $user->usermeta->description }}</h5> -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-i-right">
                            <table>
                                <tr>
                                    <td><p>Name</p></td>
                                    <td><p>{{ $user->name }}</p></td>
                                </tr>
                                <tr>
                                    <td><p>Email</p></td>
                                    <td><p>{{ $user->email }}</p></td>
                                </tr>
                                <tr>
                                    <td><p>Display Name</p></td>
                                    <td><p>{{ $user->usermeta->display_name }}</p></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <h3>Api Token</h3>
                                        <h4 style="background: white;color: red;">{{ $user->api_token }}</h4>

                                        <form action="{{ url('/dashboard/users/refresh/apitoken') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div><!--END OF PERSONAL-INFO-->
                </div><!--END OF BODY-USER-PROFILE-->
            </div><!--END OF USER-PROFILE-->
        </div>

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

            <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Personal Edit</h3>
                    </div>
                    <div class="panel-body-custom">
                        <form action="{{ url('/dashboard/users/'.$user->id.'/edit') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <label class="label-control">Name</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="*Name" aria-describedby="basic-addon1" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                        <br />

                        <label class="label-control">Display Name</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="*Display Name" aria-describedby="basic-addon1" name="display_name" value="{{ $user->usermeta->display_name }}">
                                </div>
                            </div>
                        </div>
                        <br />

                        <label class="label-control">Role</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                    <select name="role[]" class="form-control" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"

                                                @foreach($user->roles as $roleUser)
                                                    @if($roleUser->id == $role->id)
                                                        selected
                                                    @endif
                                                @endforeach

                                            >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br />

                        <label class="label-control">Description</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </span>
                                    <textarea class="form-control" name="description" placeholder="Description">{{ $user->usermeta->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br />
                        @if($user->usermeta->image!=null)
                            <img src="{{ url($user->usermeta->image) }}" class="img-responsive img-thumbnail" style="width: 300px;height: 200px;">
                        @endif
                        <br /><br />
                        <label class="label-control">Picture</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-image" aria-hidden="true"></i>
                                    </span>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <br />

                        <button type="submit" class="btn btn-sm btn-4">Update</button>

                        </form>

                    </div>  
                </div>

    </div>

@endsection

@section('javascript')

@stop