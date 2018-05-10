@inject('sidebarservice', 'App\Services\SideBarService')
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
              <h1 class="detail-title col-md-6">{{$category}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container">
        <div class="posts posts-grid">
          <div class="row">
            <?php
            $i=0;
            foreach ($lstNews as $news) {
              if (appLang == "_vi") {
                $urlName = $sidebarservice->kd($news->title_vi);
              }
              else {
                $urlName = $sidebarservice->kd($news->title_en);
              }
              ?>
              <div class="col-lg-4">
              <div class="post">
                <div class="post-image">
                  <a class="post-image-link" href="<?php echo siteURL;?>/news/detail/{{$urlName}}/<?php echo $news->id ?>" style="background-image: url('{{ generateUrl('/public') }}/images/news/{{$news->image}}');">
                  </a>
                  <div class="listing-box-image-label">
                  <?php 
                      if (appLang == "_vi") {
                    echo $lstNewsCatVi[$i];
                  }
                  else {
                    echo $lstNewsCatEn[$i];
                  }
                  ?>
                    </div>
                    <!-- /.listing-box-image-label -->
                </div>
                <!-- /.post-image -->
                <div class="post-title">
                  <h2>
                    <a href="<?php echo siteURL;?>/news/detail/{{$urlName}}/<?php echo $news->id ?>">
                      <?php
                      if (appLang == "_vi")
                      echo $news->title_vi;
                      else 
                      echo $news->title_en;
                      ?>
                    </a>
                  </h2>
                </div>
                <!-- /.post-title -->
                <div class="post-meta meta-news">
                  <!-- /.post-meta-item -->
                  <div class="post-meta-item meta-date">
                    <?php echo date('d/m/Y', strtotime($news->created_at)); ?>
                  </div>
                </div>
                <!-- /.post-meta -->
                <div class="post-content">
                  <p>
                    <?php 
                  if(appLang == "_vi")
                  echo substr($news->content_vi, 0, 200);
                else 
                  echo substr($news->content_en, 0, 200);
                echo '...';
                  ?>
                  </p>
                </div>
                <!-- /.post-content -->
                <div class="post-read-more">
                  <a href="<?php echo siteURL;?>/news/detail/{{$urlName}}/<?php echo $news->id ?>">
                    <?php if(appLang == "_vi")
                    echo 'Xem thêm';
                    else
                    echo 'Read More';
                  ?>
                    <i class="fa fa-chevron-right">
                    </i>
                  </a>
                </div>
                <!-- /.post-read-more -->
              </div>
              <!-- /.post-->
            </div>
            <!-- /.col-* -->

              <?php
              $i++;
             } 
            ?>
            
          </div>
          <!-- /.row -->
        </div>
        <!-- /.posts-->
        <div class="pagination-wrapper">
          {!! $lstNews->render() !!}
          <!-- /.pagination -->
        </div>
        <!-- /.pagination-wrapper -->
      </div>
      <!-- /.container -->
    </div>
  </section>
@stop
