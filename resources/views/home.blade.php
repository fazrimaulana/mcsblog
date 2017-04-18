@extends('layouts.backend')

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="row">
                
                <div class="col-md-6 col-sm-6 col-xs-6">
                    
                    <div class="content-ui-element">
                        <div class="panel-custom">
                            <div class="heading-1">
                                <h4>At a Glance</h4>
                            </div>
                            <div class="panel-body-custom">
                                    
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label class="label-control"><i class="fa fa-thumb-tack"></i> <a href="{{ url('/dashboard/posts') }}"> {{ $posts->count() }} Posts</a></label>  
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label class="label-control"><i class="fa fa-thumb-tack"></i> <a href="{{ url('/dashboard/pages') }}"> {{ $pages->count() }} Pages</a></label>  
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label class="label-control"><i class="fa fa-comment"></i> <a href="{{ url('/dashboard/comments') }}"> {{ $comments->count() }} Comments</a></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!--END OF .CONTENT-USER-PROFILE-->

                </div>

            </div>

        </div>
        <!-- /#page-content-wrapper -->
@endsection
