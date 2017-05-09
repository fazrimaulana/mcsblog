@extends('layouts.Backend.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-lock" aria-hidden="true"></i> Role
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
                    <h3>Role</h3>
                </div>
                <div class="panel-body-custom">
                    <button class="btn btn-info btn-sm btn-4" data-toggle="modal" data-target="#modalAddRole">Add New Role</button>

                    <br><br>
                    <div class="table-responsive">
                    <table class="table table-consered table-hover table-bordered">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                                <th>Display Name</th>
                    			<th>Description</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($roles as $role)
                    			<tr>
                    				<td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                    				<td>{{ $role->description }}</td>
                    				<td>
                    					<div class="btn-group">
                                            @if($role->name!="root" && $role->name!="administrator")
  											<a href="javascript:;" class="btn btn-info btn-sm btn-4 edit" data-id="{{ $role->id }}">Edit</a>
  											<a href="javascript:;" class="btn btn-danger btn-sm btn-6 delete" data-id="{{ $role->id }}" >Delete</a>
                                            @endif
                                            <a href="{{ url('/dashboard/settings/role/'.$role->id.'/detail') }}" class="btn btn-sm btn-success button-4">Detail</a>
										</div>
                    				</td>
                    			</tr>
                    		@endforeach
                    	</tbody>
                    </table>

                    {{ $roles->render() }}

                    </div>
                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Add Role -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalAddRole" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Role</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/settings/role/add') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="Display Name" class="control-label">Display Name</label>
                                <input type="text" class="form-control" id="display_name" name="display_name">
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
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
        <!-- End Modal Add Role -->

        <!-- Modal Edit Role -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalEditRole" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Role</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/settings/role/edit') }}" method="post" id="formEditRole">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="Display Name" class="control-label">Display Name</label>
                                <input type="text" class="form-control" id="display_name" name="display_name">
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Modal Edit Role -->

        <div class="modal fade bs-example-modal-sm" id="modalDeleteRole" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Role</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/settings/role/delete') }}" id="formDeleteRole" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="id" class="form-control" id="id">
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
        
        $('.edit').on('click', function(){
            var id = $(this).data("id");
            var url = "{{ url('/dashboard/settings/role') }}";
            var $form = $("#formEditRole");

            $.get(url+'/'+id+'/getData', function(data){

                $form.find("#id").val(data.id);
                $form.find("#name").val(data.name);
                $form.find("#display_name").val(data.display_name);
                $form.find("#description").val(data.description);

                $("#modalEditRole").modal({
                    "show"      : true,
                    "backdrop"  : "static"
                });

            });

        });

        $('.delete').on('click', function(){
            var id = $(this).data("id");
            var $form = $("#formDeleteRole");

            $form.find("#id").val(id);

            $("#modalDeleteRole").modal({
                "show"      : true,
                "backdrop"  : "static"
            });

        });

    </script>

@stop
