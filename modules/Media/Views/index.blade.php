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

			console.log($(this).data("id"));

		});

	</script>

@stop
