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
              <!-- <div class="detail-nav col-md-6">
                <ul class="detail-nav-right">
                  <li class="detail-nav-items">
                    <a href="#">Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ Home</a>
                  </li>
                  <li class="detail-nav-items">
                    <a href="#">/ Home</a>
                  </li>
                </ul>
              </div> -->
              <h1 class="detail-title col-md-6">{{config(appLang.'.strSaveTitle')}}</i></h1>
              <?php echo  $lstProperty; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <h2 class="main-title">Properties</h2>
            <div class="col-md-4 col-sm-6">
              <div class="list-box">
                <div class="listing-box">
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/placeholder.png');">
                    <div class="listing-box-image-label">Featured</div>
                    <!-- /.listing-box-image-label -->
                    <span class="listing-box-image-links show-projects-func">
                      <a href="properties.html">
                        <i class="fa fa-save"></i> <span>Save to see later</span>
                    </a>
                    <a href="properties-detail-standard.html"><i class="fa fa-search"></i> <span>View detail</span></a>
                    <!-- <a href="properties-compare.html"><i class="fa fa-balance-scale"></i> <span>Compare property</span></a> -->
                    </span>
                  </div>
                  <!-- /.listing-box-image -->
                  <div class="listing-box-title">
                    <h3><a href="properties-detail-standard.html">Bright Island Route</a></h3>
                    <h4>$ 40.000</h4>
                  </div>
                  <!-- /.listing-box-title -->
                  <div class="listing-box-content">
                    <dl>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bath.png" /><span class="listing-box-content-title">Bathrooms</span></dt>
                      <dd>2</dd>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/bed.png" /><span class="listing-box-content-title">Beds</span></dt>
                      <dd>3</dd>
                      <dt><img src="{{ generateUrl('/public') }}/images/icon/acreage.png" /><span class="listing-box-content-title">Area</span></dt>
                      <dd>147 m2</dd>
                    </dl>
                    <dl>
                      <dt><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i><span class="listing-box-content-title">Location</span></dt>
                      <dd>District 1</dd>
                    </dl>
                  </div>
                  <!-- /.listing-box-cotntent -->
                </div>
              </div>
            </div>
            <!-- /.listing-box -->
          </div>
          <!-- / properties result -->
          <div class="row">
            <h2 class="main-title">{{config(appLang.'.strProject')}}</h2>
            <div class="col-md-4 col-sm-6">
              <div class="list-box">
                <div class="listing-box">
                  <div class="listing-box-image" style="background-image: url('{{ generateUrl('/public') }}/images/placeholder.png');">
                    <!-- <div class="listing-box-image-label">Featured</div> -->
                    <!-- /.listing-box-image-label -->
                    <span class="listing-box-image-links show-projects-func">
                      <a href="properties.html">
                        <i class="fa fa-save"></i> <span>Save to see later</span>
                    </a>
                    <a href="properties-detail-standard.html"><i class="fa fa-search"></i> <span>View detail</span></a>
                    <!-- <a href="properties-compare.html"><i class="fa fa-balance-scale"></i> <span>Compare property</span></a> -->
                    </span>
                  </div>
                  <!-- /.listing-box-image -->
                  <div class="listing-box-title">
                    <h3><a href="properties-detail-standard.html">Project name is here. It sound good</a></h3>
                    <!-- <h4>$ 40.000</h4> -->
                  </div>
                  <!-- /.listing-box-title -->
                  <div class="listing-box-content">
                    <dl>
                      <dt><i class="fa fa-home" aria-hidden="true"></i><span class="listing-box-content-title">Investor:</span></dt>
                      <dd>GKC</dd>
                      <dt><i class="fa fa-map-marker" aria-hidden="true"></i><span class="listing-box-content-title">Address:</span></dt>
                      <dd>District 1 ab d g...</dd>
                      <dt><i class="fa fa-usd" aria-hidden="true"></i><span class="listing-box-content-title">Sale:</span></dt>
                      <dd>120$</dd>
                      <dt><i class="fa fa-usd" aria-hidden="true"></i><span class="listing-box-content-title">Rent:</span></dt>
                      <dd>1623</dd>
                    </dl>
                  </div>
                  <!-- /.listing-box-cotntent -->
                </div>
              </div>
            </div>
            <!-- /.listing-box -->
          </div>
          <!-- / project result -->
          <h2 class="main-title">{{config(appLang.'.strNews')}}</h2>
          <div class="col-md-6">
            <div class="post post-search-save">
              <div class="post-image">
                <a class="post-image-link" href="blog-detail.html" style="background-image: url('{{ generateUrl('/public') }}/images/tmp-1.jpg');">
                </a>
                <div class="post-author">
                  <span class="post-author-image">
                    <a href="blog-detail.html" style="background-image: url('{{ generateUrl('/public') }}/images/agent-1.jpg');">
                    </a>
                  </span>
                  <!-- /.post-author-image -->
                  <a href="blog-detail.html">
                    <span class="post-author-name">
                      Alice Sharp
                    </span>
                  </a>
                </div>
                <!-- /.post-author -->
              </div>
              <!-- /.post-image -->
              <div class="post-title">
                <h2>
                  <a href="blog-detail.html">
                    Praesent mollis arcu eget condimentum gravida
                  </a>
                </h2>
              </div>
              <!-- /.post-title -->
              <div class="post-meta">
                <div class="post-meta-item">
                  Posted by
                  <a href="blog-detail.html">
                    admin
                  </a>
                </div>
                <!-- /.post-meta-item -->
                <div class="post-meta-item">
                  3/28/2016
                </div>
                <!-- /.post-meta-item -->
                <div class="post-meta-item">
                  <a href="blog-detail.html">
                    3 comments
                  </a>
                </div>
                <!-- /.post-meta-item -->
              </div>
              <!-- /.post-meta -->
              <div class="post-content">
                <p>
                  In accumsan fermentum massa, vel tincidunt metus condimentum a. Nunc et aliquam ipsum. Nulla laoreet felis diam, sed blandit libero sollicitudin nec.
                </p>
              </div>
              <!-- /.post-content -->
              <div class="post-read-more">
                <a href="blog-detail.html">
                  Read More
                  <i class="fa fa-chevron-right">
                  </i>
                </a>
              </div>
              <!-- /.post-read-more -->
            </div>
            <!-- /.post-->
          </div>
          <!-- / news result -->
        </div>
        @include('side-bar')
      </div>
    </div>
  </section>
@stop
