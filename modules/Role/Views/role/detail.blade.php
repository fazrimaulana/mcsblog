@extends('layouts.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-lock" aria-hidden="true"></i> {{ $role->display_name }}
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
                <!-- <div class="heading-1">
                    <h3>Panel</h3>
                </div> -->
                <div class="panel-body-custom">
                    
                    <div class="btn-group">
                        <button class="btn btn-info btn-sm btn-4" data-toggle="modal" data-target="#modalAddUsers">Add Users</button>
                        <button class="btn btn-success btn-sm btn-5" data-toggle="modal" data-target="#modalAddPermissions">Add Permissions</button>
                    </div>

                    <hr>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#users" role="tab">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#permission" role="tab">Permission</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="users" role="tabpanel">
                            <hr>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role->users as $key => $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td> <a href="javascript:;" class="btn btn-sm btn-danger delete-user" data-user="{{ $user->id }}" >Delete</a> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="permission" role="tabpanel">
                            <hr>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role->perms as $key => $permission)
                                    <tr>
                                        <td>{{ $permission->display_name }}</td>
                                        <td> <a href="javascript:;" class="btn btn-sm btn-danger delete" data-permission="{{ $permission->id }}" >Delete</a> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Add Users -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalAddUsers" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Users</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/settings/role/addUsers') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $role->id }}">
                            <div class="form-group">
                                <label for="Users" class="control-label">Users</label>
                                <select name="users[]" class="form-control" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Modal Add Users -->

        <!-- Modal Add Users -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalAddPermissions" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Permissions</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/settings/role/addPermissions') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $role->id }}">
                            <div class="form-group">
                                <label for="Permissions" class="control-label">Permissions</label>
                                <select name="permissions[]" class="form-control" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Modal Add Users -->

        <div class="modal fade bs-example-modal-sm" id="modalDeleteRolePermission" tabindex="-1" role="dialog" aria-labelledby="deleteRolePermissionModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Permission</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/settings/role/permission/delete') }}" id="formDeleteRolePermission" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" class="form-control" id="id" value="{{ $role->id }}">
                            <input type="hidden" name="id_permission" id="id_permission">
                            <p><b>Yakin ingin menghapus data ini ???</b></p>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-sm" id="modalDeleteRoleUser" tabindex="-1" role="dialog" aria-labelledby="deleteRoleUserModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/settings/role/user/delete') }}" id="formDeleteRoleUser" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" class="form-control" id="id" value="{{ $role->id }}">
                            <input type="hidden" name="id_user" id="id_user">
                            <p><b>Yakin ingin menghapus data ini ???</b></p>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('javascript')
    
    <script type="text/javascript">
        
        $('.delete').on('click', function(){

            var permission = $(this).data("permission");

            var $form = $('#formDeleteRolePermission');

            $form.find('#id_permission').val(permission);

            $('#modalDeleteRolePermission').modal({

                "show" : true,
                "backdrop" : "static"

            });

        });

        $('.delete-user').on('click', function(){

            var user = $(this).data("user");

            var $form = $('#formDeleteRoleUser');

            $form.find('#id_user').val(user);

            $('#modalDeleteRoleUser').modal({

                "show" : true,
                "backdrop" : "static"

            });

        });

    </script>

@stop
