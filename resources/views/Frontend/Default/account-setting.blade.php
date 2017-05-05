@extends('layouts.Frontend.Default.app')

@section('content')

    <div class="account-set">  

        <div class="form-account">
            <div class="wr-form-account container">
                <div class="title text-center">
                    <h1>YOUR ACCOUNT</h1>
                </div>
                <div class="body-form">
                    <div class="col-md-3 col-sm-1"></div>
                    <div class="middle col-md-6 col-sm-10">
                        <div class="change-pic text-center">
                            <div class="picture">
                                <img src="{{ url(Auth::user()->usermeta->image) }}">
                            </div>
                            <!-- <button type="button" class="btn btn-default">
                                <p><i class="fa fa-picture-o" aria-hidden="true"></i> SELECT IMAGE</p>
                            </button> -->
                        </div>
                        <div class="form">
                            
                            <form action="{{ url('/dashboard/users/'.Auth::user()->id.'/edit') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <label class="label-control">Name</label>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="*Name" aria-describedby="basic-addon1" name="name" value="{{ Auth::user()->name }}">
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
                                                <input type="text" class="form-control" placeholder="*Display Name" aria-describedby="basic-addon1" name="display_name" value="{{ Auth::user()->usermeta->display_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br />

                                    <div class="control-group" style="display: none;">
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                </span>
                                                <select name="role[]" class="form-control" multiple>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}"

                                                        @foreach(Auth::user()->roles as $roleUser)
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

                                    <label class="label-control">Description</label>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </span>
                                                <textarea class="form-control" name="description" placeholder="Description">{{ Auth::user()->usermeta->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br />

                                    @if(Auth::user()->usermeta->image!=null)
                                        <img src="{{ url(Auth::user()->usermeta->image) }}" class="img-responsive img-thumbnail" style="width: 300px;height: 200px;">
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

                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>

                                </form>

                        </div><!--END OF FORM-->
                    </div>
                    <div class="col-md-3 col-sm-1"></div>
                </div>
            </div>
        </div>
    </div><!--END OF .ACCOUNT-SET-->

@endsection