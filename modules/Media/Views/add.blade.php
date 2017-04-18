@extends('layouts.backend')

@section('css')
    
    <link href="{{ url('/backend/assets/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">

@endsection

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-home" aria-hidden="true"></i> Add Media
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        	<!--.CONTENT-NEW-USER-->
        <div class="content-ui-element">
            <div class="panel-custom">
                <div class="heading-1">
                    <h3>Add Media</h3>
                </div>
                <div class="panel-body-custom">

                    <div id="upload-1">
                        
                        <form class="form-inline" action="{{ url('/dashboard/media/add') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label class="sr-only" for="inlineFormInput">Image</label>
                            <input type="file" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Jane Doe" name="file" accept="image/*">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                        <br />
                        <p>
                            You are using the browser's built-in file uploader. The MCSblog uploader includes multiple file selection and drag and drop capability. <u><a href="javascript:;" id="show-multi">Switch to the multi-file uploader.</a></u>
                        </p>

                    </div>

                    <div id="multi" style="display: none;">
                        <form action="{{ url('/dashboard/media/add') }}" class="dropzone" id="myAwesomeDropzone">
                            {{ csrf_field() }}
                        </form>
                        <br />
                        You are using the multi-file uploader. Problems? Try the <u><a href="javascript:;" id="show-upload1">Browser Uploader</a></u> instead.
                    </div>

                </div>
            </div>
        </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

@endsection

@section('javascript')

    <script src="{{ url('/backend/assets/dropzone/dist/min/dropzone.min.js') }}"></script>
    
    <script type="text/javascript">
        
        $('#show-multi').on('click', function(){

            $('#upload-1').hide();
            $('#multi').show();

        });

        $('#show-upload1').on('click', function(){

            $('#upload-1').show();
            $('#multi').hide();

        });
      
        Dropzone.options.myAwesomeDropzone = {
            acceptedFiles:"image/*",
            success: function (file, response)
            {
                file._captionLabel = Dropzone.createElement("<a class='dz-remove _"+ response +"' href='javascript:;' data-id='"+response+"'>Edit</a>");
                file.previewElement.appendChild(file._captionLabel);

                $('._'+response).on('click', function(){

                    var url = "{{ url('/dashboard/media') }}";
                    var id = $(this).data("id");

                    window.open(url+"/"+id+"/edit");

                });

            }
        };

    </script>

@stop
