<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
      
            @php
                use Modules\Settings\Models\Setting;
                $site_title = Setting::where('setting_name', 'site_title')->first();
            @endphp

            {{ $site_title->setting_value }}

    </title>

    <!-- CSS-->
    <link href="{{ url('/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/frontend/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/frontend/css/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,700" rel="stylesheet"> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ url('/frontend/js/bootstrap.min.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    @php

      use Modules\Posts\Models\Post;
      use Modules\Posts\Models\Category;
      use Modules\Posts\Models\Tag;

      $categories = Category::all();
      $tags       = Tag::all();
      $popular_posts = Post::where('type', 'post')->orderBy('view_count', 'desc')->paginate(3);
      $recent_posts = Post::where('type', 'post')->orderBy('published_at', 'desc')->paginate(3);

    @endphp

    <div class="header">
      <nav class="navbar navbar-default navbar-custom">
        <div class="wr-navbar container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed open" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url(Modules\Settings\Models\Setting::getUrlHome('site_url')) }}"> MCS Blog</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Gallery</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <div class="input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </span>
                  <input type="text" class="form-control" placeholder="Search for...">
                </div><!-- /input-group -->
              </li>
              <!-- <li><a href="#">Sign In</a></li>
              <li><a href="#">Sign Up</a></li> -->
              @if(Auth::user())
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">User Profile</a></li>
                  <li><a href="#">Account Setting</a></li>
                  <li><a href="{{ url('/logoutUser') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Log Out</a></li>

                  <form id="logout-form" action="{{ url('/logoutUser') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  </form>

                </ul>
              </li>
              @endif
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div><!--END OF .HEADER-->
    
    @yield('content')

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

    <script type="text/javascript">

       // Belum detect view secara realtime
      var viewportWidth = $(window).width();
      var viewportHeight = $(window).height();

      // script untuk toggle .show-search
      $(document).ready(function() {
          $('.input-search').css({'display':'none'});
          $('.show-search').click(function() {
            $('.input-search').animate({height: 'toggle'});
            $('.input-search').css({ 'top': 80, 'position': 'fixed', 'z-index': 999 });
          });
      });
    </script>
  </body>
</html>