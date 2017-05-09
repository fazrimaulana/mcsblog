@extends('layouts.Backend.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">

@endsection

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-home" aria-hidden="true"></i> Tags
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
                    <h3>Tags</h3>
                </div>
                <div class="panel-body-custom">
                    <button class="btn btn-info btn-sm btn-4" data-toggle="modal" data-target="#modalAddTag">Add New Tag</button>

                    <button class="btn btn-sm btn-5" id="delete_check">Delete</button>

                    <br><br>
                    <div class="table-responsive">
                    <table class="table table-consered table-hover table-bordered">
                    	<thead>
                    		<tr>
                                <th id="checkbox">
                                    <input type="checkbox" value="" id="check_all" class="all">
                                </th>
                    			<th>Name</th>
                    			<th>Description</th>
                                <th>Slug</th>
                                <th>Count</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($tags as $tag)
                    			<tr>
                                    <td>
                                        <form id="action">
                                            @if($tag->name != "none")
                                            <input type="checkbox" name="check_action" value="{{ $tag->id }}" class="check">
                                            @endif
                                    </td>
                    				<td>{{ $tag->name }}</td>
                    				<td>{{ $tag->description }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>{{ $tag->posts_count }}</td>
                    				<td>
                    					<div class="btn-group">
                                            @if($tag->name != "none")
  											<a class="btn btn-sm btn-primary edit" data-id="{{ $tag->id }}">Edit</a>
  											<a class="btn btn-danger btn-sm delete" data-id="{{ $tag->id }}" >Delete</a>
                                            @endif
                                            <a href="{{ url('/dashboard/tags/'.$tag->id.'/detail') }}" class="btn btn-sm btn-4 btn-info">Detail</a>
										</div>
                    				</td>
                    			</tr>
                                </form>
                    		@endforeach
                    	</tbody>
                    </table>

                    {{ $tags->render() }}

                    </div>
                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Add Category -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalAddTag" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Tag</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/tags/add') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
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
        <!-- End Modal Add Category -->

        <!-- Modal Edit Category -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalEditTag" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Tag</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/tags/edit') }}" method="post" id="formEditTag">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
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
        <!-- End Modal Edit Category -->

        <div class="modal fade bs-example-modal-sm" id="modalDeleteTag" tabindex="-1" role="dialog" aria-labelledby="deleteTagModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Tag</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/tags/delete') }}" id="formDeleteTag" method="post">
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

    <script src="{{ url('/backend/assets/iCheck/icheck.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        
        $('.edit').on('click', function(){
            var id = $(this).data("id");
            var url = "{{ url('/dashboard/tags') }}";
            var $form = $("#formEditTag");

            $.get(url+'/'+id+'/getData', function(data){

                $form.find("#id").val(data.id);
                $form.find("#name").val(data.name);
                $form.find("#description").val(data.description);

                $("#modalEditTag").modal({
                    "show"      : true,
                    "backdrop"  : "static"
                });

            });

        });

        $('.delete').on('click', function(){
            var id = $(this).data("id");
            var $form = $("#formDeleteTag");

            $form.find("#id").val(id);

            $("#modalDeleteTag").modal({
                "show"      : true,
                "backdrop"  : "static"
            });

        });

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });

        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = true;
                }}
                console.log(10);
            
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

        $('#delete_check').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = "{{ url('/dashboard/tags/delete_check') }}";
            var tags = "{{ url('/dashboard/tags') }}";
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
               data:{idtag : arrayId},
               success:function(data){
                  window.location = tags;
               }
            });

        });

    </script>

@stop
