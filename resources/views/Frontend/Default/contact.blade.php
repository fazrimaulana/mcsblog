@extends('layouts.Frontend.Default.app')

@section('content')
	<div class="contact-us">
	<div class="map">
          <div class="wr-map container">
            <div class="map-detail ">
               <iframe src="https://www.google.com/maps/embed?pb=!1m22!1m8!1m3!1d247.87974706014225!2d106.83289247356994!3d-6.253723568311199!3m2!1i1024!2i768!4f13.1!4m11!3e2!4m3!3m2!1d-6.253598299999999!2d106.8328987!4m5!1s0x2e69f3cc4a761853%3A0xadc609ac119acdf7!2sJl.+Duren+Tiga+Raya+No.47%2C+Duren+Tiga%2C+Pancoran%2C+Kota+Jakarta+Selatan%2C+DKI+Jakarta+12760!3m2!1d-6.2540159!2d106.83279399999999!5e0!3m2!1sid!2sid!4v1493371046208" width="1140" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div><!--END OF .MAP-DETAIL-->

            @php $json = json_decode($contact->content); @endphp

            <div class="info">
              <div class="address col-md-4 col-sm-4 text-center">
                <i class="fa fa-home fa-2x" aria-hidden="true"></i>
                <p>ADDRESS :</p>
                <a href="#">
                  <small>{{ $json->address }}</small>
                </a>
              </div>
              <div class="phone col-md-4 col-sm-4 text-center">
                <i class="fa fa-phone fa-2x" aria-hidden="true"></i>
                <p>TELEPHONE :</p>
                <a href="#">
                  <small>{{ $json->noTelepon }}</small>
                </a>
              </div>
              <div class="email col-md-4 col-sm-4 text-center">
                <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                <p>EMAIL :</p>
                <a href="#">
                  <small>{{ $json->email }}</small>
                </a>
              </div>
            </div><!--END OF .INFO-->
          </div><!--END OF .WR-MAP-->
        </div><!--END OF .MAP-->

        <div class="form-contact">
          <div class="wr-form-contact container">
            <div class="title text-center">
              <h1>CONTACT US</h1>
            </div>
            <div class="form">
              <div class="input-info row">
                <div class="name col-md-4 col-sm-4">
                  <input type="text" class="form-control" placeholder="Name...">
                </div>
                <div class="email col-md-4 col-sm-4">
                  <input type="text" class="form-control" placeholder="Email...">
                </div>
                <div class="phone col-md-4 col-sm-4">
                  <input type="text" class="form-control" placeholder="Phone Number...">
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="message form-group">
                <textarea class="form-control" rows="5" id="comment" placeholder="Write a comment..."></textarea>
              </div>
              <div class="submit-message">
                <button class="btn btn-lg">
                  <p>SUBMIT</p>
                </button>
              </div>
            </div>
          </div><!--END OF .WR-FORM-CONTACT-->
        </div><!--END OF .FORM-CONTACT-->
    </div><!--END OF .CONTACT-US-->


@endsection