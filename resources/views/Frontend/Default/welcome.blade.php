@extends('layouts.Frontend.Default.app')

@section('content')

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
            {!! str_replace("../../../","",$post->content) !!}
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
              <p class="pull-right"><a href="{{ url(Modules\Settings\Models\Setting::getUrlHome('site_url').'/read/'.$post->slug) }}">READ MORE...</a></p>
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

@endsection