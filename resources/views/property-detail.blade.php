@extends('layout')


@section('search')
@stop


@section('main')
<style type="text/css">
.booking {
    width: 100%;
    margin-top: 10px;
}</style>
  <section id="main-section">
    <div class="container-fluid detail-header-fluid">
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="detail-header">
              <!-- <div class="detail-nav col-md-6">
                <ul class="detail-nav-right">
                  {{config(appLang.'.strCode')}}: {{$code}}
                </ul>
              </div> -->
              <h1 class="detail-title col-md-6">
                <span class="border-red">
                <?php
                if(appLang == "_vi")
                {
                  echo $detail->title_vi;
                }
                else
                {
                  echo $detail->title_en;
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
                              <img data-u="image" src="{{ generateUrl('/public') }}/images/properties/<?php echo $image->id_images ?>" />
                              <img data-u="thumb" src="{{ generateUrl('/public') }}/images/properties/<?php echo $image->id_images ?>" />
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
                  {{config(appLang.'.strCode')}}<br />{{$code}}
                </div>
              </div>
              <div class="row property-detail">
                <div class="col-md-12">
                  <button type="button" class="btn btn-info booking" data-toggle="modal" data-target="#myModal">Book this</button>
                </div>
                @if(isset($message))
                 <div class="alert alert-success">
                  <strong>Success!</strong> Booking success.
                </div>
                @endif
                
                <div class="col-md-6 project-att">
                  <div class="col-md-12 detail-amenities-title">
                    {{config(appLang.'.strPropertyInformation')}}
                  </div>
                  <div class="detail-project-att">
                    <ul>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strName')}}:</p>
                        <span>
                        <?php
                        if(appLang == "_vi")
                        {
                          echo $detail->title_vi;
                        }
                        else
                        {
                          echo $detail->title_en;
                        }
                        ?>
                        </span>
                      </li>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strLocation')}}:</p>
                        <span><?php
                      if(appLang == "_vi")
                      {
                        if($detail->township == "Q1")
                          echo "Q.1";
                        if($detail->township == "Q2")
                          echo "Q.2";
                        if($detail->township == "Q3")
                          echo "Q.3";
                        if($detail->township == "Q4")
                          echo "Q.4";;
                        if($detail->township == "Q5")
                          echo "Q.5";
                        if($detail->township == "Q6")
                          echo "Q.6";
                        if($detail->township == "Q7")
                          echo "Q.7";
                        if($detail->township == "Q8")
                          echo "Q.8";
                        if($detail->township == "Q9")
                          echo "Q.9";
                        if($detail->township == "Q10")
                          echo "Q.10";
                        if($detail->township == "Q11")
                          echo "Q.11";
                        if($detail->township == "Q12")
                          echo "Q.12";
                        if($detail->township == "QTD")
                          echo "Q.Thủ Đức";
                        if($detail->township == "QGV")
                          echo "Q.Gò Vấp";
                        if($detail->township == "QBT")
                          echo "Q.Bình Thạnh";
                        if($detail->township == "QTB")
                          echo "Q.Tân Bình";
                        if($detail->township == "QTP")
                          echo "Q.Tân Phú";
                        if($detail->township == "QPN")
                          echo "Q.Phú Nhuận";
                        if($detail->township == "QBT2")
                          echo "Q.Bình Tân";
                      }
                      else
                      {
                        if($detail->township == "Q1")
                          echo "Dist.1";
                        if($detail->township == "Q2")
                          echo "Dist.2";
                        if($detail->township == "Q3")
                          echo "Dist.3";
                        if($detail->township == "Q4")
                          echo "Dist.4";;
                        if($detail->township == "Q5")
                          echo "Dist.5";
                        if($detail->township == "Q6")
                          echo "Dist.6";
                        if($detail->township == "Q7")
                          echo "Dist.7";
                        if($detail->township == "Q8")
                          echo "Dist.8";
                        if($detail->township == "Q9")
                          echo "Dist.9";
                        if($detail->township == "Q10")
                          echo "Dist.10";
                        if($detail->township == "Q11")
                          echo "Dist.11";
                        if($detail->township == "Q12")
                          echo "Dist.12";
                        if($detail->township == "Q12")
                          echo "Dist.12";
                        if($detail->township == "QTD")
                          echo "Thu Duc Dist.";
                        if($detail->township == "QGV")
                          echo "Go Vap Dist.";
                        if($detail->township == "QBT")
                          echo "Binh Thanh Dist.";
                        if($detail->township == "QTB")
                          echo "Tan Binh Dist.";
                        if($detail->township == "QTP")
                          echo "Tan Phu Dist.";
                        if($detail->township == "QPN")
                          echo "Phu Nhuan Dist.";
                        if($detail->township == "QBT2")
                          echo "Binh Tan Dist.";
                      }
                      ?></span>
                      </li>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strArea')}}:</p>
                        <span>{{$detail->area}} m2</span>
                      </li>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strPrice')}}:</p>
                        <span><?php
                            echo $detail->price . " ";
                            echo $typeprice;
                        ?></span>
                      </li>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strAvailableDate')}}:</p>
                        <span>
                          <?php
                          $date = date_create($detail->available_time);
                          echo date_format($date, 'Y-M-d');
                          ?>
                        </span>
                      </li>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strUpdatedDate')}}:</p>
                        <span>
                          <?php
                          $date = date_create($detail->updated_at);
                          echo date_format($date, 'Y-M-d');
                          ?>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-6 project-agent">
                  <div class="col-md-12 detail-amenities-title">
                    {{config(appLang.'.strAsignedAgent')}}
                  </div>
                  <div class="detail-project-att">
                    <?php if ($author != null) { ?>
                    <ul>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strName')}}:</p>
                        <span>{{$author->name}}</span>
                      </li>
                      <li class="detail-project-att-item">
                        <p>{{config(appLang.'.strTitle')}}:</p>
                        <span>{{$author->title}}</span>
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
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div id="detail-furnished">
                <div class="col-md-12 detail-furnished-title">
                  {{config(appLang.'.strFurnitureFeatures')}}
                </div>
                <ul class="row detail-furnished-list">
                  <?php
                  foreach($lstfurnished as $furnished)
                  {
                  ?>
                  <li class="col-md-3 col-sm-4 col-xs-6 detail-furnished-item">
                    <?php
                    if(appLang == "_vi")
                    {
                      echo $furnished->name_vi;
                    }
                    else
                    {
                      echo $furnished->name_en;
                    }

                    ?>
                  </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
              <div id="detail-description">
                <div class="col-sm-3 detail-furnished-title">
                  {{config(appLang.'.strDescription')}}
                </div>
                
                <div class="col-sm-9 col-xs-4 detail-furnished-title" style="text-align: right;">
                  <a href="#"><i class="fa fa-download" aria-hidden="true"></i>{{config(appLang.'.strSave')}}</a>
                </div>
                <div class="row">
                  <div class="col-md-12 detail-description-text">
                    <?php
                    if(appLang == "_vi")
                    {
                      echo $detail->description_vi;
                    }
                    else
                    {
                      echo $detail->description_en;
                    }

                    ?>
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
                          {
                            ?>
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
                          }
                  ?>

                </ul>
              </div>
              <div id="detail-amenities">
                <div class="col-md-12 detail-amenities-title">
                  {{config(appLang.'.strAmenitiesNearby')}}
                </div>
                <ul class="row detail-amenities-list">
                  <?php
                        foreach($lstAmenitiesNearby as $amenities)
                          {
                            ?>
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
                          }
                  ?>

                </ul>
              </div>
              <?php
                    if($detailproject != null)
                    {
              ?>
              <div id="detail-project">
                <div class="row">
                  <div class="col-md-12">
                    <div class="detail-amenities-title">
                      {{config(appLang.'.strProjectInformation')}}
                    </div>
                    <div class="detail-project-att">
                      <ul>
                        <li class="detail-project-att-item">
                          <p>{{config(appLang.'.strProjectName')}}:</p>
                          <span>
                            <?php
                            if(appLang == "_vi")
                            {
                              echo $detailproject->name_vi;
                            }
                            else
                            {
                              echo $detailproject->name_en;
                            }
                            ?>
                          </span>
                        </li>
                        <li class="detail-project-att-item">
                          <p>{{config(appLang.'.strInvestor')}}:</p>
                          <span>{{ $detailproject->investor }}</span>
                        </li>
                        <li class="detail-project-att-item">
                          <p>{{config(appLang.'.strAddress')}}:</p>
                          <span>{{ $detailproject->address }}</span>
                        </li>
                        <li class="detail-project-att-item">
                          <p>{{config(appLang.'.strSalePrice')}}:</p>
                          <span>{{ $detailproject->sell_price }}</span>
                        </li>
                        <li class="detail-project-att-item">
                          <p>{{config(appLang.'.strRentPrice')}}:</p>
                          <span>{{ $detailproject->lease_price }}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="detail-amenities-title">
                      {{config(appLang.'.strProjectDescription')}}
                    </div>
                    <div class="detail-project-des">
                      <?php
                      if(appLang == "_vi")
                      {
                        echo $detailproject->description_vi;
                      }
                      else
                      {
                        echo $detailproject->description_en;
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              }
              ?>

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
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Booking form</h4>
          </div>
          <div class="modal-body">
            <form class="m-t" role="form" action="/PTTK/booking" method="post">
                <div>{{isset($error) ? $error :''}}</div>
                {!! csrf_field() !!}
                <input type="text" name="property_id" class="form-control" value="{{$detail->id_key}}" hidden required="">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" required="">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="SDT" required="">
                </div>
                <div class="form-group" id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="time" class="form-control" value="19/05/2018">
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary block full-width m-b">Book</button>
            </form>
          </div>
        </div>

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
