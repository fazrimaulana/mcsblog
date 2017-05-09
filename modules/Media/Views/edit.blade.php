@extends('layouts.Backend.backend')

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/assets/iCheck/skins/square/green.css') }}">

@endsection

@section('content')
<!-- HEADER-POST -->
    <div class="header-title">
        <h3>
            <i class="fa fa-edit" aria-hidden="true"></i> Edit Media
        </h3>
    </div><!--END OF HEADER-POST-->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <!--.CONTENT-POST-->
        <div class="content-new-post">
        <form action="{{ url('/dashboard/media/'.$media->id.'/edit') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="text-post col-md-8 col-sm-7">
                <div class="title input-group-lg">
                    <input type="text" class="form-control" name="title" placeholder="Write a title..." aria-label="..." value="{{ $media->title }}">
                    @if($errors->has('title'))
                        <span style="color: red;">{{ $errors->first('title') }}</span>
                    @endif
                </div><!--END OF TITLE-->

                <img src="{{ url($media->url) }}" alt="{{ $media->alt }}" class="img-responsive img-thumbnail">

                <br /><br />

                <div class="input-group-lg">
                    <label class="label-control">Caption</label>
                    <input type="text" class="form-control" name="caption" placeholder="Caption" aria-label="...">
                    @if($errors->has('caption'))
                        <span style="color: red;">{{ $errors->first('caption') }}</span>
                    @endif
                </div>

                <div class="input-group-lg">
                    <label class="label-control">Alternative Text (Alt)</label>
                    <input type="text" class="form-control" name="alt" placeholder="Alternative Text" aria-label="...">
                    @if($errors->has('alt'))
                        <span style="color: red;">{{ $errors->first('alt') }}</span>
                    @endif
                </div>

                <div class="input-group-lg">
                    <label class="label-control">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                    @if($errors->has('description'))
                        <span style="color: red;">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="input-group-lg">
                    <label class="label-control">Status</label><br />
                    <input type="radio" name="status" value="public" @if($media->status=="public") checked @endif > Public
                    <input type="radio" name="status" value="private" @if($media->status=="private") checked @endif> Private
                    @if($errors->has('status'))
                        <span style="color: red;">{{ $errors->first('status') }}</span>
                    @endif
                </div>

            </div><!--END OF TEXT-POST-->

            <div class="type-post col-md-4 col-sm-5">
                
                <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Publish</h3>
                    </div>
                    <div class="panel-body-custom">

                        <label class="control-label"><span class="fa fa-calendar"></span> Uploaded on : {{ $media->created_at }}</label>

                        <label class="control-label">File URL : </label>
                        <input type="text" disabled class="form-control" value="{{ url($media->url) }}">

                        <label class="control-label">File Name : <br />{{ $media->mediameta->name }}</label>

                        <label class="control-label">File Type : {{ $media->mediameta->type }}</label>

                        <br />

                        <label class="control-label">File Size : {{ $media->mediameta->size }}</label>

                        <br />

                        <label class="control-label">File Dimesion : {{ $media->mediameta->dimension }}</label>

                        <br />

                        <button type="submit" class="btn btn-sm btn-4">Update</button>

                    </div>  
                </div>

                <br />
                
            </div><!--END OF TYPE-POST-->

            <div class="clearfix"></div>
        </form>
        </div><!--END OF .CONTENT-NEW-POST-->

    </div>
    <!-- /#page-content-wrapper -->

@endsection

@section('javascript')

    <script src="{{ url('/backend/assets/iCheck/icheck.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });

    </script>
    
@stop