<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MCS's Blog</title>

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
                  <li>
                    <a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a>
                  </li>
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
      <h4><span>WELCOME</span> ON MCS'S BLOG</h4>
    </div><!--END OF .OPENING-->

    <div class="post">
      
      <div class="artikel container">
        <div class="type-tag col-md-12 col-sm-12 col-xs-12 text-center">
          <p>ACTION</p>
        </div><!--END OF .TYPE-TAG-->
        <div class="title col-md-12 col-sm-12 col-xs-12 text-center">
          <h1>LOREM IPSUM IS SIMPLY DUMMY</h1>
        </div><!--END OF .TITLE-->
        <div class="image col-md-12 col-sm-12 col-xs-12">
          <img class="wrapper-img" src="{{ url('/frontend/images/image-1.jpg') }}">
        </div><!--END OF .IMAGE-->
        <div class="detail col-md-12 col-sm-12 col-xs-12">
          <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div><!--END OF .DETAIL-->
        <div class="artikel-footer">
          <div class="footer-left col-md-10 col-sm-10 col-xs-12">
            <div class="type-user col-md-3 col-sm-4">
              <p><i class="fa fa-user-o" aria-hidden="true"></i> ADMIN</p>
            </div>
            <div class="date col-md-3 col-sm-4">
              <p><i class="fa fa-calendar" aria-hidden="true"></i> 20 APRIL 2017</p>
            </div>
            <div class="comment col-md-3 col-sm-4">
              <p><i class="fa fa-comment-o" aria-hidden="true"></i> <a href="#">0 COMMENTS</a></p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="footer-right col-md-2 col-sm-2 col-xs-12">
            <p class="pull-right"><a href="#">READ MORE...</a></p>
          </div>
          <div class="clearfix"></div>
        </div><!--END OF .ARTIKEL-FOOTER-->
      </div><!--END OF .ARTIKEL-->

      <div class="artikel container">
        <div class="type-tag col-md-12 col-sm-12 col-xs-12 text-center">
          <p>BIOGRAPHY</p>
        </div><!--END OF .TYPE-TAG-->
        <div class="title col-md-12 col-sm-12 col-xs-12 text-center">
          <h1>LOREM IPSUM IS SIMPLY DUMMY</h1>
        </div><!--END OF .TITLE-->
        <div class="image col-md-12 col-sm-12 col-xs-12">
          <img class="wrapper-img" src="{{ url('/frontend/images/image-2.jpg') }}">
        </div><!--END OF .IMAGE-->
        <div class="detail col-md-12 col-sm-12 col-xs-12">
          <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div><!--END OF .DETAIL-->
        <div class="artikel-footer">
          <div class="footer-left col-md-10 col-sm-10 col-xs-12">
            <div class="type-user col-md-3 col-sm-4">
              <p><i class="fa fa-user-o" aria-hidden="true"></i> ADMIN</p>
            </div>
            <div class="date col-md-3 col-sm-4">
              <p><i class="fa fa-calendar" aria-hidden="true"></i> 20 APRIL 2017</p>
            </div>
            <div class="comment col-md-3 col-sm-4">
              <p><i class="fa fa-comment-o" aria-hidden="true"></i> <a href="#">0 COMMENTS</a></p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="footer-right col-md-2 col-sm-2 col-xs-12">
            <p class="pull-right"><a href="#">READ MORE...</a></p>
          </div>
          <div class="clearfix"></div>
        </div><!--END OF .ARTIKEL-FOOTER-->
      </div><!--END OF .ARTIKEL-->

      <div class="artikel container">
        <div class="type-tag col-md-12 col-sm-12 col-xs-12 text-center">
          <p>TEKHNOLOGY</p>
        </div><!--END OF .TYPE-TAG-->
        <div class="title col-md-12 col-sm-12 col-xs-12 text-center">
          <h1>LOREM IPSUM IS SIMPLY DUMMY</h1>
        </div><!--END OF .TITLE-->
        <div class="image col-md-12 col-sm-12 col-xs-12">
          <img class="wrapper-img" src="{{ url('/frontend/images/image-3.jpg') }}">
        </div><!--END OF .IMAGE-->
        <div class="detail col-md-12 col-sm-12 col-xs-12">
          <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
            It has survived not only five centuries, but also the leap into electronic typesetting, 
            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div><!--END OF .DETAIL-->
        <div class="artikel-footer">
          <div class="footer-left col-md-10 col-sm-10 col-xs-12">
            <div class="type-user col-md-3 col-sm-4">
              <p><i class="fa fa-user-o" aria-hidden="true"></i> ADMIN</p>
            </div>
            <div class="date col-md-3 col-sm-4">
              <p><i class="fa fa-calendar" aria-hidden="true"></i> 20 APRIL 2017</p>
            </div>
            <div class="comment col-md-3 col-sm-4">
              <p><i class="fa fa-comment-o" aria-hidden="true"></i> <a href="#">0 COMMENTS</a></p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="footer-right col-md-2 col-sm-2 col-xs-12">
            <p class="pull-right"><a href="#">READ MORE...</a></p>
          </div>
          <div class="clearfix"></div>
        </div><!--END OF .ARTIKEL-FOOTER-->
      </div><!--END OF .ARTIKEL-->

      <nav aria-label="Page navigation" id="div1">
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
        </ul><!--END OF .PAGER-->
      </nav><!--END OF .NAVIGATION-->
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
                <li>
                  <a href="#">ACTION</a>
                </li>
                <li>
                  <a href="#">OPINI</a>
                </li>
                <li>
                  <a href="#">TECHNOLOGY</a>
                </li>
                <li>
                  <a href="#">FOOD AND DRINK</a>
                </li>
                <li>
                  <a href="#">BIOGRAPHY</a>
                </li>
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
            <div class="wr-popular">
              <div class="image">
                <img class="img-responsive" src="{{ url('/frontend/images/image-1.jpg') }}">
              </div>
              <a href="#">LOREM IPSUM IS SIMPLY DUMMY</a>
            </div><!--END OF .WR-POPULAR-->
            <div class="wr-popular">
              <div class="image">
                <img class="img-responsive" src="{{ url('/frontend/images/image-2.jpg') }}">
              </div>
              <a href="#">LOREM IPSUM IS SIMPLY DUMMY</a>
            </div><!--END OF .WR-POPULAR-->
            <div class="wr-popular">
              <div class="image">
                <img class="img-responsive" src="{{ url('/frontend/images/image-3.jpg') }}">
              </div>
              <a href="#">LOREM IPSUM IS SIMPLY DUMMY</a>
            </div><!--END OF .WR-POPULAR-->
          </div><!--END OF .POPULAR-POST-->

          <div class="recent-post col-md-6 col-sm-6 col-xs-12">
            <div class="title">
              <h3>RECENT POSTS</h3>
            </div><!--END OF .TITLE-->
            <div class="wr-recent">
              <div class="image">
                <img class="img-responsive" src="{{ url('/frontend/images/image-1.jpg') }}">
              </div>
              <a href="#">LOREM IPSUM IS SIMPLY DUMMY</a>
            </div><!--END OF .WR-POPULAR-->
            <div class="wr-recent">
              <div class="image">
                <img class="img-responsive" src="{{ url('/frontend/images/image-2.jpg') }}">
              </div>
              <a href="#">LOREM IPSUM IS SIMPLY DUMMY</a>
            </div><!--END OF .WR-POPULAR-->
            <div class="wr-recent">
              <div class="image">
                <img class="img-responsive" src="{{ url('/frontend/images/image-3.jpg') }}">
              </div>
              <a href="#">LOREM IPSUM IS SIMPLY DUMMY</a>
            </div><!--END OF .WR-RECENT-->
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
                <li><a href="#">ACTION</a></li>
                <li><a href="#">OPINI</a></li>
                <li><a href="#">TECHNOLOGY</a></li>
                <li><a href="#">FOOD</a></li>
                <li><a href="#">DRINK</a></li>
                <li><a href="#">BIOGRAPHY</a></li>
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