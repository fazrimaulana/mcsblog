@extends('layouts.frontend')

@section('content')
    <div class="header">
      <div class="wr-header container">
        <div class="logo col-md-3 col-sm-12 col-xs-12">
          <a class="navbar-brand" href="#">
            <h1>MCS Blog</h1>
          </a>
        </div><!--END OF .LOGO-->
        <div class="menu col-md-9 col-sm-12 col-xs-12">
          <nav class="navbar navbar-default navbar-custom">
            <div class="container-fluid wr-navbar">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand visible-xs">MENU &rarr;</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse navbar-menu" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="active">
                    <a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li><a href="#">About</a></li>
                  <li>
                    <a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li>
                    <a href="#" class="show-search"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
                  </li>
                  @if (Route::has('login'))
                    @if (Auth::check())
                      <li>
                        <a href="{{ url(Modules\Settings\Models\Setting::getUrlHome('home_url')) }}"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}</a>
                      </li>
                    @else
                      <!-- <li>
                        <a href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a>
                      </li> -->
                      <!-- <li>
                        <a href="{{ url('/register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a>
                      </li> -->
                    @endif
                  @endif
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav><!--END OF .NAVBAR-->
        </div><!--END OF .MENU-->
        <div class="clearfix"></div>
      </div><!--END OF .WR-HEADER-->
    </div><!--END OF .HEADER-->
    
    <div class="input-search col-md-12 col-sm-12 col-xs-12">
      <div class="input-group-lg">
        <input type="text" class="form-control " placeholder="Search...">
      </div>
    </div>

    <div class="opening">
      <h4>
        {{ $tagline->setting_value }}
      </h4>
    </div><!--END OF .OPENING-->

    <div class="post">

      @foreach($posts as $post)

        <div class="artikel container">
          <div class="type-tag col-md-12 col-sm-12 col-xs-12 text-center">
            <p>
              
              @foreach($post->categories as $category)
                {{ $category->name }},
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
          <div class="artikel-footer">
            <div class="footer-left col-md-10 col-sm-10 col-xs-12">
              <div class="type-user col-md-3 col-sm-4">
                <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $post->user->name }}</p>
              </div>
              <div class="date col-md-3 col-sm-4">
                <p><i class="fa fa-calendar" aria-hidden="true"></i> {{ App\Helpers\Tanggal::TanggalIndo($post->published_at) }}</p>
              </div>
              <div class="comment col-md-3 col-sm-4">
                <p><i class="fa fa-comment-o" aria-hidden="true"></i> <a href="#">{{ $post->comments_count }} COMMENTS</a></p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="footer-right col-md-2 col-sm-2 col-xs-12">
              <p class="pull-right"><a href="{{ url('/'.$post->slug) }}">READ MORE...</a></p>
            </div>
            <div class="clearfix"></div>
          </div><!--END OF .ARTIKEL-FOOTER-->
        </div><!--END OF .ARTIKEL-->

      @endforeach

      <!-- <nav aria-label="Page navigation" id="div1">
        <ul class="pager">
          <li>
            <a href="#" aria-label="Previous">
              <span aria-hidden="true">«</span>
            </a>
          </li>
          <li><a href="#" class="active">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li>
            <a href="#" aria-label="Next">
              <span aria-hidden="true">»</span>
            </a>
          </li>
        </ul>
      </nav> -->

      @if($posts->lastPage() > 1)

      <nav aria-label="Page navigation" id="div1">
        <ul class="pager">
          @if($posts->currentPage() != 1)
            <li>
              <a href="{{ $posts->url(1) }}" aria-label="Previous">
                <span aria-hidden="true">«</span>
              </a>
            </li>
          @endif
          @for($i = 1; $i <= $posts->lastPage(); $i++)

            @if( ( ($i >= $posts->currentPage()-3) && ( $i <= $posts->currentPage()+3 ) ) || ($i == 1) )

              @if($i==$posts->lastPage() && $posts->currentPage() <= $posts->lastPage()-5)

                <li><a href="{{ $posts->url( $posts->currentPage()-4 ) }}" class="{{ ($posts->currentPage() == $i) ? ' active' : '' }}">...</a></li>

              @endif            

              @if($i == $posts->currentPage())

                <li><a href="{{ $posts->url($i) }}" class="{{ ($posts->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a></li>

              @else

                <li><a href="{{ $posts->url($i) }}" class="{{ ($posts->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a></li>

              @endif

              @if($i==1 && $posts->currentPage() >= 6)

                <li><a href="{{ $posts->url( $posts->currentPage()-4 ) }}" class="{{ ($posts->currentPage() == $i) ? ' active' : '' }}">...</a></li>

              @endif

            @endif

          @endfor

          @if($posts->currentPage()!=$posts->lastPage() && $posts->currentPage()+4<=$posts->lastPage() && $posts->lastPage()>=5 )

            <li>
              <a href="{{ $posts->url( $posts->currentPage()+4 ) }}" class="{{ ($posts->currentPage() == $i) ? ' active' : '' }}">
                ...
              </a>
            </li>

          @endif

          @if($posts->currentPage()!=$posts->lastPage())

            <li>
              <a href="{{ $posts->url($posts->currentPage()+1) }}" class="{{ ($posts->currentPage() == $posts->lastPage()) ? 'disabled' : '' }}" aria-label="Next">
                <span aria-hidden="true">»</span>
              </a>
            </li>

          @endif

        </ul><!--END OF .PAGER-->
      </nav><!--END OF .NAVIGATION-->
      @endif

    </div><!--END OF .POST-->

    <div class="features">
      <div class="wr-features container">
        <div class="features-left col-md-3 col-sm-3 col-xs-12">
          <div class="category">
            <div class="title">
              <h3>CATEGORIES</h3>
            </div><!--END OF .TITLE-->
            <div class="list-category">
              <ul class="list">
                @foreach($categories as $category)
                  <li>
                    <a href="{{ url('/category/'.$category->slug) }}">{{ $category->name }}</a>
                  </li>
                @endforeach
              </ul><!--END OF .LIST-->
            </div><!--END OF .LIST-CATEGORY-->
          </div><!--END OF .CATEGORY-->

          <div class="about">
            <div class="title">
              <h3>ABOUT</h3>
            </div><!--END OF .TITLE-->
            <div class="detail">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              </p>
            </div><!--END OF .DETAIL-->
            <div class="sosmed">
              <ul class="nav nav-pills">
                <li role="presentation">
                  <a href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                </li>
                <li role="presentation">
                  <a href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                </li>
                <li role="presentation">
                  <a href="#"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
                </li>
                <li role="presentation">
                  <a href="#"><i class="fa fa-youtube fa-lg" aria-hidden="true"></i></a>
                </li>
              </ul>
            </div><!--END OF .SOSMED-->
          </div><!--END OF .ABOUT-->
        </div><!--END OF .FEATURES-LEFT-->

        <div class="features-mid col-md-6 col-sm-6 col-xs-12">
          <div class="popular-post col-md-6 col-sm-6 col-xs-12">
            <div class="title">
              <h3>POPULAR POSTS</h3>
            </div><!--END OF .TITLE-->
            @foreach($popular_posts as $popular)
              <div class="wr-popular">
                <div class="image">
                  <img class="img-responsive" src="{{ url($popular->image) }}">
                </div>
                <a href="{{ url('/'.$popular->slug) }}">{{ $popular->title }}</a>
              </div><!--END OF .WR-POPULAR-->
            @endforeach
          </div><!--END OF .POPULAR-POST-->

          <div class="recent-post col-md-6 col-sm-6 col-xs-12">
            <div class="title">
              <h3>RECENT POSTS</h3>
            </div><!--END OF .TITLE-->
            @foreach($recent_posts as $recent)
              <div class="wr-recent">
                <div class="image">
                  <img class="img-responsive" src="{{ url($recent->image) }}">
                </div>
                <a href="{{ url('/'.$recent->slug) }}">{{ $recent->title }}</a>
              </div><!--END OF .WR-POPULAR-->
            @endforeach
          </div><!--END OF .RECENT-POST-->
          <div class="clearfix"></div>
        </div><!--END OF .FEATURES-MID-->

        <div class="features-right col-md-3 col-sm-3 col-xs-12">
          <div class="newsletter">
            <div class="title">
              <h3>NEWSLETTER</h3>
            </div>
            <div class="input">
              <input type="text" class="form-control" placeholder="Write an email...">
              <button class="btn btn-block"><p>SEND</p></button>
            </div>
          </div><!--END OF .NEWSLETTER-->

          <div class="tags">
            <div class="title">
              <h3>TAGS</h3>
            </div>
            <div class="category">
              <ul class="list">
                @foreach($tags as $tag)
                  <li><a href="{{ url('/tag/'.$tag->slug) }}">{{ $tag->name }}</a></li>
                @endforeach
              </ul>
            </div>
            <div class="clearfix"></div>
          </div><!--END OF .TAGS-->
        </div><!--END OF .FEATURES-RIGHT-->
        <div class="clearfix"></div>
      </div><!--END OF .WR-FEATURES-->
    </div><!--END OF .FEATURES-->

    <div class="footer text-center">
      <small>Maxindo Content Solution &copy; 2017 - All Right Reserved. </small>
    </div>
@endsection