@extends('layouts.Backend.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">

@endsection

@section('content')

<div class="header-title">
            <h3>
                <i class="fa fa-thumb-tack" aria-hidden="true"></i> Post
                <a href="{{ url('/dashboard/posts/add') }}" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!--.CONTENT-POST-->
            <div class="content-post">

                <!--.MENU-POST-->
                <div class="menu-post col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-8 col-sm-8 col-xs-7 pull-left">
                        <ul class="nav nav-pills">
                            <li role="presentation" class=" {{ strchr(Route::currentRouteName(), 'posts') === 'posts' ? 'active' : '' }} " ><a href="{{ url('/dashboard/posts') }}">All <span class="badge">{{ $postCount->count() }}</span></a></li>
                            <li role="presentation" class=" {{ strchr(Route::currentRouteName(), 'published') === 'published' ? 'active' : '' }} " ><a href="{{ url('/dashboard/posts/published') }}">Published <span class="badge">{{ $postCount->where('status', 'published')->count() }}</span></a></li>
                            <li role="presentation" class=" {{ strchr(Route::currentRouteName(), 'draft') === 'draft' ? 'active' : '' }} " ><a href="{{ url('/dashboard/posts/draft') }}">Draft <span class="badge">{{ $postCount->where('status', 'draft')->count() }}</span></a></li>
                            <li role="presentation" class=" {{ strchr(Route::currentRouteName(), 'trash') === 'trash' ? 'active' : '' }} " ><a href="{{ url('/dashboard/posts/trash') }}">Trash <span class="badge">{{ $postCount->where('status', 'trash')->count() }}</span></a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4 pull-right">
                        <form action="{{ url('/dashboard/posts/search') }}" method="get">
                            <div class="input-group">
                                <!-- <input type="hidden" name="status" class="form-control" value="{{ Request::segment(3) }}"> -->
                                <input type="text" name="search" class="form-control" placeholder="Search..">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>
                </div><!--END OF MENU-POST-->

                <!--.FILTER-POST-->
                <div class="filter-post col-md-12 col-sm-12">
                    <div class="action col-md-2 col-sm-6">
                        <table>
                            <tr>
                                <td>
                                    @if(Request::segment(3)!="trash")
                                        <button type="button" class="btn btn-default" id="move_trash">Move Trash</button>
                                    @else
                                        <button class="btn btn-md btn-3" id="delete_trash">Delete</button>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div><!--END OF ACTION-->
                    <div class="type col-md-5 col-sm-6">
                        <form action="{{ url('/dashboard/posts/filter') }}" method="get">
                        <table>
                            <tr>
                                <td>
                                    <div class="selected-date">
                                        <select class="selectpicker" name="month">
                                            <option value="">All Dates</option>
                                            <option value="01">January</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div><!--END OF SELECTED-DATE-->
                                </td>
                                <td>
                                    <div class="selected-category">
                                        <select class="selectpicker" name="category">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div><!--END OF SELECTED-CATEGORY-->
                                </td>
                                <td>
                                    <div class="selected-user">
                                        <select class="selectpicker" name="user">
                                            <option value="">All Users</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div><!--END OF SELECTED-CATEGORY-->
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-default">Filter</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div><!--END OF TYPE-->
                </div><!--END OF FILTER-POST-->

                <!--.LIST-POST-->
                <div class="list-post col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                    <table style="width: 100%">
                        <tr id="header-table" class="ganjil">
                            <th id="checkbox">
                                <input type="checkbox" value="" id="check_all" class="all">
                            </th>
                            <th id="title"><p>Title</p></th>
                            <th id="author"><p>Author</p></th>
                            <th id="categories"><p>Categories</p></th>
                            <th id="tags"><p>Tags</p></th>
                            <th id="comment">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                            </th>
                            <th id="date"><p>Date</p></th>
                        </tr>
                        
                        @foreach($posts as $key => $post)

                            <tr class="@if($key%2==0) genap @else ganjil @endif">
                                <td>
                                <form id="action">
                                    <input type="checkbox" name="check_action" value="{{ $post->id }}" class="check">
                                </td>
                                <td>
                                    <h5>{{ $post->title }}</h5>
                                    <a href="{{ url('/dashboard/posts/'.$post->id.'/edit') }}" >Edit</a> |
                                    @if(strchr(Route::currentRouteName(), 'trash') == 'trash')

                                        <a href="javascript:;" style="color: red;" data-id="{{ $post->id }}" class="delete">Delete</a> |    

                                    @else

                                        <a href="{{ url('/dashboard/posts/'.$post->id.'/change/trash') }}" style="color: red;">Trash</a> |

                                    @endif
                                    <a href="{{ url('/dashboard/posts/'.$post->id.'/detail') }}" >Detail</a>
                                </td>
                                <td><p>{{ $post->user->name }}</p></td>
                                <td>
                                    
                                    @foreach($post->categories as $category)
                                        {{ $category->name }},
                                    @endforeach

                                </td>
                                <td>
                                    
                                    @foreach($post->tags as $tag)
                                        {{ $tag->name }},
                                    @endforeach

                                </td>
                                <td><p>{{ $post->comments_count }}</p></td>
                                <td><p>{{ $post->published_at }}</p></td>
                            </tr> 
                            </form>
                        @endforeach 

                        

                    </table>
                    </div>
                </div><!--END OF LIST-POST-->
                {{ $posts->render() }}

            </div><!--END OF CONTENT-POST-->

        </div>
        <!-- /#page-content-wrapper -->

        <!-- Modal Delete Post -->
        <div class="modal fade bs-example-modal-sm" id="modalDeletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Post</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/posts/delete') }}" id="formDeletePost" method="post">
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
            var $form = $('#formDeletePost');

            $form.find('#id').val(id);

            $('#modalDeletePost').modal({
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

        $('#move_trash').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = "{{ url('/dashboard/posts/move') }}";
            var posts = "{{ url('/dashboard/posts') }}";
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
               data:{idpost : arrayId},
               success:function(data){
                  window.location = posts;
               }
            });

        });

        $('#delete_trash').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = "{{ url('/dashboard/posts/delete_trash') }}";
            var posts = "{{ url('/dashboard/posts') }}";
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
               data:{idpost : arrayId},
               success:function(data){
                  window.location = posts;
               }
            });

        });

    </script>

@stop