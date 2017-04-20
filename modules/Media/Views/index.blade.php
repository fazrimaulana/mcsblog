@extends('layouts.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-image" aria-hidden="true"></i> Media <a href="{{ url('/dashboard/media/add') }}" class="btn btn-sm btn-4 btn-info" >Add New</a>
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!--.CONTENT-GALLERY-->
            <div class="content-gallery">

                <div class="gallery">
                    <div class="header-gallery">
                        <!-- <div class="title pull-left">
                            <h3>Photo</h3>
                        </div> --><!--END OF TITLE-->
                    </div><!--END OF HEADER-GALLERY-->
                    <div class="body-gallery">
                        @foreach($medias as $media)
                        <div class="image col-md-3 col-sm-3">
                            <a href="javascript:;" class="click-image" data-id="{{ $media->id }}"><img src="{{ url($media->url) }}" alt="{{ $media->alt }}" class="img-responsive img-thumbnail"></a>
                        </div>


                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="image-modal-{{ $media->id }}">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Attachment Details</h4>
                                    </div>
                                    <div class="modal-body">
                                    
                                        <div class="row">
                                            <div class="col-md-6">

                                                <center><img src="{{ url($media->url) }}" class="img-thumbnail img-responsive" id="preview-img"></center>

                                            </div>
                                            <div class="col-md-6">

                                                <label class="control-label">File name:&nbsp{{ $media->mediameta->name }}</label> <br />
                                                <label class="control-label">File type:&nbsp{{ $media->mediameta->type }}</label> <br />
                                                <label class="control-label">Uploaded on:&nbsp{{ $media->mediameta->created_at }}</label> <br />
                                                <label class="control-label">File size:&nbsp{{ $media->mediameta->size }}</label> <br />
                                                <label class="control-label">Dimension:&nbsp{{ $media->mediameta->dimension }}</label> <br />

                                                <hr>

                                                <form method="post" action="{{ url('/dashboard/media/'.$media->id.'/edit') }}">
                                                    {{ csrf_field() }}
                                                    <div class="form-group row">
                                                        <label for="URL" class="col-md-4 col-form-label">URL</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="url" placeholder="URL" name="url" value="{{ $media->url }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Title" class="col-md-4 col-form-label">Title</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $media->title }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Caption" class="col-md-4 col-form-label">Caption</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="caption" placeholder="Caption" name="caption" value="{{ $media->caption }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Alt Text" class="col-md-4 col-form-label">Alt Text</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="alt" placeholder="Alt Text" name="alt" value="{{ $media->alt }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Description" class="col-md-4 col-form-label">Description</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{ $media->description }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Uploaded By" class="col-md-4 col-form-label">Uploaded By</label>
                                                        <div class="col-md-8">
                                                            <label for="Uploaded By" class="control-label">{{ $media->user->name }}</label>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <a href="{{ url('/dashboard/media/'.$media->id.'/edit') }}">Edit more details</a> | <a href="javascript:;" style="color: red;" onclick="event.preventDefault();
                                                             document.getElementById('delete-form').submit();
                                                    ">Delete Permanently</a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>

                                        <form id="delete-form" action="{{ url('/dashboard/media/'.$media->id.'/delete') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach
                        <div class="clearfix"></div>
                    </div><!--END OF BODY-GALLERY-->
                </div><!--END OF GALLERY-->
            
            </div><!--END OF .CONTENT-GALLERY-->

        	
        </div>
        <!-- /#page-content-wrapper -->

@endsection

@section('javascript')
	
	<script type="text/javascript">

        $('.click-image').on('click', function(){

            var id = $(this).data("id");

            $('#image-modal-'+id).modal({
                "show" : true,
                "backdrop" : "static"
            });

        });

	</script>

@stop
