@extends('layouts.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Module
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        	<!--.CONTENT-NEW-USER-->
        <div class="content-ui-element">
            <div class="panel-custom">
                <div class="heading-1">
                    <h3>Module</h3>
                </div>
                <div class="panel-body-custom">
                    <div class="table-responsive">
                    <table class="table table-consered table-hover table-bordered">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                    			<th>Description</th>
                    			<th>Author</th>
                    			<th>Status</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($modules as $module)
                    			<tr>
                    				<td>{{ $module->name }}</td>
                    				<td>{{ $module->description }}</td>
                    				<td>{{ $module->author }}</td>
                    				<td>
                    					<div class="btn-group">
  											<a href="{{ url('/dashboard/modules/'.$module->id.'/active') }}" class="btn btn-info btn-sm @if($module->status=="active") disabled @endif " >Active</a>
  											<a href="{{ url('/dashboard/modules/'.$module->id.'/inactive') }}" class="btn btn-danger btn-sm @if($module->status=="inactive") disabled @endif ">Inactive</a>
										</div>
                    				</td>
                    			</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->
@endsection
