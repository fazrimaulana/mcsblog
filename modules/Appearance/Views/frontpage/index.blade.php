@extends('layouts.Backend.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-th" aria-hidden="true"></i> Frontpage
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="content-ui-element">

                <div class="panel-custom">
                    <div class="panel-body-custom">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#about" role="tab">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#contact" role="tab">Contact</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="about" role="tabpanel">
                                <hr>
                                <form method="post">
                                    {{ csrf_field() }}
                                    
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addMedia" data-backdrop="static">Add Media</a><br /><br />

                                    <input type="hidden" name="page" value="about">

                                    <textarea name="content" class="form-control" id="content">{{ $about->content }}</textarea>
                                        @if($errors->has('content'))
                                            <span style="color: red;">{{ $errors->first('content') }}</span>
                                        @endif

                                    <br \>
                                    <button type="submit" class="btn btn-primary btn-md">Save</button>
                                </form>

                            </div>
                        
                            <div class="tab-pane" id="contact" role="tabpanel">
                                
                                <hr>

                                @php $json = json_decode($contact->content); @endphp

                                <form method="post" action="{{ url('/dashboard/frontpage/contact') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ $json->email }}">

                                        @if($errors->has('email'))
                                            <span style="color: red;">{{ $errors->first('email') }}</span>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="No Telepon">No Telepon</label>
                                        <input type="text" class="form-control" id="No Telepon" aria-describedby="No Telepon" placeholder="No Telepon" name="noTelepon" value="{{ $json->noTelepon }}">

                                        @if($errors->has('noTelepon'))
                                            <span style="color: red;">{{ $errors->first('noTelepon') }}</span>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="Address">Address</label>
                                        <Textarea class="form-control" name="address">{{ $json->address }}</Textarea>

                                        @if($errors->has('address'))
                                            <span style="color: red;">{{ $errors->first('address') }}</span>
                                        @endif

                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div><!--END OF .CONTENT-USER-PROFILE-->        

        </div>
        <!-- /#page-content-wrapper -->


        <!-- Modal -->
<div class="modal fade" id="addMedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Media</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            @foreach($medias as $media)
                <div class="col-sm-2">
                    <img src="{{ url($media->url) }}" id="{{ $media->id }}" data-id="{{ $media->id }}" class="img-responsive img-thumbnail media" width="200" height="auto">
                </div>
            @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="tombol" class="btn btn-primary" >Tambah ke Artikel</button>
      </div>
     
    </div>
  </div>
</div>

@endsection

@section('javascript')
    
    <script type="text/javascript" src="{{ url('/backend/assets/tinymce/tinymce.min.js') }}"></script>

    <script type="text/javascript">

        tinymce.init({
            selector: '#content',
            height: 400,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });

        $('.media').on('click', function(){
            var id     = $(this).data('id');
            var srcimg = $(this).attr('src');
            var wimg   = $(this).attr('width');
            var himg   = $(this).attr('height');
            $('#content_ifr').contents().find('#tinymce').append('<img src="'+ srcimg +'" width="'+wimg+'" height="'+himg+'">');
            $(".close").click();

            console.log(srcimg);

        });

    </script>

@stop
