@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/blue.css') }}">

@endsection

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

                    <a href="javascript:;" class="btn btn-sm btn-info" id="activedModule">Active</a>
                    <a href="javascript:;" class="btn btn-danger btn-sm" id="inactivedModule">Inactive</a>

                    <hr>

                    <div class="table-responsive">
                    <table class="table table-consered table-hover table-bordered">
                    	<thead>
                    		<tr>
                                <th id="checkbox">
                                   <input type="checkbox" value="" id="check_all" class="all">
                                </th>
                    			<th>Name</th>
                    			<th>Description</th>
                    			<th>Author</th>
                    			<th>Status</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($modules as $module)
                    			<tr>
                                    <td>
                                        
                                        <form id="action">
                                            <input type="checkbox" name="check_action" value="{{ $module->id }}" class="check">
                                        </form>

                                    </td>
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

@section('javascript')

    <script src="{{ url('/backend/assets/iCheck/icheck.js') }}" type="text/javascript"></script>   

    <script type="text/javascript">
        
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }}
            
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    console.log(i)
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }

        $(function () {
            var checkAll = $('input.all');
            var checkboxes = $('input.check');

            checkAll.on('ifChecked ifUnchecked', function(event) {        
                if (event.type == 'ifChecked') {
                    checkboxes.iCheck('check');
                } else {
                    checkboxes.iCheck('uncheck');
                }
            });

            checkboxes.on('ifChanged', function(event){
                if(checkboxes.filter(':checked').length == checkboxes.length) {
                        document.getElementById("check_all").checked = true;
                } else {
                    document.getElementById("check_all").checked = false;
                }
                checkAll.iCheck('update');
            });
        });


        $('#activedModule').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = "{{ url('/dashboard/modules/check/change/active') }}";
            var urlModule = "{{ url('/dashboard/modules') }}";
            var arrayId = [];

            $.each(id, function(i, v){
                arrayId.push(v.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:url,
                data:{idModules : arrayId},
                success:function(data){
                    window.location = urlModule;
                }
            });

        });

        $('#inactivedModule').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = "{{ url('/dashboard/modules/check/change/inactive') }}";
            var urlModule = "{{ url('/dashboard/modules') }}";
            var arrayId = [];

            $.each(id, function(i, v){
                arrayId.push(v.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:url,
                data:{idModules : arrayId},
                success:function(data){
                    window.location = urlModule;
                }
            });

        });


    </script> 

@stop

