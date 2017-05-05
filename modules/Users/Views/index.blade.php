@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">

@endsection

@section('content')

<div class="header-title">
            <h3>
                <i class="fa fa-user-o" aria-hidden="true"></i> Users
                <a href="{{ url('/dashboard/users/add') }}" id="new-user"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        <li><strong>{{ session('status') }}</strong></li>
                </div>
            @endif

            <!--.CONTENT-POST-->
            <div class="content-post">

                <!--.MENU-POST-->
                <div class="menu-post col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 pull-left">
                        <ul class="nav nav-pills">

                            @php
                                use App\User;
                            @endphp

                            <li role="presentation" class=" {{ strchr(Route::currentRouteName(), 'users') === 'users' ? 'active' : '' }} " ><a href="{{ url('/dashboard/users') }}">All <span class="badge">{{ $userCount }}</span></a></li>

                            @foreach($roles as $role)

                                <li role="presentation" class=" {{ strchr(Route::currentRouteName(), $role->name) === $role->name ? 'active' : '' }} " ><a href="{{ url('/dashboard/users/'.$role->name)}}"> {{ $role->name }} <span class="badge">
                                
                                    @php
                                        $countRole = User::whereHas('roles', function($query) use ($role){
                                            $query->where('role_id', $role->id);
                                        })->count();
                                    @endphp

                                        {{ $countRole }}

                                </span></a></li>

                            @endforeach                           

                            
                        </ul>
                    </div>
                    
                </div><!--END OF MENU-POST-->


                <!--.FILTER-POST-->
                <div class="filter-post col-md-12 col-sm-12">
                    <div class="action col-md-1 col-sm-6">
                        <table>
                            <tr>
                                <td>
                                    <button class="btn btn-md btn-3" id="delete_checked">Delete</button>
                                </td>
                            </tr>
                        </table>
                    </div><!--END OF ACTION-->
                    <div class="type col-md-5 col-sm-6">
                        <table>
                            <tr>
                                <td>
                                    <div class="selected-date">
                                        <select class="selectpicker" name="role" id="change_to">
                                            <option value="">Change role to</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><!--END OF SELECTED-DATE-->
                                </td>
                                <td>
                                    <button type="button" class="btn btn-default" id="change">Change</button>
                                </td>
                            </tr>
                        </table>
                    </div><!--END OF TYPE-->

                    <div class="search col-md-3 col-sm-3 pull-right">
                                        <form action="{{ url('/dashboard/users/search') }}" method="get">
                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control" placeholder="Search..">
                                                <span class="input-group-btn">
                                                    <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </form>
                    </div>

                </div><!--END OF FILTER-POST-->

                <!--.LIST-POST-->
                <div class="list-post col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                    <table style="width: 100%">
                        <tr id="header-table" class="ganjil">
                            <th id="checkbox">
                                <input type="checkbox" value="" id="check_all" class="all">
                            </th>
                            <th id="author"><p>Name</p></th>
                            <th id="categories"><p>Email</p></th>
                            <th id="tags"><p>Role</p></th>
                            <th id="post"><p>Post</p></th>
                        </tr>
                        
                        @foreach($users as $key => $user)

                            <tr class="@if($key%2==0) genap @else ganjil @endif">
                                <td>
                                <form id="action">
                                    <input type="checkbox" name="check_action" value="{{ $user->id }}" class="check">
                                </td>
                                <td>
                                    <h5>{{ $user->name }}</h5>
                                    <a href="{{ url('/dashboard/users/'.$user->id.'/edit') }}" >Edit</a> 
                                    @if($user->hasRole('root')==false && $user->hasRole('administrator')==false)
                                    | <a href="javascript:;" style="color: red;" data-id="{{ $user->id }}" class="delete">Delete</a> 
                                    @endif
                                    | 
                                    <a href="{{ url('/dashboard/users/'.$user->id.'/change-password') }}" >Change Password</a> 
                                    @if(Auth::user()->hasRole('root') || Auth::user()->hasRole('administrator') ) 
                                        |<a href="{{ url('/dashboard/users/'.$user->id.'/profile') }}" > Detail</a> 
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>

                                    @foreach($user->roles as $userRole)

                                         {{ $userRole->name }}, &nbsp

                                    @endforeach

                                </td>
                                <td>{{ $user->posts_count }}</td>
                            </tr> 
                            </form>
                        @endforeach 

                        

                    </table>

                    {{ $users->render() }}

                    </div>
                </div><!--END OF LIST-POST-->
                

            </div><!--END OF CONTENT-POST-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Delete Post -->
        <div class="modal fade bs-example-modal-sm" id="modalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/users/delete') }}" id="formDeleteUser" method="post">
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

        <!-- End Modal Delete Post -->



@endsection

@section('javascript')

    <script src="{{ url('/backend/assets/iCheck/icheck.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });
        
        $('.delete').on('click', function(){

            var id = $(this).data("id");
            var $form = $('#formDeleteUser');

            $form.find('#id').val(id);

            $('#modalDeleteUser').modal({
                "show" : true,
                "backdrop" : "static"
            });

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

        $('#delete_checked').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = "{{ url('/dashboard/users/delete-users') }}";
            var users = "{{ url('/dashboard/users') }}";
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
               data:{iduser : arrayId},
               success:function(data){
                  window.location = users;
               }
            });

        });

        $('#change').on('click', function(){

            var change_to = $('#change_to').val();
            var users = "{{ url('/dashboard/users') }}";

            /*console.log(change_to);*/

            if (change_to!="") {

                var $form = $('form#action');
                var id = $form.serializeArray();
                var url = "{{ url('/dashboard/users/change-role') }}";
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
                    data:{idusers : arrayId, action: change_to},
                    success:function(data){
                        window.location = users;
                    }
                });
            }
            else{
                window.location = users;
            }


        });

    </script>

@stop