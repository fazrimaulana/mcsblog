@extends('layouts.Backend.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-image" aria-hidden="true"></i> Themes <!-- <a href="{{ url('/dashboard/media/add') }}" class="btn btn-sm btn-4 btn-info" >Add New</a> -->
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
                        
                        @foreach($themes as $theme)
                        <div class="image col-md-3 col-sm-3">

                                <div class="photo text-center">
                                    
                                    @if($theme->image!=null)    
                                        <img src="{{ url($theme->image) }}"

                                        @if( Modules\Settings\Models\Setting::getThemeId('theme') == $theme->id)
                                            style="border: 3px;border-style: solid;border-color: #313E4B;"
                                        @endif

                                        >
                                    @else
                                        <img src="{{ url('/backend/images/laravel.png') }}"

                                            @if( Modules\Settings\Models\Setting::getThemeId('theme') == $theme->id)
                                                style="border: 3px;border-style: solid;border-color: #313E4B;"
                                            @endif

                                         >
                                    @endif

                                </div>
                                <div class="footer-img active">
                                    <div class="name-img pull-left">
                                        <p>

                                            @if( Modules\Settings\Models\Setting::getThemeId('theme') == $theme->id)
                                                <b>Active:</b>&nbsp 
                                            @endif

                                            {{ $theme->name }}

                                        </p>
                                    </div>
                                    @if( Modules\Settings\Models\Setting::getThemeId('theme') != $theme->id)
                                    <div class="btn-active pull-right">
                                            <a href="{{ url('/dashboard/themes/'.$theme->id.'/active') }}" class="btn aktiv btn-md btn-primary">Active</a>
                                    </div>
                                    @endif
                                    <div class="clearfix"></div>
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
	
	

@stop
