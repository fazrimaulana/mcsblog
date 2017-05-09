@extends('layouts.Backend.backend')

@section('css')
    

@endsection

@section('content')
<!-- HEADER-POST -->
    <div class="header-title">
        <h3>
            <i class="fa fa-edit" aria-hidden="true"></i> Edit User
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

                        <!-- <label class="label-control">Email</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="*Email" aria-describedby="basic-addon1" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <br />

                        <label class="label-control">Password</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="*Password" aria-describedby="basic-addon1" name="password">
                                </div>
                            </div>
                        </div>
                        <br /> -->

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
    <!-- /#page-content-wrapper -->

@endsection

@section('javascript')

    
    
@stop