@extends('layouts.Frontend.Default.app')

@section('css')
	
	<link rel="stylesheet" href="{{ url('/frontend/css/jquery.bxslider.css') }}">

@endsection

@section('content')
	
	<div class="about-page">
        <div class="information container">
            <div class="wr-information">
                <div class="detail">
                        
                        {!! str_replace("../","",$about->content) !!}

                </div><!--END OF .DETAIL-->
            </div><!--END OF .WR-INFORMATION-->
        </div><!--END OF .INFORMATION-->

        <div class="our-team">
            <div class="title-our-team text-center">
                <h1>OUR TEAM</h1>
            </div><!-- END OF .TITLE-OUR-TEAM -->
            <div class="content-slider">
                <div class="slider-controller-left bx-controls-direction col-md-1 col-sm-1">
                    <a class="bx-prev prev-list" href=""></a>
                </div>
                <div class="wrapper-content-slider col-md-10 col-sm-10">
                    <div class="content-slider-list container">
                        <div class="team-list text-center">
                            <div class="pic-profil">
                                <img src="{{ url('/frontend/images/team-1.png') }}">
                            </div>
                            <div class="user-name">
                                <h4>Jhon Wick</h4>
                                <p>Leader Developer</p>
                            </div>
                            <div class="personal-info">
                                <p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> 0811223344</p>
                                <p class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> jhon@gmail.com</p>
                            </div>
                        </div><!--END OF .TEAM-LIST-->
                        <div class="team-list text-center">
                            <div class="pic-profil">
                                <img src="{{ url('/frontend/images/team-1.png') }}">
                            </div>
                            <div class="user-name">
                                <h4>Jhon Wick</h4>
                                <p>Leader Developer</p>
                            </div>
                            <div class="personal-info">
                                <p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> 0811223344</p>
                                <p class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> jhon@gmail.com</p>
                            </div>
                        </div><!--END OF .TEAM-LIST-->
                        <div class="team-list text-center">
                            <div class="pic-profil">
                                <img src="{{ url('/frontend/images/team-1.png') }}">
                            </div>
                            <div class="user-name">
                                <h4>Jhon Wick</h4>
                                <p>Leader Developer</p>
                            </div>
                            <div class="personal-info">
                                <p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> 0811223344</p>
                                <p class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> jhon@gmail.com</p>
                            </div>
                        </div><!--END OF .TEAM-LIST-->
                        <div class="team-list text-center">
                            <div class="pic-profil">
                                <img src="{{ url('/frontend/images/team-1.png') }}">
                            </div>
                            <div class="user-name">
                                <h4>Jhon Wick</h4>
                                <p>Leader Developer</p>
                            </div>
                            <div class="personal-info">
                                <p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> 0811223344</p>
                                <p class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> jhon@gmail.com</p>
                            </div>
                        </div><!--END OF .TEAM-LIST-->
                        <div class="team-list text-center">
                            <div class="pic-profil">
                                <img src="{{ url('/frontend/images/team-1.png') }}">
                            </div>
                            <div class="user-name">
                                <h4>Jhon Wick</h4>
                                <p>Leader Developer</p>
                            </div>
                            <div class="personal-info">
                                <p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> 0811223344</p>
                                <p class="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> jhon@gmail.com</p>
                            </div>
                        </div><!--END OF .TEAM-LIST-->
                    </div>
                </div>
                <div class="slider-controller-right col-md-1 col-sm-1 bx-controls-direction">
                    <span class="bx-next next-list" href=""></span>
                </div>
                <div class="clearfix"></div>
            </div><!-- END OF .CONTENT-SLIDER -->
        </div><!-- END OF .OUR-TEAM -->

    </div><!--END OF .ABOUT-->

@endsection

@section('javascript')
	
	<!-- js bxlider -->
    <script src="{{ url('/frontend/js/jquery.bxslider.min.js') }}"></script>

	<script type="text/javascript">
		// script untuk slide .content-slider-list
      $(document).ready(function() {
        $('.content-slider-list').bxSlider({
          slideWidth: 350,
          minSlides: 1,
          maxSlides: 3,
          moveSlides: 1,
          slideMargin: 10,
          nextSelector: '.bx-next',
          prevSelector: '.bx-prev',
          prevText: '<i class="fa fa-arrow-left fa-2x border-custom" aria-hidden="true"></i>',
          nextText: '<i class="fa fa-arrow-right fa-2x border-custom" aria-hidden="true"></i>'
        })
      });
	</script>

@stop