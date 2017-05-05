@extends('layouts.Frontend.Default.app')

@section('content')
	
	<div class="gallery">
        
        <div class="image">
            <div class="wr-image container">
                <div class="title text-center">
                    <h1>GALLERY</h1>
                </div>
                <div class="list-image">
                	@foreach($medias as $media)
                		<div class="photo col-md-3 col-sm-4">
                        	<div class="wr-photo">
                            	<img src="{{ url($media->url) }}" class="click-image" data-id="{{ $media->id }}">
                        	</div>
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

                                                    <div class="form-group row">
                                                        <label for="URL" class="col-md-4 col-form-label">URL</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="url" placeholder="URL" name="url" value="{{ $media->url }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Title" class="col-md-4 col-form-label">Title</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $media->title }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Caption" class="col-md-4 col-form-label">Caption</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="caption" placeholder="Caption" name="caption" value="{{ $media->caption }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Alt Text" class="col-md-4 col-form-label">Alt Text</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="alt" placeholder="Alt Text" name="alt" value="{{ $media->alt }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Description" class="col-md-4 col-form-label">Description</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{ $media->description }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="Uploaded By" class="col-md-4 col-form-label">Status</label>
                                                        <div class="col-md-8">
                                                            <label class="label-control">Public</label>
                                                        </div>
                                                    </div>                                             
                                                    <div class="form-group row">
                                                        <label for="Uploaded By" class="col-md-4 col-form-label">Uploaded By</label>
                                                        <div class="col-md-8">
                                                            <label for="Uploaded By" class="control-label">{{ $media->user->name }}</label>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                	@endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div><!--END OF .GALLERY-->

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