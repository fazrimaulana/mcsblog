@extends('layouts.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-lock" aria-hidden="true"></i> Permission
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        	<!--.CONTENT-NEW-USER-->
        <div class="content-ui-element">

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
                    <h3>Permission</h3>
                </div>
                <div class="panel-body-custom">

                    <button class="btn btn-info btn-sm btn-4" data-toggle="modal" data-target="#modalAddPermission">Add New Permission</button>

                    <br><br>
                    <div class="table-responsive">
                    <table class="table table-consered table-hover table-bordered">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                                <th>Display Name</th>
                    			<th>Description</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($permissions as $permission)
                    			<tr>
                    				<td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_name }}</td>
                    				<td>{{ $permission->description }}</td>
                    			</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                    </div>

                    {{ $permissions->render() }}

                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Add Permission -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalAddPermission" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Permission</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/settings/permission/add') }}" method="post">
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
        <!-- End Modal Add Permission -->

@endsection
