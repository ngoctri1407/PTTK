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
                    <a href="#">{{$projectStr}}</a>
                  </li>
                </ul>
              </div> -->
              <h1 class="detail-title col-md-6">
                <span class="border-red">
                <?php
                if(appLang == "_vi")
                {
                  echo $detail->name_vi;
                }
                else
                {
                  echo $detail->name_en;
                }
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
        <div class="col-md-9 ani-main-content">
          <div class="row">
            <section id="detail-main">
              <div id="detail-slide">
                <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 850px; height: 600px; overflow: hidden; visibility: hidden;">
                  <!-- Loading Screen -->
                  <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;background:generateUrl('{{ generateUrl('/public') }}/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                  </div>
                  <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 850px; height: 600px; overflow: hidden;">
                    <?php
                      foreach($lstimage as $image)
                      {
                        ?>
                        <div data-p="112.50" style="display: none;">
                          <img data-u="image" src="{{ generateUrl('/public') }}/images/projects/<?php echo $image->id_images ?>" />
                          <img data-u="thumb" src="{{ generateUrl('/public') }}/images/projects/<?php echo $image->id_images ?>" />
                        </div>
                    <?php
                      }
                    ?>
                  </div>
                  <!-- Thumbnail Navigator -->
                  <div u="thumbnavigator" class="jssort03" style="position:absolute;left:0px;bottom:0px;width:850px;height:60px;" data-autocenter="1">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; background-color: #000; filter:alpha(opacity=30.0); opacity:0.3;"></div>
                    <!-- Thumbnail Item Skin Begin -->
                    <div u="slides" style="cursor: default;">
                      <div u="prototype" class="p">
                        <div class="w">
                          <div u="thumbnailtemplate" class="t"></div>
                        </div>
                        <div class="c"></div>
                      </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                  </div>
                  <!-- Arrow Navigator -->
                  <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
                  <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
                </div>
                <!-- #endregion Jssor Slider End -->
                <div class="code-in-slide">
                  {{$projectStr}}
                </div>
              </div>

              <div class="col-md-6 project-att">
                <div class="col-md-12 detail-amenities-title">
                  {{config(appLang.'.strProjectInformation')}}
                </div>
                <div class="detail-project-att">
                  <ul>
                    <li class="detail-project-att-item">
                      <p>Project Name:</p>
                      <span>
                      <?php
                      if(appLang == "_vi")
                      {
                        echo $detail->name_vi;
                      }
                      else
                      {
                        echo $detail->name_en;
                      }
                      ?>
                      </span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strInvestor')}}:</p>
                      <span>{{$detail->investor}}</span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strAddress')}}:</p>
                      <span>{{$detail->address}}</span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strSalePrice')}}:</p>
                      <span>{{$detail->sell_price}}</span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strRentPrice')}}:</p>
                      <span>{{$detail->lease_price}}</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 project-agent">
                <div class="col-md-12 detail-amenities-title">
                  {{config(appLang.'.strAsignedAgent')}}
                </div>
                <?php if ($author != null) { ?>
                <div class="detail-project-att">
                  <ul>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strName')}}:</p>
                      <span>{{$author->name}}</span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strEmail')}}:</p>
                      <span>{{$author->email}}</span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strPhone')}}:</p>
                      <span>{{$author->phone}}</span>
                    </li>
                    <li class="detail-project-att-item">
                      <p>{{config(appLang.'.strProfileImage')}}:</p>
                      <img class="project-agent-profile" src="{{ generateUrl('/public') }}/images/agent/{{$author->image}}" />
                    </li>
                  </ul>
                </div>
                <?php } ?>
              </div>
              
              <div id="detail-description">
                <div class="col-sm-6 detail-furnished-title">
                  {{config(appLang.'.strProjectDescription')}}
                </div>
                
                <div class="col-sm-6 col-xs-4 detail-furnished-title" style="text-align: right;">
                  <a href="#"><i class="fa fa-download" aria-hidden="true"></i>{{config(appLang.'.strSave')}}</a>
                </div>
                <div class="row">
                  <div class="col-md-12 detail-description-text">
                    <?php
                    if (appLang == "_vi") { 
                      echo $detail->description_vi;
                    }
                    else {
                      echo $detail->description_en;
                    } ?>
                  </div>
                </div>
              </div>
              <div id="detail-amenities">
                <div class="col-md-12 detail-amenities-title">
                  {{config(appLang.'.strAmenitiesInside')}}
                </div>
                <ul class="row detail-amenities-list">
                 <?php
                  foreach($lstAmenitiesInside as $amenities)
                  { ?>
                  <li class="col-md-3 col-sm-4 col-xs-6 detail-amenities-item">
                    <?php
                    if(appLang == "_vi")
                    {
                      echo $amenities->name_vi;
                    }
                    else
                    {
                      echo $amenities->name_en;
                    }
                    ?>
                  </li>
                  <?php
                  } ?>
                </ul>
              </div>
              <div id="detail-amenities">
                <div class="col-md-12 detail-amenities-title">
                  {{config(appLang.'.strAmenitiesNearby')}}
                </div>
                <ul class="row detail-amenities-list">
                 <?php
                  foreach($lstAmenitiesNearby as $amenities)
                  { ?>
                  <li class="col-md-3 col-sm-4 col-xs-6 detail-amenities-item">
                    <?php
                    if(appLang == "_vi")
                    {
                      echo $amenities->name_vi;
                    }
                    else
                    {
                      echo $amenities->name_en;
                    }
                    ?>
                  </li>
                  <?php
                  } ?>
                </ul>
              </div>
              <div id="detail-maps">
                <div class="detail-maps-content">
                  <iframe src="https://www.google.com/maps?q=<?php echo $detail->address?>&output=embed" width="100%" height="350px"></iframe>
                </div>
              </div>
              <div id="detail-comment">
                <?php include public_path()."/FBcomments/fbCmt.php"; ?>
              </div>
            </section>
          </div>
        </div>
        @include('side-bar')
      </div>
    </div>
  </section>
  @stop
  
  @section('extend-script')
  <!-- image slider -->
  <script src="{{ generateUrl('/public') }}/js/jssor.slider.min.js">
  </script>
  <script>
  jQuery(document).ready(function($) {

    var jssor_1_options = {
      $AutoPlay: true,
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $ThumbnailNavigatorOptions: {
        $Class: $JssorThumbnailNavigator$,
        $Cols: 9,
        $SpacingX: 3,
        $SpacingY: 3,
        $Align: 260
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizing
    function ScaleSlider() {
      var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
      if (refSize) {
        refSize = Math.min(refSize, 850);
        jssor_1_slider.$ScaleWidth(refSize);
      } else {
        window.setTimeout(ScaleSlider, 30);
      }
    }
    ScaleSlider();
    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
    //responsive code end
  });
  </script>
@stop
