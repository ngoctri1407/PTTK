@extends('layout')


@section('search')
@stop


@section('main')
  <section id="main-section">
    <div class="container-fluid detail-header-fluid">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="detail-header">
              <div class="detail-nav col-md-6">
              @if(appLang == "_vi")
                <ul class="detail-nav-right">
                  <li class="detail-nav-items">
                    <a href="{{ siteURL }}">Trang chủ </a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="{{ siteURL }}/show-news/all">/ Tin</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="{{ siteURL }}/show-news/{{strtolower($catNewsEn)}}">/ {{$catNewsVi}}</a>
                  </li>
                </ul>
                @else
                <ul class="detail-nav-right">
                  <li class="detail-nav-items">
                    <a href="#">Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ News</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ {{$catNewsEn}}</a>
                  </li>
                </ul>
                @endif
              </div>
              <h1 class="detail-title col-md-6">
                <span class="border-red">
                <?php if(appLang == "_vi")
                  echo $newsdetail[0]->title_vi;
                else 
                  echo $newsdetail[0]->title_en;
                ?>
                </span>
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
      @foreach($newsdetail as $news)
        <div class="col-md-9 ani-main-content">
          <div class="row">
            <section id="detail-main">
              <div class="news-detail-img">
                <img src="{{ generateUrl('/public') }}/images/news/{{$news->image}}" />
              </div>
              <div class="news-detail-content">
                <?php if(appLang == "_vi")
                  echo $news->content_vi;
                else 
                  echo $news->content_en;
                ?>
              </div>

              <div id="detail-comment">
                <?php include public_path()."/FBcomments/fbCmt.php"; ?>
              </div>             
            </section>
          </div>
        </div>
        @endforeach

        @include('side-bar')
      </div>
    </div>
  </section>
@stop 
