@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/blue.css') }}">

@endsection

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-comment" aria-hidden="true"></i> Comments
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

            <div class="row" style="padding-bottom: 5px;">
                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right: 5px;">
                    <label class="label-control"><a href="{{ url('/dashboard/comments') }}" style=" {{ strchr(Route::currentRouteName(), 'comments') === 'comments' ? 'color: #000000;' : '' }} " >All</a> ( {{$commentCount->count()}} )</label> |

                    <label class="label-control"><a href="{{ url('/dashboard/comments/pending') }}" style=" {{ strchr(Route::currentRouteName(), 'pending') === 'pending' ? 'color: #000000;' : '' }} " >Pending</a> ( {{ $commentCount->where('status', 'pending')->count() }} )</label> |

                    <label class="label-control"><a href="{{ url('/dashboard/comments/approved') }}" style=" {{ strchr(Route::currentRouteName(), 'approved') === 'approved' ? 'color: #000000;' : '' }} " >Approved</a> ( {{ $commentCount->where('status', 'approved')->count() }} )</label> |

                    <label class="label-control"><a href="{{ url('/dashboard/comments/spam') }}" style=" {{ strchr(Route::currentRouteName(), 'spam') === 'spam' ? 'color: #000000;' : '' }} " >Spam</a> ( {{ $commentCount->where('status', 'spam')->count() }} )</label> |

                    <label class="label-control"><a href="{{ url('/dashboard/comments/bin') }}" style=" {{ strchr(Route::currentRouteName(), 'bin') === 'bin' ? 'color: #000000;' : '' }} " >Bin</a> ( {{ $commentCount->where('status', 'bin')->count() }} )</label>

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <form class="form-inline pull-right" method="get" action="{{ url('/dashboard/comments/search') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
                        </div>
                        <button type="submit" class="btn btn-info">Search Comments</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding-right: 5px;">
                    <select class="form-control" id="command">
                        <option value="">--Select--</option>
                        <option value="pending">Unapprove</option>
                        <option value="approved">Approve</option>
                        <option value="spam">Mark As Spam</option>
                        <option value="bin">Move To Bin</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 0px;">
                <a href="javascript:;" class="btn btn-info" id="apply">Apply</a>
                </div>
            </div>

            <br />

            <div class="panel-custom">

                <!-- <div class="heading-1">
                    <h3>Comments</h3>
                </div> -->
                <div class="panel-body-custom">
                    <div class="table-responsive">
                	    <table class="table table-consered table-hover table-bordered">
                    	    <thead>
                        		<tr>
                                    <th id="checkbox">
                                        <input type="checkbox" value="" id="check_all" class="all">
                                    </th>
                    			    <th>Author</th>
                                    <th>Comment</th>
                                    <th>In Response To</th> 
                                    <th>Submitted On</th>
                    		    </tr>
                    	    </thead>
                            <tbody>
                                @foreach($comments as $key => $comment)
                    			<tr>
                                    <td>
                                        <form id="action">
                                            <input type="checkbox" name="check_action" value="{{ $comment->id }}" class="check">
                                        </form>
                                    </td>
                    				<td>{{ $comment->user->name }}</td>
                    				<td>
                                        {{ $comment->content }}
                                        <hr>
                                        @if($comment->status=="pending" || $comment->status=="spam" || $comment->status=="bin" )
                                        
                                            <a href="{{ url('/dashboard/comments/change/'.$comment->id.'/approved') }}" style="color: green;">Approved</a>&nbsp
                                        
                                        @elseif($comment->status=="approved")

                                            <a href="{{ url('/dashboard/comments/change/'.$comment->id.'/pending') }}" style="color: orange;" >Unapprove</a>&nbsp

                                        @endif

                                        |

                                        &nbsp<a href="javascript:;" class="reply" data-id="{{ $comment->id }}">Reply</a>&nbsp

                                        |

                                        &nbsp<a href="javascript:;" class="edit" data-id="{{ $comment->id }}">Edit</a>&nbsp

                                        |

                                        &nbsp<a href="{{ url('/dashboard/comments/change/'.$comment->id.'/spam') }}" style="color: red;">Spam</a>&nbsp

                                        |

                                        &nbsp<a href="{{ url('/dashboard/comments/change/'.$comment->id.'/bin') }}" style="color: red;" >Bin</a>&nbsp

                                    </td>
                                    <td>{{ $comment->post->title }}</td>
                                    <td>{{ $comment->created_at }}</td>
                    			</tr>
                                <tr id="form_reply{{ $comment->id }}" style="display: none;">
                                    <td colspan="5">
                                        <form action="{{ url('/dashboard/comments/reply') }}" method="post" id="formReply_{{ $comment->id }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" id="id" class="form-control">
                                            <label class="control-label">Reply to Comment</label>
                                            <textarea name="content" id="content" class="form-control"></textarea>
                                            <br />
                                            <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                                            <a href="javascript:;" class="btn btn-sm btn-default reply" data-id="{{ $comment->id }}" >Cancel</a>
                                        </form>
                                    </td>
                                </tr>
                                <tr id="form_edit{{ $comment->id }}" style="display: none;">
                                    <td colspan="5">
                                        <form action="{{ url('/dashboard/comments/edit') }}" method="post" id="formEdit_{{ $comment->id }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" id="id" class="form-control">
                                            <label class="control-label">Edit Comment</label>
                                            <textarea name="content" id="content" class="form-control"></textarea>
                                            <br />
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            <a href="javascript:;" class="btn btn-sm btn-default edit" data-id="{{ $comment->id }}" >Cancel</a>
                                        </form>
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

        $('#apply').on('click', function(){

            var $form = $('form#action');
            var id = $form.serializeArray();
            var url = " {{ url('/dashboard/comments/apply') }} ";
            var comments = "{{ url('/dashboard/comments') }}";
            var command = $('#command').val();
            var arrayId = []; 

            $.each(id, function(i, v){
                arrayId.push(v.value);
            });            

            if (command!="" && arrayId!=null) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    url:url,
                    data:{idcomments : arrayId, command : command},
                    success:function(data){
                        window.location = comments;
                    }
                });

            }
            else{
                window.location = comments;
            }
        });

        $('.reply').on('click', function(){

            var id = $(this).data("id");
            var $form = $('#formReply_'+id);

            $form.find('#id').val(id);
            $form.find('#content').val("");

            $('#form_edit'+id).hide();
            $('#form_reply'+id).toggle();

        });

        $('.edit').on('click', function(){

            var id = $(this).data("id");
            var $form = $('#formEdit_'+id);

            $form.find('#id').val(id);
            $form.find('#content').val("");

            $('#form_reply'+id).hide();
            $('#form_edit'+id).toggle();

        });

    </script> 

@stop
