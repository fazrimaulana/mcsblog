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
          <div class="image col-md-12 col-sm-12 col-xs-12">
            <img class="wrapper-img" src="{{ url($post->image) }}">
          </div><!--END OF .IMAGE-->
          <div class="detail col-md-12 col-sm-12 col-xs-12">
            {!! $post->content !!}
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
            <table>
              <tr>
                <td>
                  <input type="text" class="form-control" placeholder="Name...">
                </td>
                <td>
                  <input type="text" class="form-control" placeholder="Email...">
                </td>
              </tr>
            </table>
            <div class="form-group">
              <textarea class="form-control" rows="5" id="comment" placeholder="Write a comment..."></textarea>
            </div>
            <div class="submit-comment">
              <button class="btn btn-lg">
                <p>SUBMIT</p>
              </button>
            </div>
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

                        @foreach($post->comments as $comment)

                            @php
                              $commentParent = $comment->where('parent_id', null)->get();
                            @endphp

                        @endforeach

                        @foreach($commentParent as $parent)

                        <li>

                            <div class="comment-main-level">
                              <!-- Avatar -->
                              @if($parent->user->usermeta->image!=null)
                                <div class="comment-avatar"><img src="{{ url($parent->user->usermeta->image) }}" alt=""></div>
                              @else
                                <div class="comment-avatar"><img src="{{ url('/backend/images/profile-pic.jpeg') }}" alt=""></div>
                              @endif
                              <!-- Contenedor del Comentario -->
                              <div class="comment-box">
                                <div class="comment-head">
                                  <h6 class="comment-name"><a href="#">{{ $parent->user->name }}</a></h6>
                                  <span>{{ $parent->created_at->diffForHumans() }}</span>
                                  <i class="fa fa-reply"></i>
                                </div>
                                <div class="comment-content">
                                  {!! $parent->content !!}
                                </div>
                              </div>
                            </div>

                            @php
                              $commentChild = $parent->where('parent_id', $parent->id)->get();
                            @endphp

                              <ul class="comments-list reply-list">
                                @foreach($commentChild as $child)

                                <li>
                                    <!-- Avatar -->
                                    @if($child->user->usermeta->image!=null)
                                      <div class="comment-avatar"><img src="{{ url($child->user->usermeta->image) }}" alt=""></div>
                                    @else
                                      <div class="comment-avatar"><img src="{{ url('/backend/images/profile-pic.jpeg') }}" alt=""></div>
                                    @endif
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name"><a href="#">{{ $child->user->usermeta->name }}</a></h6>
                                            <span>{{ $child->created_at->diffForHumans() }}</span>
                                            <i class="fa fa-reply"></i>
                                        </div>
                                        <div class="comment-content">
                                            {{ $child->content }}
                                        </div>
                                    </div>
                                </li>

                                @endforeach
                              </ul>

                          </li>

                        @endforeach

                    </ul>
                </div>
            </div><!--END OF .WR-COMMENT-->
         </div><!--END OF .COMMENT-->

    </div><!--END OF .SINGLE-POST-->

@endsection