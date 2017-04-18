@extends('layouts.backend')

@section('css')
    

@endsection

@section('content')
        <!-- HEADER-POST -->
        <div class="header-title">
            <h3>
                <i class="fa fa-home" aria-hidden="true"></i> Detail Tag
                <!-- <a href="#" id="new-post"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a> -->
            </h3>
        </div><!--END OF HEADER-POST-->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        	<!--.CONTENT-NEW-USER-->
            <div class="content-ui-element">
                <div class="panel-custom">
                    <div class="heading-1">
                        <h3>Detail Tag</h3>
                    </div>
                    <div class="panel-body-custom">
                        
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#posts" role="tab">Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pages" role="tab">Pages</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="posts" role="tabpanel">
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $tagPost = $tag->posts()->where('type', 'post')->get();
                                        @endphp
                                        @foreach($tagPost as $post)
                                            <tr>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="pages" role="tabpanel">
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $tagPost = $tag->posts()->where('type', 'page')->get();
                                        @endphp
                                        @foreach($tagPost as $post)
                                            <tr>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--END OF .CONTENT-USER-PROFILE-->

        </div>
        <!-- /#page-content-wrapper -->

@endsection

@section('javascript')


@stop
