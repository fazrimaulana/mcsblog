@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">

@endsection

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-home" aria-hidden="true"></i> Categories
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
                    <h3>Categories</h3>
                </div>
                <div class="panel-body-custom">
                    <button class="btn btn-info btn-sm btn-4" data-toggle="modal" data-target="#modalAddCategory">Add New Catgoery</button>

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
                            @php
                                use Modules\Posts\Models\Category;
                            @endphp

                            @foreach($categoriesParent as $key => $category)
                    			<tr>
                                    <td>
                                        <form id="action">
                                            @if($category->name!="none")
                                            <input type="checkbox" name="check_action" value="{{ $category->id }}" class="check">
                                            @endif
                                    </td>
                    				<td>{{ $category->name }}</td>
                    				<td>{{ $category->description }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->posts_count }}</td>
                    				<td>
                    					<div class="btn-group">
  											@if($category->name!="none")
                                            <a class="btn btn-info btn-sm btn-4 edit" data-id="{{ $category->id }}">Edit</a>
  											<a class="btn btn-danger btn-sm btn-6 delete" data-id="{{ $category->id }}" >Delete</a>
                                            @endif
                                            <a href="{{ url('/dashboard/categories/'.$category->id.'/detail') }}" class="btn btn-sm btn-success button-4">Detail</a>
										</div>
                    				</td>
                    			</tr>

                                @php
                                    $categoryChild = Category::where('parent', $category->id)->withCount('posts')->get();
                                @endphp

                                @foreach($categoryChild as $catChild)

                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check_action" value="{{ $catChild->id }}" class="check">
                                        </td>
                                        <td>__ {{ $catChild->name }}</td>
                                        <td>{{ $catChild->description }}</td>
                                        <td>{{ $catChild->slug }}</td>
                                        <td>{{ $catChild->posts_count }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info btn-sm btn-4 edit" data-id="{{ $catChild->id }}">Edit</a>
                                                <a class="btn btn-danger btn-sm btn-6 delete" data-id="{{ $catChild->id }}" >Delete</a>
                                                <a href="{{ url('/dashboard/categories/'.$catChild->id.'/detail') }}" class="btn btn-sm btn-success button-4">Detail</a>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                                </form>
                    		@endforeach
                    	</tbody>
                    </table>

                    {{ $categories->render() }}

                    </div>
                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Add Category -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalAddCategory" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/categories/add') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="Parent" class="control-label">Parent</label>
                                <select name="parent" class="form-control">
                                    <option value="0">None</option>
                                    @foreach($categoriesParent as $categoryParent)
                                        <option value="{{ $categoryParent->id }}">{{ $categoryParent->name }}</option>
                                    @endforeach
                                </select>
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
        <div class="modal fade" tabindex="-1" role="dialog" id="modalEditCategory" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ url('/dashboard/categories/edit') }}" method="post" id="formEditCategory">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="Parent" class="control-label">Parent</label>
                                <select name="parent" class="form-control parent" id="parent">
                                                                       
                                </select>
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

        <div class="modal fade bs-example-modal-sm" id="modalDeleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Category</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/categories/delete') }}" id="formDeleteCategory" method="post">
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
            var url = "{{ url('/dashboard/categories') }}";
            var $form = $("#formEditCategory");

            $.get(url+'/'+id+'/getData', function(data){

                $form.find("#id").val(data.category.id);
                $form.find("#name").val(data.category.name);
                $form.find(".parent").empty();
                $form.find(".parent").append("  <option value='0'>None</option> ");
                $form.find("#description").val(data.category.description);

                $.each(data.parent, function(index, value){
                    $form.find(".parent").append(" <option value='"+ value.id +"'> "+ value.name +" </option>");
                });

                $form.find("#parent").val(data.category.parent);

                $("#modalEditCategory").modal({
                    "show"      : true,
                    "backdrop"  : "static"
                });

            });

        });

        $('.delete').on('click', function(){
            var id = $(this).data("id");
            var $form = $("#formDeleteCategory");

            $form.find("#id").val(id);

            $("#modalDeleteCategory").modal({
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
            var url = "{{ url('/dashboard/categories/delete_check') }}";
            var categories = "{{ url('/dashboard/categories') }}";
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
               data:{idcategory : arrayId},
               success:function(data){
                  window.location = categories;
               }
            });

        });

    </script>

@stop
