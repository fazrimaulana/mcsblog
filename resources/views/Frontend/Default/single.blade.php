@extends('layouts.Frontend.Default.app')

@section('content')

    <div class="single-post">

      <div class="post">
        <div class="artikel container">
          <div class="type-tag col-md-12 col-sm-12 col-xs-12 text-center">
            <p>
              
              @foreach($post->categories as $category)
                {{ $category->name }},&nbsp
              @endforeach

            </p>
          </div><!--END OF .TYPE-TAG-->
          <div class="title col-md-12 col-sm-12 col-xs-12 text-center">
            <h1>{{ $post->title }}</h1>
          </div><!--END OF .TITLE-->
          @if($post->image)
          <div class="image col-md-12 col-sm-12 col-xs-12">
            <img class="wrapper-img" src="{{ url($post->image) }}">
          </div><!--END OF .IMAGE-->
          @endif
          <div class="detail col-md-12 col-sm-12 col-xs-12">
            {!! str_replace("../../../","../",$post->content) !!}
          </div><!--END OF .DETAIL-->
          <div class="artikel-footer col-md-12 col-sm-12 col-xs-12">
              <div class="type-user col-md-6 col-sm-6">
                <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $post->user->name }}</p>
              </div>
              <div class="date col-md-6 col-sm-6">
                <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ App\Helpers\Tanggal::TanggalIndo($post->published_at) }}</p>
              </div>
              <div class="clearfix"></div>
          </div><!--END OF .ARTIKEL-FOOTER-->
        </div><!--END OF .ARTIKEL-->
      </div><!--END OF .POST-->

      <div class="form-comment">
        <div class="wr-form-comment container">
          <div class="title col-md-12 col-sm-12 col-xs-12">
            <h1>LEAVE A COMMENT</h1>
          </div><!--END OF .TITLE-->

          <div class="form col-md-12 col-sm-12 col-xs-12">
            <form method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="form-group">
              <textarea class="form-control" rows="5" id="comment" placeholder="Write a comment..." name="content"></textarea>
            </div>
            <div class="submit-comment">
              <button type="submit" class="btn btn-lg">
                <p>Send</p>
              </button>
            </div>
            </form>
          </div><!--END OF .FORM-->
        </div><!--END OF .WR-FORM-COMMENT-->
      </div><!--END OF .FORM-COMMENT-->

      <div class="comment">
            <div class="wr-comment container">
                <div class="heading-comment col-md-12 col-sm-12 col-xs-12">
                    <nav class="navbar navbar-default navbar-custom">
                        <div class="container-fluid">
                            <div class="navbar-header title">
                                <h1>COMMENT <span class="badge">{{ $post->comments_count }}</span></h1>
                            </div>
                            <ul class="nav navbar-nav navbar-right menu">
                                <li>
                                    <a href="#">Newest</a>
                                </li>
                                <li>
                                    <a href="#" class="active">Oldest</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div><!--END OF .HEADING-COMMENT-->
                <div class="comments-container col-md-12 col-sm-12 col-xs-12">
                    <ul id="comments-list" class="comments-list">

                      @if(count($comments)!=0)

                        @foreach($comments as $comment)

                        <li>

                            <div class="comment-main-level">
                              <!-- Avatar -->
                              @if($comment->user->usermeta->image!=null)
                                <div class="comment-avatar"><img src="{{ url($comment->user->usermeta->image) }}" alt=""></div>
                              @else
                                <div class="comment-avatar"><img src="{{ url('/backend/images/profile-pic.jpeg') }}" alt=""></div>
                              @endif
                              <!-- Contenedor del Comentario -->
                              <div class="comment-box">
                                <div class="comment-head">
                                  <h6 class="comment-name"><a href="#">{{ $comment->user->name }}</a></h6>
                                  <span>{{ $comment->created_at->diffForHumans() }}</span>
                                  <a href="#input-comment-main_{{ $comment->id }}" data-toggle="collapse">
                                    <i class="fa fa-reply"></i>
                                  </a>
                                </div>
                                <div class="comment-content">
                                  {!! $comment->content !!}
                                </div>
                                <div id="input-comment-main_{{ $comment->id }}" class="collapse input-reply">

                                  <form method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <input type="hidden" name="id_comment" value="{{ $comment->id }}">
                                      <textarea class="form-control" rows="3" id="comment" placeholder="Write a comment..." name="content"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                                    </div>
                                  </form>

                                </div>
                              </div>
                            </div>

                            @php
                              $commentReply = $comment->where('parent_id', $comment->id)->get();
                            @endphp

                              <ul class="comments-list reply-list">
                                @foreach($commentReply as $reply)

                                <li>
                                    <!-- Avatar -->
                                    @if($reply->user->usermeta->image!=null)
                                      <div class="comment-avatar"><img src="{{ url($reply->user->usermeta->image) }}" alt=""></div>
                                    @else
                                      <div class="comment-avatar"><img src="{{ url('/backend/images/profile-pic.jpeg') }}" alt=""></div>
                                    @endif
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name"><a href="#">{{ $reply->user->name }}</a></h6>
                                            <span>{{ $reply->created_at->diffForHumans() }}</span>
                                            <a href="#input-comment-reply_{{ $reply->id }}" data-toggle="collapse">
                                              <i class="fa fa-reply"></i>
                                            </a>
                                        </div>
                                        <div class="comment-content">
                                            {{ $reply->content }}
                                        </div>
                                        <div id="input-comment-reply_{{ $reply->id }}" class="collapse input-reply">

                                          <form method="post" >
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                              <input type="hidden" name="id_comment" value="{{ $reply->id }}">
                                              <textarea class="form-control" rows="3" id="comment" placeholder="Write a comment..." name="content"></textarea>
                                            </div>
                                            <div class="form-group">
                                              <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                                            </div>
                                          </form>

                                        </div>
                                    </div>
                                </li>

                                @endforeach
                              </ul>

                          </li>

                        @endforeach

                      @endif
                      
                    </ul>
                </div>
            </div><!--END OF .WR-COMMENT-->
         </div><!--END OF .COMMENT-->

    </div><!--END OF .SINGLE-POST-->

@endsection