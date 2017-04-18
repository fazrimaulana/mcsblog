@extends('layouts.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/jquery-ui-themes-1.12.1/themes/flick/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/tagit/css/jquery.tagit.css') }}">

@endsection

@section('content')
<!-- HEADER-POST -->
    <div class="header-title">
        <h3>
            Edit Page
        </h3>
    </div><!--END OF HEADER-POST-->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <!--.CONTENT-POST-->
        <div class="content-new-post">
        <form action="{{ url('/dashboard/pages/'.$post->id.'/edit') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="text-post col-md-8 col-sm-7">
                <div class="title input-group-lg">
                    <input type="text" class="form-control" name="title" placeholder="Write a title..." aria-label="..." value="{{ $post->title }}">
                    @if($errors->has('title'))
                        <span style="color: red;">{{ $errors->first('title') }}</span>
                    @endif
                </div><!--END OF TITLE-->
                <textarea name="content" class="form-control" id="content">{{ $post->content }}</textarea>
                @if($errors->has('content'))
                    <span style="color: red;">{{ $errors->first('content') }}</span>
                @endif
            </div><!--END OF TEXT-POST-->

            <div class="type-post col-md-4 col-sm-5">
                
                <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Publish</h3>
                    </div>
                    <div class="panel-body-custom">

                        <label class="label-control">Publish At</label>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" id="publish" placeholder="Published At" name="published_at" value="{{ $post->published_at }}">
                                    @if($errors->has('published_at'))
                                        <span style="color: red;">{{ $errors->first('published_at') }}</span>
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <label class="label-control">Status</label>
                            <select class="form-control" name="status">
                                <option value="published" @if($post->status=="published") selected @endif >Published</option>
                                <option value="draft" @if($post->status=="draft") selected @endif >Draft</option>
                                <option value="draft" @if($post->status=="trash") selected @endif >Trash</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label-control">Visibility</label><br />
                            <input type="radio" name="visible" value="public" @if($post->visible=="public") checked @endif > Public
                            <input type="radio" name="visible" value="private" @if($post->visible=="private") checked @endif > Private
                            <br />
                            @if($errors->has('visible'))
                                <span style="color: red;">{{ $errors->first('visible') }}</span>
                            @endif
                            <br />
                            <label class="label-control">Status Comment</label><br />
                            <input type="radio" name="status_comment" value="open" @if($post->status_comment=="open") checked @endif > Open
                            <input type="radio" name="status_comment" value="close" @if($post->status_comment=="close") checked @endif > Close
                            <br />
                            @if($errors->has('status_comment'))
                                <span style="color: red;">{{ $errors->first('status_comment') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-sm btn-4">Update</button>

                    </div>  
                </div>

                <br />

                <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Categories</h3>
                    </div>
                    <div class="panel-body-custom">
                        
                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="All Categories" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All Categories</a></li>
                                <!-- <li role="presentation"><a href="#used" aria-controls="used" role="tab" data-toggle="tab">Most Used</a></li> -->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="all" style="overflow-y: auto; height:150px;">
                                    @foreach($categories as $category)  
                                    <div class="checkbox">                                      
                                            <label>
                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"

                                                    @foreach($post->categories as $postCategory)

                                                        @if($postCategory->id == $category->id)

                                                            checked

                                                        @endif

                                                    @endforeach

                                                > {{ $category->name }}
                                            </label>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- <div role="tabpanel" class="tab-pane" id="used">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="categories[]" value="a"> A
                                        </label>
                                    </div>                                    
                                </div> -->
                            </div>

                        </div>

                        <a href="javascript:;" id="addNewCategory"><i class="fa fa-plus"></i> Add New Category</a>

                        <br /><br />

                        <div id="divFormCategory" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <select name="parent" class="form-control" id="parent">
                                        <option value="0">-- Parent Category --</option>
                                        @foreach($parentCategories as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="button" class="btn btn-4" id="saveCategory">Add New Category</button>

                        </div>

                    </div>  
                </div>

                <br />

                <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Tags and Image</h3>
                    </div>
                    <div class="panel-body-custom">
                        
                        <label class="label-control">Tags</label>
                        <ul id="myTags">
                            @foreach($post->tags as $key => $value)
                                <li>{{ $value->name }}</li>
                            @endforeach
                        </ul>

                        @if($post->image != "")
                            <img src="{{url('/'.$post->image)}}" class="img-responsive">
                            <hr>
                        @endif

                        <label class="label-control">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">

                    </div>  
                </div>
                
            </div><!--END OF TYPE-POST-->

            <div class="clearfix"></div>
        </form>
        </div><!--END OF .CONTENT-NEW-POST-->

    </div>
    <!-- /#page-content-wrapper -->

@endsection

@section('javascript')

    <script type="text/javascript" src="{{ url('/backend/assets/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/backend/assets/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ url('/backend/assets/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('/backend/assets/iCheck/icheck.js') }}" type="text/javascript"></script>
    <script src="{{ url('/backend/assets/jquery-ui-1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ url('/backend/assets/tagit/js/tag-it.js') }}"></script>

    
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });

        $('#publish').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
              },
              singleDatePicker: true,
              singleClasses: "picker_1",
              showDropdowns: true,
              timePicker: true,
              timePickerSeconds: true,
              timePicker24Hour: true,
            }, function(start, end, label) {
              console.log(start.toISOString(), end.toISOString(), label);
        });

        $("#myTags").tagit({
            availableTags:{!! $tags !!},
            showAutocompleteOnFocus:true,
            fieldName:"tags[]",
            allowSpaces:true,
            caseSensitive:true
        });

        $('#addNewCategory').on('click', function(){

            $('#name').val("");
            $('#parent').val("0");
            $('#divFormCategory').toggle();

        });

        $('#saveCategory').on('click', function(){

            var name = $('#name').val();
            var parent = $('#parent').val();
            var url = "{{ url('/dashboard/categories/add') }}";

            var datas = {name:name, parent:parent};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : "post",
                url  : url,
                data : datas,
                success: function(data){
                    console.log('Success : ', data);
                    $('#all').append(" <div class='checkbox'> <label> <input type='checkbox' name='categories[]' value='" + data.id + "'> "+ data.name +" </label> </div> ");

                    $('input').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green',
                        increaseArea: '20%' // optional
                    });

                    $('#addNewCategory').click();

                },
                error: function(data){
                    console.log('Error');
                }
            });

        });


    </script>
    
@stop